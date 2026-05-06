<?php
namespace Database\Seeders;
use App\Models\{User, Kategori, Produk};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'name'     => 'Admin Tahu',
            'email'    => 'admin@tokotahu.com',
            'password' => bcrypt('admin123'),
            'role'     => 'admin',
        ]);

        // Customer contoh
        User::create([
            'name'     => 'alief mufqi',
            'email'    => 'alief@email.com',
            'password' => bcrypt('alief123'),
            'role'     => 'customer',
        ]);

        // Kategori
        $k1 = Kategori::create(['nama' => 'Tahu Mentah',  'slug' => 'tahu-mentah',  'deskripsi' => 'Tahu segar siap dimasak']);
        $k2 = Kategori::create(['nama' => 'Tahu Olahan',  'slug' => 'tahu-olahan',  'deskripsi' => 'Tahu siap saji']);
        $k3 = Kategori::create(['nama' => 'Tahu Premium', 'slug' => 'tahu-premium', 'deskripsi' => 'Tahu kualitas terbaik']);

        // Produk
        $produks = [
            ['nama' => 'Tahu Putih Segar',     'kategori_id' => $k1->id, 'harga' => 5000,  'stok' => 100, 'satuan' => 'bungkus'],
            ['nama' => 'Tahu Kuning',           'kategori_id' => $k1->id, 'harga' => 6000,  'stok' => 80,  'satuan' => 'bungkus'],
            ['nama' => 'Tahu Goreng Crispy',    'kategori_id' => $k2->id, 'harga' => 8000,  'stok' => 50,  'satuan' => 'bungkus'],
            ['nama' => 'Tahu Bacem',            'kategori_id' => $k2->id, 'harga' => 10000, 'stok' => 40,  'satuan' => 'bungkus'],
            ['nama' => 'Tahu Sutra Premium',    'kategori_id' => $k3->id, 'harga' => 15000, 'stok' => 30,  'satuan' => 'kg'],
            ['nama' => 'Tahu Organik Non-GMO',  'kategori_id' => $k3->id, 'harga' => 20000, 'stok' => 20,  'satuan' => 'kg'],
        ];

        foreach ($produks as $p) {
            Produk::create(array_merge($p, [
                'slug'      => \Illuminate\Support\Str::slug($p['nama']),
                'deskripsi' => 'Tahu berkualitas tinggi dari pengrajin lokal terpercaya.',
                'aktif'     => true,
            ]));
        }
    }
}