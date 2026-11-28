<?php

namespace App\Enums;

enum NoticeType: string
{
    case Notice = 'notice';
    case News = 'news';
    case Event = 'event';

    /**
     * Get the human-readable label for this category.
     */
    public function label(): string
    {
        return match ($this) {
            self::Notice => 'Notice',
            self::News => 'News & Press',
            self::Event => 'Corporate Event',
        };
    }
}
