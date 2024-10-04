<?php

namespace Database\Seeders;

use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Stage;
use App\Models\Course;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // default data

        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role_id' => $adminRole->id,
            'phone' => '01000000000',
            'guardian_phone' => '01000000000',
            'avatar' => 'images/avatar.png',
            'address' => 'Cairo',
            'gender' => 'male',
            'birth_date' => '2000-01-01',
            'address_description' => 'Cairo',
            'city' => 'Cairo',
            'state' => 'Cairo',
        ]);
        // $user = User::create([
        //     'name' => 'User',
        //     'email' => 'user@gmail.com',
        //     'password' => Hash::make('12345678'),
        //     'role_id' => $userRole->id,
        // ]);

        // create permission for users
        $createUserPermission = Permission::create(['name' => 'create', 'table_name' => 'users']);
        $updateUserPermission = Permission::create(['name' => 'update', 'table_name' => 'users']);
        $deleteUserPermission = Permission::create(['name' => 'delete', 'table_name' => 'users']);
        $SoftDeleteUserPermission = Permission::create(['name' => 'soft-delete', 'table_name' => 'users']);
        $viewUserPermission = Permission::create(['name' => 'view', 'table_name' => 'users']);
        $restoreUserPermission = Permission::create(['name' => 'restore', 'table_name' => 'users']);

        // create permission for courses
        $createCoursePermission = Permission::create(['name' => 'create', 'table_name' => 'courses']);
        $updateCoursePermission = Permission::create(['name' => 'update', 'table_name' => 'courses']);
        $deleteCoursePermission = Permission::create(['name' => 'delete', 'table_name' => 'courses']);
        $SoftDeleteCoursePermission = Permission::create(['name' => 'soft-delete', 'table_name' => 'courses']);
        $viewCoursePermission = Permission::create(['name' => 'view', 'table_name' => 'courses']);
        $restoreCoursePermission = Permission::create(['name' => 'restore', 'table_name' => 'courses']);

        // create permission for roles
        $createRolePermission = Permission::create(['name' => 'create', 'table_name' => 'roles']);
        $updateRolePermission = Permission::create(['name' => 'update', 'table_name' => 'roles']);
        $deleteRolePermission = Permission::create(['name' => 'delete', 'table_name' => 'roles']);
        $SoftDeleteRolePermission = Permission::create(['name' => 'soft-delete', 'table_name' => 'roles']);
        $viewRolePermission = Permission::create(['name' => 'view', 'table_name' => 'roles']);
        $restoreRolePermission = Permission::create(['name' => 'restore', 'table_name' => 'roles']);


        // create default stages
        $stage1 = Stage::create(['name' => 'اولى ثانوي']);
        $stage2 = Stage::create(['name' => 'ثانية ثانوي']);
        $stage3 = Stage::create(['name' => 'ثالثة ثانوي']);


        // attach permissions to admin
        $adminRole->permissions()->attach([
            $createUserPermission->id,
            $updateUserPermission->id,
            $deleteUserPermission->id,
            $SoftDeleteUserPermission->id,
            $viewUserPermission->id,
            $restoreUserPermission->id,
            $createCoursePermission->id,
            $updateCoursePermission->id,
            $deleteCoursePermission->id,
            $SoftDeleteCoursePermission->id,
            $viewCoursePermission->id,
            $restoreCoursePermission->id,
            $createRolePermission->id,
            $updateRolePermission->id,
            $deleteRolePermission->id,
            $SoftDeleteRolePermission->id,
            $viewRolePermission->id,
            $restoreRolePermission->id,
        ]);


        // seed data for test courses 10 courses some of theme active and some of them inactive and some of them child courses
        for ($i = 0; $i < 10; $i++) {
            $price = 100 * $i;
            $discount = $i == 0 ? 10 : null;
            $net_price = $price - ($price * $discount / 100);
            $course = Course::create([
                'title' => 'Course ' . $i,
                'sub_title' => 'Sub Title ' . $i,
                'description' => 'Description ' . $i,
                'price' => $price,
                'discount' => $discount,
                'net_price' => $net_price,
                'status' => $i == 0 ? 'inactive' : 'active',
                'parent_id' => ($i >= 2) ? 1 : null,
                // 'data' => [
                //     'duration' => '10 hours',
                //     'level' => 'beginner',
                //     'language' => 'Arabic',
                //     'certificate' => 'yes',
                // ],
                'thumbnail' => 'images/hero1.jpg',
                'featured_video' => 'https://www.youtube.com/embed/XbVBHyK9Nxw',
            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            $user = User::create([
                'first_name' => 'User ' . $i,
                'last_name' => 'User ' . $i,
                'email' => 'user' . $i . '@gmail.com',
                'password' => Hash::make('12345678'),
                'role_id' => $userRole->id,
                'avatar' => 'images/avatar.png',
                'phone' => '010000000' . $i,
                'guardian_phone' => '010000000' . $i,
                'address' => 'Cairo',
                'gender' => 'male',
                'birth_date' => '2000-01-01',
                'address_description' => 'Cairo',
                'city' => 'Cairo',
                'state' => 'Cairo',
            ]);
        }
    }
}
