<?php

namespace App\Enums;


enum TaskStatus: string
{
    case NotStarted = 'not started';
    case Running = 'in running';
    case Ended = 'ended';


    public function label(): string
    {
        return match ($this) {
            self::NotStarted => 'Pas encore commencée',
            self::Running => 'En cours',
            self::Ended => 'Terminée',
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
