<?php

namespace App\Imports;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ProjectImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            if ($key === 0) {
                continue;
            }

            if (!isset($row[0])) {
                continue;
            }

            Project::create([
                'type_id' => $this->getTypeId($row[0]),
                'title' => $row[1],
                'date_created' => Date::excelToDateTimeObject($row[2]),
                'setevik' => isset($row[3]) ? $this->convertYesNoToBoolean($row[3]) : null,
                'member_count' => isset($row[4]) ? $row[4] : null,
                'has_outsource' => isset($row[5]) ? $this->convertYesNoToBoolean($row[5]) : null,
                'has_investors' => isset($row[6]) ? $this->convertYesNoToBoolean($row[6]) : null,
                'date_deadline' => isset($row[7]) ? Date::excelToDateTimeObject($row[7]) : null,
                'on_time' => isset($row[8]) ? $this->convertYesNoToBoolean($row[8]) : null,
                'step_1' => isset($row[9]) ? $row[9] : null,
                'step_2' => isset($row[10]) ? $row[10] : null,
                'step_3' => isset($row[11]) ? $row[11] : null,
                'step_4' => isset($row[12]) ? $row[12] : null,
                'date_signed' => isset($row[13]) ? Date::excelToDateTimeObject($row[13]) : null,
                'service_count' => isset($row[14]) ? $row[14] : null,
                'comment' => isset($row[15]) ? $row[15] : null,
                'effectiveness' => isset($row[16]) ? $row[16] : null,
            ]);
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

    private function getTypeId(string $title): int
    {
        $types = $this->getAllTypesInArray();

        if (isset($types[$title])) {
            return $types[$title];
        } else {
            $type = Type::create(['title' => $title]);
            return $type->id;
        }
    }

    private function convertYesNoToBoolean(string $yesOrNo): bool
    {
        if ($yesOrNo === 'Да') {
            return true;
        } else {
            return false;
        }
    }
}
