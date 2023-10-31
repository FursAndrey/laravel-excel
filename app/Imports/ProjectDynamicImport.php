<?php

namespace App\Imports;

use App\Factories\ProjectStaticFactory;
use App\Models\FailedRow;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Task;
use App\Models\Type;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Validators\Failure;

class ProjectDynamicImport implements ToCollection, WithValidation, SkipsOnFailure, WithEvents
{
    use RegistersEventListeners;

    private Task $task;
    private static array $headers;

    const STATIC_ROWS = 16;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }
    
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $types = $this->getAllTypesInArray();

        foreach ($collection as $key => $row) {
            if ($key === 0) {
                continue;
            }

            if (!isset($row[0])) {
                continue;
            }

            $map = $this->getRowsMap($row);

            $staticCollection = collect($map['static']);
            
            $projectFactory = ProjectStaticFactory::make($types, $staticCollection);
            $project = Project::updateOrCreate(
                $projectFactory->getUniqueKey(), 
                $projectFactory->getArray()
            );

            if ($map['dynamic'] === []) {
                continue;
            }

            $dynamicHeaders = $this->getRowsMap(self::$headers)['dynamic'];
            
            foreach ($map['dynamic'] as $key => $value) {
                Payment::create([
                    'project_id' => $project->id,
                    'title' => $dynamicHeaders[$key],
                    'value' => $value,
                ]);
            }
        }
    }

    private function getRowsMap($row): array
    {
        $static = [];
        $dynamic = [];

        foreach ($row as $key => $value) {
            if (!isset($value)) {
                continue;
            }

            if ($key <= self::STATIC_ROWS) {
                $static[$key] = $value;
            } else {
                $dynamic[$key] = $value;
            }
        }

        return [
            'static' => $static,
            'dynamic' => $dynamic,
        ];
    }

    protected function getAllTypesInArray(): array
    {
        $types = Type::all();

        $array = [];
        foreach ($types as $type) {
            $array[$type->title] = $type->id;
        }
        return $array;
    }

    public function rules(): array
    {
        $this->getDynamicValidationRules();

        return array_replace([
            '0' => 'required|string',
            '1' => 'required|string',
            '2' => 'required|integer',
            '3' => 'nullable|string',
            '4' => 'nullable|integer',
            '5' => 'nullable|string',
            '6' => 'nullable|string',
            '7' => 'nullable|integer',
            '8' => 'nullable|string',
            '13' => 'nullable|integer',
            '14' => 'nullable|integer',
            '15' => 'nullable|integer',
            '16' => 'nullable|integer',
            '9' => 'nullable|integer',
            '10' => 'nullable|integer',
            '11' => 'nullable|string',
            '12' => 'nullable|numeric',
        ], $this->getDynamicValidationRules());
    }

    public function onFailure(Failure ...$failures)
    {
        $tmp = [];
        foreach($failures as $failure) {
            if ($failure->row() === 1) {
                continue;
            }

            foreach ($failure->errors() as $error) {
                $tmp[] = [
                    'key' => $this->fileAttributesRu()[$failure->attribute()],
                    'row' => $failure->row(),
                    'message' => str_ireplace($failure->attribute().' ', '', $error),
                    'task_id' => $this->task->id,
                ];
            }
        }

        if ($tmp != []) {
            FailedRow::insertRows($tmp);
            $this->task->update(['status' => Task::STATUS_ERROR]);
        } else {
            $this->task->update(['status' => Task::STATUS_SUCCESS]);
        }
    }
    
    private function fileAttributesRu(): array
    {
        return array_replace([
            '0' => 'Тип',
            '1' => 'Наименование',
            '2' => 'Дата создания',
            '3' => 'Сетевик',
            '4' => 'Количество участников',
            '5' => 'Наличие аутсорсинга',
            '6' => 'Наличие инвесторов',
            '7' => 'Дедлайн',
            '8' => 'Сдача в срок',
            '9' => 'Подписание договора',
            '10' => 'Количество услуг',
            '11' => 'Комментарий',
            '12' => 'Значение эффективности',
            '13' => 'Вложение в первый этап',
            '14' => 'Вложение во второй этап',
            '15' => 'Вложение в третий этап',
            '16' => 'Вложение в четвертый этап',
        ], $this->getRowsMap(self::$headers)['dynamic']);
    }

    public static function beforeSheet(BeforeSheet $event)
    {
        self::$headers = $event->getSheet()->getDelegate()->toArray()[0];
    }

    private function getDynamicValidationRules(): array
    {
        $dynamic = $this->getRowsMap(self::$headers)['dynamic'];

        $rules = [];
        foreach ($dynamic as $key => $value) {
            $rules[$key] = 'nullable|integer';
        }
        
        return $rules;
    }
}
