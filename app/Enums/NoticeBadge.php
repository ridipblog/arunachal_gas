<?php

namespace App\Enums;

enum NoticeBadge: string
{
    case New = 'NEW';
    case Upcoming = 'UPCOMING';
    case Important = 'IMPORTANT';
    case Notice = 'NOTICE';
    case Event = 'EVENT';

    /**
     * Get the Tailwind styling classes for this badge.
     */
    public function colorClasses(): string
    {
        return match ($this) {
            self::New => 'bg-[#F0F9F3] text-[#16A34A] border-green-200',
            self::Upcoming => 'bg-amber-50 text-amber-700 border-amber-200',
            self::Important => 'bg-rose-50 text-rose-700 border-rose-200',
            self::Notice => 'bg-blue-50 text-blue-700 border-blue-200',
            self::Event => 'bg-purple-50 text-purple-700 border-purple-200',
        };
    }
}
