<?php

use Illuminate\Database\Seeder;
use App\Entity\Store\Provider\Provider;

class ProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Provider::class, 25)->create();
    }
}
