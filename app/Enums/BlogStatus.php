<?php

declare(strict_types=1);

namespace App\Enums;

enum BlogStatus: string
{
    case PUBLISHED = 'published';
    case DRAFTED = 'drafted';
    case ARCHIVED = 'archived';

    public static function options(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }

    public function label(): string
    {
        return match ($this) {
            self::PUBLISHED => 'Published',
            self::DRAFTED => 'Drafted',
            self::ARCHIVED => 'Archived'
        };
    }
}
