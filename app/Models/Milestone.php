<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Milestone extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'period',
        'title',
        'icon',
        'custom_icon_path',
        'is_highlighted',
        'order',
        'is_active',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_highlighted' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'integer',
        ];
    }

    /**
     * Get the custom icon full URL if uploaded.
     */
    protected function customIconUrl(): Attribute
    {
        return Attribute::make(
            get: function (): ?string {
                if (empty($this->custom_icon_path)) {
                    return null;
                }

                if (str_starts_with($this->custom_icon_path, 'http://') || str_starts_with($this->custom_icon_path, 'https://')) {
                    return $this->custom_icon_path;
                }

                if (str_starts_with($this->custom_icon_path, 'images/')) {
                    return asset($this->custom_icon_path);
                }

                return Storage::disk('public')->url($this->custom_icon_path);
            }
        );
    }
}
