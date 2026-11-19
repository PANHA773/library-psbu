<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $provinces = [
            ['khmer' => 'បន្ទាយមានជ័យ', 'aliases' => ['Banteay Meanchey']],
            ['khmer' => 'បាត់ដំបង', 'aliases' => ['Battambang']],
            ['khmer' => 'កំពង់ចាម', 'aliases' => ['Kampong Cham', 'Kompong Cham']],
            ['khmer' => 'កំពង់ឆ្នាំង', 'aliases' => ['Kampong Chhnang', 'Kompong Chhnang']],
            ['khmer' => 'កំពង់ស្ពឺ', 'aliases' => ['Kampong Speu', 'Kompong Speu']],
            ['khmer' => 'កំពង់ធំ', 'aliases' => ['Kampong Thom', 'Kompong Thom']],
            ['khmer' => 'កំពត', 'aliases' => ['Kampot']],
            ['khmer' => 'កណ្ដាល', 'aliases' => ['Kandal']],
            ['khmer' => 'កោះកុង', 'aliases' => ['Koh Kong']],
            ['khmer' => 'ក្រចេះ', 'aliases' => ['Kratie']],
            ['khmer' => 'មណ្ឌលគិរី', 'aliases' => ['Mondul Kiri', 'Mondulkiri']],
            ['khmer' => 'រាជធានីភ្នំពេញ', 'aliases' => ['Phnom Penh']],
            ['khmer' => 'ព្រះវិហារ', 'aliases' => ['Preah Vihear']],
            ['khmer' => 'ព្រៃវែង', 'aliases' => ['Prey Veng']],
            ['khmer' => 'ពោធិ៍សាត់', 'aliases' => ['Pursat']],
            ['khmer' => 'រតនគិរី', 'aliases' => ['Ratanak Kiri', 'Ratanakiri']],
            ['khmer' => 'សៀមរាប', 'aliases' => ['Siem Reap', 'Siemreap']],
            ['khmer' => 'ព្រះសីហនុ', 'aliases' => ['Preah Sihanouk', 'Sihanoukville']],
            ['khmer' => 'ស្ទឹងត្រែង', 'aliases' => ['Stung Treng']],
            ['khmer' => 'ស្វាយរៀង', 'aliases' => ['Svay Rieng', 'Svay rieng']],
            ['khmer' => 'តាកែវ', 'aliases' => ['Takeo']],
            ['khmer' => 'ឧត្ដរមានជ័យ', 'aliases' => ['Oddar Meanchey']],
            ['khmer' => 'កែប', 'aliases' => ['Kep']],
            ['khmer' => 'ប៉ៃលិន', 'aliases' => ['Pailin']],
            ['khmer' => 'ត្បូងឃ្មុំ', 'aliases' => ['Tboung Khmum', 'Tbong Khmum']],
        ];

        DB::transaction(function () use ($provinces): void {
            $existing = DB::table('provinces')->get(['id', 'name']);

            foreach ($provinces as $province) {
                $aliases = array_map('mb_strtolower', $province['aliases']);
                $match = $existing->first(function ($row) use ($aliases, $province): bool {
                    $name = trim((string) $row->name);

                    return mb_strtolower($name) === mb_strtolower($province['khmer'])
                        || in_array(mb_strtolower($name), $aliases, true);
                });

                if ($match) {
                    DB::table('provinces')->where('id', $match->id)->update([
                        'name' => $province['khmer'],
                    ]);

                    continue;
                }

                DB::table('provinces')->insert([
                    'name' => $province['khmer'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });
    }

    public function down(): void
    {
        // Keep province rows because students may already reference them.
    }
};
