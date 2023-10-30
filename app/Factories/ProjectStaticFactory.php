<?php

namespace App\Factories;

use App\Models\Type;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ProjectStaticFactory extends BaseProjectFactory
{
    protected $typeId;
    protected $title;
    protected $dateCreated;
    protected $setevik;
    protected $memberCount;
    protected $hasOutsource;
    protected $hasInvestors;
    protected $dateDeadline;
    protected $onTime;
    protected $step1;
    protected $step2;
    protected $step3;
    protected $step4;
    protected $dateSigned;
    protected $serviceCount;
    protected $comment;
    protected $effectiveness;

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
        $this->step1 = isset($row[13]) ? $row[13] : null;
        $this->step2 = isset($row[14]) ? $row[14] : null;
        $this->step3 = isset($row[15]) ? $row[15] : null;
        $this->step4 = isset($row[16]) ? $row[16] : null;
        $this->dateSigned = isset($row[9]) ? Date::excelToDateTimeObject($row[9]) : null;
        $this->serviceCount = isset($row[10]) ? $row[10] : null;
        $this->comment = isset($row[11]) ? $row[11] : null;
        $this->effectiveness = isset($row[12]) ? $row[12] : null;
    }

    public static function make(array $types, Collection $row): self
    {
        return new self($types, $row);
    }
}
