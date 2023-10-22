<?php

namespace App\Factories;

use App\Models\Type;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ProjectFactory
{
    private $typeId;
    private $title;
    private $dateCreated;
    private $setevik;
    private $memberCount;
    private $hasOutsource;
    private $hasInvestors;
    private $dateDeadline;
    private $onTime;
    private $step1;
    private $step2;
    private $step3;
    private $step4;
    private $dateSigned;
    private $serviceCount;
    private $comment;
    private $effectiveness;

    private function __construct(array $types, Collection $row)
    {
        $this->typeId = self::getTypeId($types, $row[0]);
        $this->title = $row[1];
        $this->dateCreated = Date::excelToDateTimeObject($row[2]);
        $this->setevik = isset($row[3]) ? self::convertYesNoToBoolean($row[3]) : null;
        $this->memberCount = isset($row[4]) ? $row[4] : null;
        $this->hasOutsource = isset($row[5]) ? self::convertYesNoToBoolean($row[5]) : null;
        $this->hasInvestors = isset($row[6]) ? self::convertYesNoToBoolean($row[6]) : null;
        $this->dateDeadline = isset($row[7]) ? Date::excelToDateTimeObject($row[7]) : null;
        $this->onTime = isset($row[8]) ? self::convertYesNoToBoolean($row[8]) : null;
        $this->step1 = isset($row[9]) ? $row[9] : null;
        $this->step2 = isset($row[10]) ? $row[10] : null;
        $this->step3 = isset($row[11]) ? $row[11] : null;
        $this->step4 = isset($row[12]) ? $row[12] : null;
        $this->dateSigned = isset($row[13]) ? Date::excelToDateTimeObject($row[13]) : null;
        $this->serviceCount = isset($row[14]) ? $row[14] : null;
        $this->comment = isset($row[15]) ? $row[15] : null;
        $this->effectiveness = isset($row[16]) ? $row[16] : null;
    }

    public static function make(array $types, Collection $row): self
    {
        return new self($types, $row);
    }

    public function getUniqueKey(): array
    {
        return [
            'type_id' => $this->typeId,
            'title' => $this->title,
            'date_created' => $this->dateCreated,
        ];
    }

    public function getArray(): array
    {
        return [
            'type_id' => $this->typeId,
            'title' => $this->title,
            'date_created' => $this->dateCreated,
            'setevik' => $this->setevik,
            'member_count' => $this->memberCount,
            'has_outsource' => $this->hasOutsource,
            'has_investors' => $this->hasInvestors,
            'date_deadline' => $this->dateDeadline,
            'on_time' => $this->onTime,
            'step_1' => $this->step1,
            'step_2' => $this->step2,
            'step_3' => $this->step3,
            'step_4' => $this->step4,
            'date_signed' => $this->dateSigned,
            'service_count' => $this->serviceCount,
            'comment' => $this->comment,
            'effectiveness' => $this->effectiveness,
        ];
    }
    
    private static function getTypeId(array $types, string $title): int
    {
        if (isset($types[$title])) {
            return $types[$title];
        } else {
            $type = Type::create(['title' => $title]);
            return $type->id;
        }
    }

    private static function convertYesNoToBoolean(string $yesOrNo): bool
    {
        if ($yesOrNo === 'Да') {
            return true;
        } else {
            return false;
        }
    }
}
