<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        // Order important hai: top se bottom tak
        $this->importCsv(base_path('database/data/provinces.csv'), 'provinces');
        $this->importCsv(base_path('database/data/divisions.csv'), 'divisions');
        $this->importCsv(base_path('database/data/districts.csv'), 'districts');
        $this->importCsv(base_path('database/data/tehsils.csv'), 'tehsils');
        $this->importCsv(base_path('database/data/sub_tehsils.csv'), 'sub_tehsils');
        $this->importCsv(base_path('database/data/union_councils.csv'), 'union_councils');
    }

    /**
     * Generic CSV → table import.
     *
     * Har CSV ka structure: id,name,parent_id
     */
    protected function importCsv(string $path, string $table): void
{
    if (!file_exists($path)) {
        if ($this->command) {
            $this->command->warn("File not found: {$path}");
        }
        return;
    }

    $handle = fopen($path, 'r');

    // Header row read karein (id,name,parent_id)
    $header = fgetcsv($handle);

    if ($header === false) {
        if ($this->command) {
            $this->command->warn("Empty CSV: {$path}");
        }
        fclose($handle);
        return;
    }

    $rows = [];
    while (($data = fgetcsv($handle)) !== false) {
        $row = array_combine($header, $data);

        // Basic validation
        if (!isset($row['id'], $row['name'])) {
            continue;
        }

        $rows[] = [
            'id'         => (int) $row['id'],
            'name'       => $row['name'],
            'parent_id'  => ($row['parent_id'] ?? '') !== '' ? (int) $row['parent_id'] : null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    fclose($handle);

    if (count($rows)) {
        DB::table($table)->insert($rows);
        if ($this->command) {
            $this->command->info('Imported '.count($rows).' rows into '.$table);
        }
    } else {
        if ($this->command) {
            $this->command->warn("No data rows in {$path}");
        }
    }
}}