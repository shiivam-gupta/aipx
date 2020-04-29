<?php

use Illuminate\Database\Seeder;
use App\UserRole;
use DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            "role" => 'Admin',
            "role" => 'Doctor',
            "role" => 'Patients',
            
        ];
        
        foreach($items as $item){
            DB::table('user_roles')->create($item);
        }

    }
}
