<?php

namespace App\Models;

use App\Enums\NoticeBadge;
use App\Enums\NoticeType;
use Database\Factories\NoticeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Notice extends Model
{
    /** @use HasFactory<NoticeFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'date_text',
        'badge',
        'type',
        'icon_path',
        'link_url',
        'order',
        'is_active',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var list<string>
     */
    protected $appends = [
        'icon_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => NoticeType::class,
            'badge' => NoticeBadge::class,
            'order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the public URL for the notice icon, with smart fallback based on NoticeType.
     */
    public function getIconUrlAttribute(): string
    {
        if (! empty($this->icon_path)) {
            if (str_starts_with($this->icon_path, 'notices/') || str_starts_with($this->icon_path, 'uploads/')) {
                return Storage::url($this->icon_path);
            }

            if (file_exists(public_path($this->icon_path))) {
                return asset($this->icon_path);
            }

            return Storage::url($this->icon_path);
        }

        // Smart fallback by NoticeType Enum
        return match ($this->type) {
            NoticeType::Event => asset('images/assets/Town Hall Meeting.png'),
            NoticeType::News => asset('images/assets/New Compliance Guidelines.png'),
            default => asset('images/assets/Quarterly Safety Audit.png'),
        };
    }
}
