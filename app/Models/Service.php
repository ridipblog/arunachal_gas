<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'number_label',
        'title',
        'slug',
        'card_heading',
        'badges',
        'image_path',
        'image_alt',
        'description',
        'button_text',
        'button_url',
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
            'badges' => 'array',
            'order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the public URL for the service image.
     */
    public function getImageUrlAttribute(): string
    {
        if (empty($this->image_path)) {
            return asset('images/assets/domestic_png_kitchen.png');
        }

        // If stored in storage/ (e.g. services/xxx.webp)
        if (str_starts_with($this->image_path, 'services/') || str_starts_with($this->image_path, 'uploads/')) {
            return Storage::url($this->image_path);
        }

        // If legacy asset in images/assets/
        return asset($this->image_path);
    }
}
