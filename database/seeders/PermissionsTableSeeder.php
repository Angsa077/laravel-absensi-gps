<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permission Admin
        Permission::create(['name' => 'admin.index', 'guard_name' => 'web']);

                // Permissions Karyawan
                Permission::create(['name' => 'karyawan.index', 'guard_name' => 'web']);
                Permission::create(['name' => 'karyawan.create', 'guard_name' => 'web']);
                Permission::create(['name' => 'karyawan.edit', 'guard_name' => 'web']);
                Permission::create(['name' => 'karyawan.delete', 'guard_name' => 'web']);
        
                // Permissions Permission
                Permission::create(['name' => 'permission.index', 'guard_name' => 'web']);
        
                // Permissions Role
                Permission::create(['name' => 'role.index', 'guard_name' => 'web']);
                Permission::create(['name' => 'role.create', 'guard_name' => 'web']);
                Permission::create(['name' => 'role.edit', 'guard_name' => 'web']);
                Permission::create(['name' => 'role.delete', 'guard_name' => 'web']);
        
                // Permissions Lokasi
                Permission::create(['name' => 'lokasi.index', 'guard_name' => 'web']);
        
                // Permissions Monitoring
                Permission::create(['name' => 'monitoring.index', 'guard_name' => 'web']);
        
                // Permissions Laporan
                Permission::create(['name' => 'laporan.absensi', 'guard_name' => 'web']);
                Permission::create(['name' => 'laporan.rekapabsensi', 'guard_name' => 'web']);
        
                // Permissions Izin
                Permission::create(['name' => 'izin.handle', 'guard_name' => 'web']);
                Permission::create(['name' => 'izin.cancel', 'guard_name' => 'web']);
    }
}
