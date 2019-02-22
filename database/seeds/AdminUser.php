<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Profile;
class AdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /* Start Create All Roles */
        $role1 = Role::create([
            'name' => 'admin',
            'description' => 'Admin Role'
        ]);
        $role2 = Role::create([
            'name' => 'seller',
            'description' => ' Seller Role'
        ]);
        $role3 = Role::create([
            'name' => 'employee',
            'description' => ' Employee Role'
        ]);
        $role4 = Role::create([
        	'name' => 'customer',
        	'description' => ' Customer Role'
        ]);
        /* End Create All Roles */

        /* Start Create Admin */
        $user1 = User::create([
        	'email' => 'admin@domain.com',
        	'password' => bcrypt('secret'),
        	'role_id' => $role1->id,
        ]);
        Profile::create([
        	'user_id' => $user1->id
        ]);
        /* End Create Admin */

        /* Start Create Vendor */
        $user2 = User::create([
            'email' => 'seller@domain.com',
            'password' => bcrypt('secret'),
            'role_id' => $role2->id,
        ]);
        Profile::create([
            'user_id' => $user2->id
        ]);
        /* End Create Vendor */

        /* Start Create Employee */
        $user3 = User::create([
            'email' => 'employee@domain.com',
            'password' => bcrypt('secret'),
            'role_id' => $role3->id,
        ]);
        Profile::create([
            'user_id' => $user3->id
        ]);
        /* End Create Employee */

        /* Start Create Customer */
        $user4 = User::create([
            'email' => 'customer@domain.com',
            'password' => bcrypt('secret'),
            'role_id' => $role4->id,
        ]);
        Profile::create([
            'user_id' => $user4->id
        ]);
        /* End Create Customer */
    }
}
