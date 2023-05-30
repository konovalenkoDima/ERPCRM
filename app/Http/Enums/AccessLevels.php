<?php

namespace App\Http\Enums;

enum AccessLevels
{
    case ADMIN;

    case TEAM_LEAD;

    case USER;

    public function access(): string
    {
        return match($this)
        {
            self::ADMIN => 'admin',
            self::TEAM_LEAD => 'team lead',
            self::USER => 'user',
        };
    }
}
