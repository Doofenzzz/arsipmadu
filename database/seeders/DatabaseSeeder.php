<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Nasabah;
use App\Models\Kredit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // ======================
        // ADMIN (1 USER)
        // ======================
        User::create([
            'name' => 'Admin BPR Sarimadu',
            'email' => 'admin@bprsarimadu.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '08123456789',
            'address' => 'Jl. Raya Padang No. 123, Sumatra Barat',
        ]);

        // ======================
        // STAFF (20 USER)
        // ======================
        $staffIds = [];

        for ($i = 1; $i <= 20; $i++) {
            $staff = User::create([
                'name'    => $faker->name(),
                'email'   => "staff{$i}@bprsarimadu.com",
                'password'=> Hash::make('password'),
                'role'    => 'staff',
                'phone'   => $faker->phoneNumber(),
                'address' => $faker->address(),
            ]);

            $staffIds[] = $staff->id;
        }

        // ======================
        // NASABAH (20 DATA)
        // ======================
        $nasabahIds = [];

        for ($i = 1; $i <= 20; $i++) {
            $nasabah = Nasabah::create([
                'nama_lengkap'  => $faker->name(),
                'nik'           => $faker->nik(),
                'alamat'        => $faker->address(),
                'telepon'       => $faker->phoneNumber(),
                'email'         => $faker->unique()->safeEmail(),
                'tanggal_lahir' => $faker->date('Y-m-d', '2005-01-01'),
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'pekerjaan'     => $faker->randomElement(['Wiraswasta', 'PNS', 'Pegawai Swasta', 'Petani', 'Pedagang']),
                'penghasilan'   => $faker->numberBetween(3000000, 20000000),
                'user_id'       => $faker->randomElement($staffIds),
            ]);

            $nasabahIds[] = $nasabah->id;
        }

        // ======================
        // KREDIT RANDOM (1–3 per nasabah)
        // ======================
        $jenisKredit = ['KUR', 'KPR', 'Kredit Usaha', 'Kredit Konsumtif'];

        foreach ($nasabahIds as $nasabahId) {

            $jumlahKredit = rand(1, 3);

            for ($i = 1; $i <= $jumlahKredit; $i++) {

                Kredit::create([
                    'nasabah_id'        => $nasabahId,
                    'jenis_kredit'      => $faker->randomElement($jenisKredit),
                    'jumlah_pengajuan'  => $faker->numberBetween(10000000, 300000000),
                    'jangka_waktu'      => $faker->randomElement([12, 24, 36, 48, 60, 120]),
                    'bunga'             => $faker->randomFloat(2, 5, 12),
                    'tujuan_pengajuan'  => $faker->sentence(6),
                    'status'            => $faker->randomElement(['Pending', 'Disetujui', 'Ditolak']),
                    'catatan'           => $faker->boolean(50) ? $faker->sentence(8) : null,
                    'tanggal_pengajuan' => $faker->date('Y-m-d'),
                    'user_id'           => $faker->randomElement($staffIds),
                ]);
            }
        }

        // ======================
        // INFO CLI
        // ======================
        $this->command->info("🎉 Database Seeder Completed!");
        $this->command->info("🔐 Admin Login:");
        $this->command->info("Email: admin@bprsarimadu.com");
        $this->command->info("Password: password");
    }
}