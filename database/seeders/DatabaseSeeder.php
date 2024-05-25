<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Role;
use App\Models\Supplier;
use App\Models\Barang;
use App\Models\User;
use App\Models\JenisBarang;
use App\Models\Module;
use App\Models\SatuanBarang;

use function PHPSTORM_META\map;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $user = User::create([
            'role_id' => 1,
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123123')
        ]);

        $role = Role::create(['name' => 'Administrator']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        // Module::create([
        //     'nama' => 'Dashboard',
        // ]);
        // Module::create([
        //     'nama' => 'Transaksi',
        // ]);
        // Module::create([
        //     'nama' => 'Laporan',
        // ]);
        // Module::create([
        //     'nama' => 'Master User',
        // ]);
        // Module::create([
        //     'nama' => 'Master Data',
        // ]);

        // JenisBarang::create([
        //     'kode' => 'JB001',
        //     'nama' => 'Bibit',
        // ]);
        // JenisBarang::create([
        //     'kode' => 'JB002',
        //     'nama' => 'Pupuk',
        // ]);
        // JenisBarang::create([
        //     'kode' => 'JB003',
        //     'nama' => 'Insektisida',
        // ]);

        // SatuanBarang::create([
        //     'kode_nama' => 'Pohon',
        //     'nama' => 'Pohon',
        // ]);
        // SatuanBarang::create([
        //     'kode_nama' => 'Kg',
        //     'nama' => 'Kilogram',
        // ]);
        // SatuanBarang::create([
        //     'kode_nama' => 'Roll',
        //     'nama' => 'Roll',
        // ]);
        // SatuanBarang::create([
        //     'kode_nama' => 'Btl',
        //     'nama' => 'Botol',
        // ]);
        // SatuanBarang::create([
        //     'kode_nama' => 'Karung',
        //     'nama' => 'Karung',
        // ]);

        // Barang::create([
        //     'kode' => 'BR001',
        //     'barang_jenis_id' => 1,
        //     'barang_satuan_id' => 1,
        //     'nama' => 'Barang 1',
        // ]);

        // Barang::create([
        //     'kode' => 'BR002',
        //     'barang_jenis_id' => 1,
        //     'barang_satuan_id' => 1,
        //     'nama' => 'Barang 2',
        // ]);
        // Barang::create([
        //     'kode' => 'BR003',
        //     'barang_jenis_id' => 1,
        //     'barang_satuan_id' => 2,
        //     'nama' => 'Barang 3',
        // ]);
        // Barang::create([
        //     'kode' => 'BR004',
        //     'barang_jenis_id' => 1,
        //     'barang_satuan_id' => 3,
        //     'nama' => 'Barang 4',
        // ]);
        // Barang::create([
        //     'kode' => 'BR005',
        //     'barang_jenis_id' => 2,
        //     'barang_satuan_id' => 5,
        //     'nama' => 'Barang 5',
        // ]);
        // Barang::create([
        //     'kode' => 'BR006',
        //     'barang_jenis_id' => 2,
        //     'barang_satuan_id' => 3,
        //     'nama' => 'Barang 6',
        // ]);
        // Barang::create([
        //     'kode' => 'BR007',
        //     'barang_jenis_id' => 3,
        //     'barang_satuan_id' => 2,
        //     'nama' => 'Barang 7',
        // ]);
        // Supplier::create([
        //     'kode' => 'SP001',
        //     'nama' => 'Supplier 1',
        //     'alamat' => 'Lumajang',
        //     'no_rek' => '123123123',
        //     'no_hp' => '123123123',
        // ]);
        // Supplier::create([
        //     'kode' => 'SP002',
        //     'nama' => 'Supplier 2',
        //     'alamat' => 'Lumajang',
        //     'no_rek' => '123123123',
        //     'no_hp' => '123123123',
        // ]);

        // Customer::create([
        //     'kode' => 'CS001',
        //     'nama' => 'Customer 1',
        //     'alamat' => 'Lumajang',
        //     'no_hp' => '123123123',
        // ]);

        // Customer::create([
        //     'kode' => 'CS002',
        //     'nama' => 'Customer 2',
        //     'alamat' => 'Lumajang',
        //     'no_hp' => '123123123',
        // ]);
    }
}
