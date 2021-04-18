<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Traits\HasRoleAndPermissions;
use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    use HasRoleAndPermissions;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Permission::updateOrCreate(['name' => 'edit post']);
        Permission::updateOrCreate(['name' => 'delete post']);
        Permission::updateOrCreate(['name' => 'publish post']);
        Permission::updateOrCreate(['name' => 'unpublish post']);

        $admin = Role::updateOrCreate(['name' => 'admin']);
        $admin->permissions()->attach(Permission::all());

        $moderator = Role::updateOrCreate(['name' => 'moderator']);

        $id_publish = Permission::get()->where('name', 'publish post')->first();
        $id_unpublish = Permission::get()->where('name', 'unpublish post')->first();

        $moderator->permissions()->attach($id_publish);
        $moderator->permissions()->attach($id_unpublish);
    }
}
