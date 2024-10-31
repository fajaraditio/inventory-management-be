<?php

namespace Database\Seeders;

use App\Models\ProjectReport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectReportsTableSeeder extends Seeder
{

    public function run(): void
    {
        $salesmen = ['Michael', 'Fajar', 'Agung', 'Desi'];
        $statuses = ['submitted', 'viewed', 'approved'];

        for ($i = 0; $i < 10; $i++) {
            ProjectReport::firstOrCreate(
                [
                    'salesman_name' => $salesmen[array_rand($salesmen)],
                    'title' => 'Laporan Proyek ' . Str::random(5),
                    'content' => 'Ini adalah laporan proyek ke-' . ($i + 1) . ' yang dikerjakan oleh ' . $salesmen[array_rand($salesmen)] . '. Proyek ini mencakup berbagai aspek penting dalam pelaksanaan tugas.',
                    'status' => $statuses[array_rand($statuses)],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
