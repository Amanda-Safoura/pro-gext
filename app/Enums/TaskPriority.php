<?php

namespace App\Enums;


enum TaskPriority: string
{
    case Low = 'low';
    case Medium = 'medium';
    case High = 'high';


    public function label(): string
    {
        return match ($this) {
            self::Low => 'Faible',
            self::Medium => 'Moyenne',
            self::High => 'Forte',
        };
    }

    static function enum(): string
    {
        $enum = '';
        foreach (self::cases() as $priority) {
            $enum .= $priority->value . ',';
        }

        return substr($enum, 0, -1);
    }
}
