<?php

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'id' => 1,
            'no_status' => 'Ativo'
        ]);

        Status::create([
            'id' => 2,
            'no_status' => 'Inativo'
        ]);
    }
}
