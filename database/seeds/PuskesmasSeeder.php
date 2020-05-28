<?php

use App\Puskesmas;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PuskesmasSeeder extends Seeder
{
    const N_TO_BE_SEEDED = 10;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var \Faker\Generator $faker */
        $faker = app(\Faker\Generator::class);

        DB::beginTransaction();

        for ($i = 0; $i < static::N_TO_BE_SEEDED; ++$i) {

            $username_slash_password = "puskesmas_{$i}";
            $user = factory(User::class)->create([
                "name" => "Admin " . \Illuminate\Support\Str::title($username_slash_password),
                "username" => $username_slash_password,
                "password" => Hash::make($username_slash_password),
            ]);

            Puskesmas::query()->create([
                "user_id" => $user->id,
                "nama" => "Puskesmas " . ($i + 1),
                "alamat" => $faker->address,
            ]);
        }

        DB::commit();
    }
}
