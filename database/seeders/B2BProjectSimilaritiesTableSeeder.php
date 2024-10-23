<?php

namespace Database\Seeders;

use App\Models\B2BProject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class B2BProjectSimilaritiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        B2BProject::firstOrCreate([
            'project_code' => 1001,
            'salesman_name' => 'Michael',
            'project_name' => 'RS Pluit',
            'project_type' => 'Hotel',
            'province_name' => 'Jakarta',
            'city_name' => 'Jakarta Utara',
            'district_name' => 'Penjaringan',
            'sub_district_name' => 'Penjaringan',
            'detail_address' => 'Jl. Pluit Indah',
            'latitude' => -6.12162081,
            'longitude' => 106.7846565,
            'item_snapshot' => 'GWC-05CS',
            'total_amount' => 10000000
        ]);

        B2BProject::firstOrCreate([
            'project_code' => 1001,
            'salesman_name' => 'Fajar',
            'project_name' => 'Rumah Sakit Pluit',
            'project_type' => 'Rumah Sakit',
            'province_name' => 'Jakarta',
            'city_name' => 'Jakarta Utara',
            'district_name' => 'Penjaringan',
            'sub_district_name' => 'Pluit',
            'detail_address' => 'Jl. Pluit Sel. No. 2',
            'latitude' => -6.125653169,
            'longitude' => 106.799355,
            'item_snapshot' => 'GWC-05CS',
            'total_amount' => 15000000
        ]);

        B2BProject::firstOrCreate([
            'project_code' => 1001,
            'salesman_name' => 'Ganesia',
            'project_name' => 'Rumah Sakit PIK',
            'project_type' => 'Rumah Sakit',
            'province_name' => 'Jakarta',
            'city_name' => 'Jakarta Utara',
            'district_name' => 'Penjaringan',
            'sub_district_name' => 'Pluit',
            'detail_address' => 'Jl. Pluit Sel. No. 2',
            'latitude' => -6.12162081,
            'longitude' => 106.7846565,
            'item_snapshot' => 'GWC-06AM',
            'total_amount' => 12000000
        ]);
    }
}
