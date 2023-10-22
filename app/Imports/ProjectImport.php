<?php

namespace App\Imports;

use App\Factories\ProjectFactory;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProjectImport implements ToCollection
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

}
