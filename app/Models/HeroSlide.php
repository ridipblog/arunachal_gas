<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HeroSlide extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'image_path',
        'image_alt',
        'order',
        'is_active',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var list<string>
     */
    protected $appends = [
        'image_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the public URL for the slide image.
     */
    public function getImageUrlAttribute(): string
    {
        if (empty($this->image_path)) {
            return asset('images/assets/Group 1000002719.png');
        }

        if (str_starts_with($this->image_path, 'hero/') || str_starts_with($this->image_path, 'hero_slides/') || str_starts_with($this->image_path, 'uploads/')) {
            return Storage::url($this->image_path);
        }

        if (file_exists(public_path($this->image_path))) {
            return asset($this->image_path);
        }

        return Storage::url($this->image_path);
    }
}
