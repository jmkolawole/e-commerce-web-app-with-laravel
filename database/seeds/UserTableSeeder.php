A.	UserTableSeeder
<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'Admin')->first();
        $role_author = Role::where('name', 'Author')->first();
        $role_user = Role::where('name', 'User')->first();


        $admin = new User();
        $admin->username = 'Admin';
        $admin->email = 'admin@example.com';
        $admin->active = 1;
        $admin->password = bcrypt('admin');
        $admin->save();
        $admin->roles()->attach($role_admin);


        $author = new User();
        $author->username = 'Author';
        $author->email = 'author@example.com';
        $admin->active = 1;
        $author->password = bcrypt('author');
        $author->save();
        $author->roles()->attach($role_author);


        $user = new User();
        $user->username = 'Visitor';
        $user->email = 'visitor@example.com';
        $admin->active = 1;
        $user->password = bcrypt('visitor');
        $user->save();
        $user->roles()->attach($role_user);


    }
}
