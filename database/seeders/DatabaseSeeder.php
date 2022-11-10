<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\Helpers\WebScraper;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ungard model
        Schema::disableForeignKeyConstraints();

        // Ask for db migration refresh, default is no
        if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data?')) {
  
            // Call the php artisan migrate:fresh using Artisan
            $this->command->call('migrate:refresh');
  
            $this->command->line('Database cleared.');
        }

        $this->call(ClassificationSeeder::class);
        WebScraper::scrape(config('constants.source.iso3166.name'));

        // Re Guard model
        Schema::enableForeignKeyConstraints();
    }
}
