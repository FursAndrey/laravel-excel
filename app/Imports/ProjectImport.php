<?php

namespace App\Imports;

use App\Factories\ProjectFactory;
use App\Models\FailedRow;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class ProjectImport implements ToCollection, WithValidation, SkipsOnFailure
{
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

            $projectFactory = ProjectFactory::make($types, $row);
            Project::updateOrCreate(
                $projectFactory->getUniqueKey(), 
                $projectFactory->getArray()
            );
        }
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
        return [
            '0' => 'required|string',
            '1' => 'required|string',
            '2' => 'required|integer',
            '3' => 'nullable|string',
            '4' => 'nullable|integer',
            '5' => 'nullable|string',
            '6' => 'nullable|string',
            '7' => 'nullable|integer',
            '8' => 'nullable|string',
            '9' => 'nullable|integer',
            '10' => 'nullable|integer',
            '11' => 'nullable|integer',
            '12' => 'nullable|integer',
            '13' => 'nullable|integer',
            '14' => 'nullable|integer',
            '15' => 'nullable|string',
            '16' => 'nullable|numeric',
        ];
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
                    'key' => $failure->attribute(),
                    'row' => $failure->row(),
                    'message' => $error,
                    'task_id' => 1,
                ];
            }
        }

        if ($tmp != []) {
            FailedRow::insertRows($tmp);
        }
    }
}
