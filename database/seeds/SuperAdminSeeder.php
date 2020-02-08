<?php

use App\Constants\AppConstants;
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

        $user = User::updateOrCreate(['email' => 'birendragurung007@gmail.com'],[
                'name'     => 'super admin' ,
                'password' => bcrypt('password') ,
                'role'     => AppConstants::ROLE_ADMIN,
            ]);
    }
}
