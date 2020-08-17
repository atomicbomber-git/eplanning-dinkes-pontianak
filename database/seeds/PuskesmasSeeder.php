<?php

use App\Constants\UserLevel;
use App\Puskesmas;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            $usernameOrPassword = "puskesmas_{$i}";
            $user = factory(User::class)->create([
                "name" => "Admin " . Str::title($usernameOrPassword),
                "username" => $usernameOrPassword,
                "password" => Hash::make($usernameOrPassword),
                "level" => UserLevel::ADMIN_PUSKESMAS,
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
