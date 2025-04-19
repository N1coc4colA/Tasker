<?php

namespace App\Enum;

enum IssueType : int
{
    case BUG = 1;

    case FEATURE = 2;

    case STORY = 3;

    case TASK = 4;

    case EPIC = 5;

    public function label(): string
    {
        return match($this) {
            self::BUG => '<i class="bi bi-bug-fill"></i> Bug',
            self::FEATURE => '<i class="bi bi-file-plus-fill"></i> Feature',
            self::STORY => '<i class="bi bi-camera-reels-fill"></i> Story',
            self::TASK => '<i class="bi bi-wrench"></i> Task',
            self::EPIC => '<i class="bi bi-fire"></i> Epic',
        };
    }
}
