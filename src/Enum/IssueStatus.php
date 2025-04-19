<?php

namespace App\Enum;

enum IssueStatus: int
{
    case NEW = 1;

    case READY = 2;

    case IN_DEVELOPMENT = 3;

    case IN_REVIEW = 4;

    case RESOLVED = 5;

    public function label(): string
    {
        return match($this) {
            self::NEW => '<i class="bi bi-star-fill"></i> New',
            self::READY => '<i class="bi bi-clipboard2-check-fill"></i> Ready',
            self::IN_DEVELOPMENT => '<i class="bi bi-braces-asterisk"></i> In devlopment',
            self::IN_REVIEW => '<i class="bi bi-binoculars-fill"></i> In review',
            self::RESOLVED => '<i class="bi bi-check-circle-fill"></i> Resolved',
        };
    }
}
