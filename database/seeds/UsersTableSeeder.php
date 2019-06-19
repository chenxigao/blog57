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
        $user->password = '$2a$10$q/6bQTlDVy080q1d5zX0E.ks/H4Xi2fEL/8oY8KMS/agvYQeaaF3u';
        $user->save();

    }
}
