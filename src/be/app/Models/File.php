<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'files';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'fileable_type',
        'fileable_id',
        'filename',
        'filename_ori',
        'path',
        'icon',
        'extension',
        'mime_type',
        'size',
        'width',
        'heigth',
        'orientation',
    ];

    protected function icon(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => url($value),
        );
    }

    protected function link(): Attribute
    {
        return Attribute::make(
            get: fn() => Storage::temporaryUrl(
                "{$this->attributes['path']}/{$this->attributes['filename']}",
                now()->addMinutes(5)
            ),
            // get: fn() => dd($this->attributes),
        );
    }

    public function fileable(): MorphTo
    {
        return $this->morphTo();
    }
}
