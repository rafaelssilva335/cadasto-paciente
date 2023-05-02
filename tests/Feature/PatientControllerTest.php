<?php

namespace Tests\Feature;

use Tests\TestCase;
use Faker\Factory as Faker;

class PatientControllerTest extends TestCase
{
    /**
     * Testa a função store do controlador PatientController.
     *
     * @return void
     */
    public function testStore()
    {
        $faker = Faker::create();

        $data = [
            'name' => $faker->name,
            'cpf' => $faker->numerify('###########'),
            'mother_name' => $faker->name('female'),
            'cns' => $faker->numerify('################'),
            'birthdate' => $faker->date('Y-m-d', '2005-01-01'),
            'photo' => null,
        ];

        $response = $this->post('/api/patients', $data);

        $response->assertStatus(201);
        $response->assertJson(['name' => $data['name']]);
    }
}
