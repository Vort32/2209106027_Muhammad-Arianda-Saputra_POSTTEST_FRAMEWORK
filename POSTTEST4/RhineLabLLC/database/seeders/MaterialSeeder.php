<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        Material::insert([
            [
                'name' => 'Module Data',
                'size' => '2 MB',
                'type' => 'Disk',
                'category' => 'Data',
                'file_path' => 'images/materials/Module_Data_Block.png', 
            ],
            [
                'name' => 'Battle Record',
                'size' => '1.2 MB',
                'type' => 'PDF',
                'category' => 'Data',
                'file_path' => 'images/materials/Strategic_Battle_Record.png',
            ],
            [
                'name' => 'Summary ',
                'size' => '800 KB',
                'type' => 'PDF',
                'category' => 'Research',
                'file_path' => 'images/materials/Skill_Summary_Volume_2.png',
            ],
            [
                'name' => 'Orirock_Cube',
                'size' => '350 KB',
                'type' => 'Material',
                'category' => 'Materials',
                'file_path' => 'images/materials/Orirock_Cube.png', 
            ],
            [
                'name' => 'Device_Chipset',
                'size' => '1.1 MB',
                'type' => 'Image',
                'category' => 'Engineering',
                'file_path' => 'images/materials/Device.png',
            ],
        ]);
    }
}
