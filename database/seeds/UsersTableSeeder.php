<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // use faker
        $faker = Faker\Factory::create('ja_JP');

        // 固定ユーザーを作成
        DB::table('users')->insert([
            'name' => 'user001',
            'email' => 'user001@test.com',
            'password' => bcrypt('user001'),
            'lang' => 'ja',
            'email_verified_at' => $faker->dateTime(),
            'created_at' => $faker->dateTime(),
            'updated_at' => $faker->dateTime(),

        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('admin'),
            'lang' => 'ja',
            'email_verified_at' => $faker->dateTime(),
            'created_at' => $faker->dateTime(),
            'updated_at' => $faker->dateTime(),
        ]);

        //ランダムにユーザーを生成
        for ($i = 0; $i < 18; $i++ )
        {
            DB::table('users')->insert([
                'name' => $faker->unique()->userName(),
                'email' => $faker->unique()->email(),
                'password' => bcrypt('1234'),
                'lang' => $faker->randomElement(['en', 'ja']),
                'email_verified_at' => $faker->dateTime(),
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
            ]);
        }
    }
}
