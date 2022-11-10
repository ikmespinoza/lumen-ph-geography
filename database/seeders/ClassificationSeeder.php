<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Classification;

class ClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classifications = array_merge(config('constants.classifications.municipality'), config('constants.classifications.city'));

        foreach ($classifications as $key => $value) {
            Classification::create(array(
                'code' => $key,
                'description' => $value
            ));
        }

        $this->command->info('Classification entries added!');
    }
}
