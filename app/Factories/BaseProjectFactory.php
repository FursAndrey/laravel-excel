<?php

namespace App\Factories;

use App\Models\Type;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class BaseProjectFactory
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
    
    protected static function getTypeId(array $types, string $title): int
    {
        if (isset($types[$title])) {
            return $types[$title];
        } else {
            $type = Type::create(['title' => $title]);
            return $type->id;
        }
    }

    protected static function convertYesNoToBoolean(string $yesOrNo): bool
    {
        if ($yesOrNo === 'Да') {
            return true;
        } else {
            return false;
        }
    }
}
