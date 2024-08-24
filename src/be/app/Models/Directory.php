<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Directory extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'directories';

    protected $fillable = [
        'parent_id',
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

    /**
     * Get all of the sub directories for the Directory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subdir(): HasMany
    {
        return $this->hasMany(Directory::class, 'id', 'parent_id');
    }

}
