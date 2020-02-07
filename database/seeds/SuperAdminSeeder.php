<?php

use App\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $user = User::create(
            [
                'name' => 'super admin' ,
                'email' => 'birendragurung007@gmail.com' ,
                'password' => bcrypt('password') ,
            ]
        );
    }
}
