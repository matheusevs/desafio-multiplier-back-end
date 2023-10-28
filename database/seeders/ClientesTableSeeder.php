<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

use Illuminate\Database\Seeder;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 50; $i++) {
            DB::table('clientes')->insert([
                'nomeFantasia' => $faker->company,
                'cnpj' => $faker->unique()->numerify('##.###.###/####-##'),
                'endereco' => $faker->streetAddress,
                'cidade' => $faker->city,
                'estado' => $faker->stateAbbr,
                'pais' => 'Brasil',
                'telefone' => $faker->numerify('(##) ####-####'),
                'email' => $faker->unique()->safeEmail,
                'areaAtuacao' => $faker->word,
                'quadroSocietario' => $faker->name,
            ]);
        }
    }
}
