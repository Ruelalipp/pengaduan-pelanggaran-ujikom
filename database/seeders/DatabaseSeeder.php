<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Siswa;
use App\Models\Pelaku;
use App\Models\InputAspirasi;
use App\Models\Aspirasi;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin
        $admin = Admin::create([
            'username' => 'admin',
            'password' => 'password'
        ]);

        // Create Pelaku Types
        $pelakuSiswa = Pelaku::create(['type' => 'siswa']);
        $pelakuGuru = Pelaku::create(['type' => 'guru']);
        $pelakuStaff = Pelaku::create(['type' => 'staff']);

        // Create Sample Siswa
        $siswa1 = Siswa::create([
            'nis' => '12345',
            'kelas' => 'XII IPA 1',
            'username' => 'siswa001',
            'password' => 'password'
        ]);

        $siswa2 = Siswa::create([
            'nis' => '12346',
            'kelas' => 'XII IPA 2',
            'username' => 'siswa002',
            'password' => 'password'
        ]);

        $siswa3 = Siswa::create([
            'nis' => '12347',
            'kelas' => 'XI IPS 1',
            'username' => 'siswa003',
            'password' => 'password'
        ]);

        // Create Sample Input Aspirasi & Aspirasi
        $inputs = [
            [
                'siswa_id' => $siswa1->id,
                'pelaku_id' => $pelakuGuru->id,
                'keterangan' => 'Terdapat guru yang sering terlambat masuk kelas dan tidak memberikan pelajaran dengan baik. Hal ini sudah terjadi berulang kali dalam sebulan terakhir.',
                'status' => 'Menunggu'
            ],
            [
                'siswa_id' => $siswa1->id,
                'pelaku_id' => $pelakuSiswa->id,
                'keterangan' => 'Ada siswa yang sering melakukan bullying di kelas terhadap teman-teman sekelas. Korban sudah melapor ke wali kelas tapi belum ada tindakan.',
                'status' => 'Proses',
                'feedback' => 'Laporan sedang kami proses. Wali kelas dan BK sudah dipanggil untuk investigasi lebih lanjut.'
            ],
            [
                'siswa_id' => $siswa2->id,
                'pelaku_id' => $pelakuStaff->id,
                'keterangan' => 'Staff kantin sering memberikan makanan yang tidak fresh dan harga yang tidak sesuai dengan kualitas. Mohon ditindaklanjuti.',
                'status' => 'Selesai',
                'feedback' => 'Terima kasih atas laporannya. Kami sudah melakukan inspeksi ke kantin dan memberikan peringatan kepada pengelola kantin. Kualitas makanan akan terus dipantau.'
            ],
            [
                'siswa_id' => $siswa3->id,
                'pelaku_id' => $pelakuGuru->id,
                'keterangan' => 'Guru mapel matematika sering memberikan tugas yang berlebihan tanpa penjelasan yang cukup. Siswa kesulitan mengerjakan karena tidak paham materi.',
                'status' => 'Menunggu'
            ],
        ];

        foreach ($inputs as $input) {
            $inputAspirasi = InputAspirasi::create([
                'siswa_id' => $input['siswa_id'],
                'pelaku_id' => $input['pelaku_id'],
                'keterangan' => $input['keterangan'],
                'gambar' => null
            ]);

            Aspirasi::create([
                'input_aspirasi_id' => $inputAspirasi->id,
                'admin_id' => $admin->id,
                'status' => $input['status'],
                'feedback' => $input['feedback'] ?? null,
                'gambar' => null
            ]);
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('Admin: username=admin, password=password');
        $this->command->info('Siswa: username=siswa001/siswa002/siswa003 atau NIS=12345/12346/12347, password=password');
    }
}
