<?php

namespace App\Models;

use Database\Factories\JourneyCardFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class JourneyCard extends Model
{
    /** @use HasFactory<JourneyCardFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'image_alt',
        'order',
        'link_url',
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
     * Get the public URL for the journey card photo.
     */
    public function getImageUrlAttribute(): string
    {
        if (! empty($this->image_path)) {
            if (str_starts_with($this->image_path, 'journey/') || str_starts_with($this->image_path, 'uploads/')) {
                return Storage::url($this->image_path);
            }

            if (file_exists(public_path($this->image_path))) {
                return asset($this->image_path);
            }

            return Storage::url($this->image_path);
        }

        $slot = max(1, min(5, $this->order ?? 1));

        return asset("images/assets/journey_{$slot}.png");
    }
}
