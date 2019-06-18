<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        factory(User::class, 1)->create();

        $user = User::find(1);
        $user->name = "Spring";
        $user->email = 'springlight@126.com';
        $user->password = bcrypt('secret123');
        $user->save();

    }
}
