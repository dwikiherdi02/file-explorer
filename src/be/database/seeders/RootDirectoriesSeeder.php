<?php

namespace Database\Seeders;

use App\Models\Directory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RootDirectoriesSeeder extends Seeder
{
    protected const DATA = [
        [
            'name' => 'Documents',
            'image' => 'storage/icons/document-folder.png',
            'breadcrumbs' => '',
            'is_root' => true,
        ],
        [
            'name' => 'Music',
            'image' => 'storage/icons/music-folder',
            'breadcrumbs' => '',
            'is_root' => true,
        ],
        [
            'name' => 'Pictures',
            'image' => 'storage/icons/picture-folder',
            'breadcrumbs' => '',
            'is_root' => true,
        ],
        [
            'name' => 'Videos',
            'image' => 'storage/icons/video-folder',
            'breadcrumbs' => '',
            'is_root' => true,
        ],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Directory::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        foreach (self::DATA as $data) {
            $directory = Directory::create($data);

            $directory->fill([
                'breadcrumbs' => [
                    strtolower($directory->name) => $directory->name
                ],
            ])->save();
        }
    }
}
