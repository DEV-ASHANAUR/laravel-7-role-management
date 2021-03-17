<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::where('email','superadmin@gmail.com')->first();
        if(is_null($admin)){
            $admin = new Admin();
            $admin->name = 'Supper Admin';
            $admin->username = 'superadmin';
            $admin->email = 'superadmin@gmail.com';
            $admin->status = 1;
            $admin->password = Hash::make('12345678');
            $admin->assignRole('superadmin');
            $admin->save();
        }
    }
}
