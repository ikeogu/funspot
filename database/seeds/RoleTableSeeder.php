<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        App\Role::insert([
             
            'name' => 'Admin ',
            'description' => 'the overall controller of the site',
            
        ]);
        App\Role::insert([
             
            'name' => 'Moderator ',
            'description' => 'overseas progrss of the site',
            
        ]);
        App\Role::insert([
             
            'name' => 'User',
            'description' => 'Normal user that uploads video, likes video and more',
            
        ]);
    }
}
