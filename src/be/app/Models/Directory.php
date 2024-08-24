<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Directory extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'directories';

    protected $fillable = [
        'parent_id',
        'root_id',
        'root_dir',
        'name',
        'image',
        'breadcrumbs',
        'is_root',
    ];
    protected function casts(): array
    {
        return [
            'breadcrumbs' => Json::class,
        ];
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => url($value),
        );
    }

    /**
     * Get the rootdir associated with the Directory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rootdir(): HasOne
    {
        return $this->hasOne(Directory::class, 'name', 'root_dir');
    }

    /**
     * Get all of the sub directories for the Directory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subdir(): HasMany
    {
        return $this->hasMany(Directory::class, 'parent_id', 'id');
    }

    /**
     * Get the parentdir associated with the Directory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parentdir(): HasOne
    {
        return $this->hasOne(Directory::class, 'id', 'parent_id');
    }

}
