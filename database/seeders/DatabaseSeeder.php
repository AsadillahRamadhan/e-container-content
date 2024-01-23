<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\LoadingDock;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        for($i = 0; $i < 1500; $i++){
            $ld = new LoadingDock();
        $ld->title = '1';
        $ld->dr_number = '1';
        $ld->document_number = '1';
        $ld->size = '1';
        $ld->pt11 = '1';
        $ld->app_jpr = '1';
        $ld->total_set = '1';
        $ld->total_poly = '1';
        $ld->total_palet = '1';
        $ld->document_link = 'tes';
        $ld->date = Date::now();
        $ld->type = 'box';
        $ld->approved_by_ppc = 0;
        $ld->approved_by_admin = 0;
        $ld->save();
        }

        $this->call([
            UserSeeer::class
        ]);
    }
}
