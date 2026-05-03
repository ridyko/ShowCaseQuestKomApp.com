<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Category;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@showcase.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Demo User
        $user = User::create([
            'name' => 'Developer',
            'email' => 'dev@showcase.test',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Create Categories
        $categories = [
            [
                'name' => 'Web Application',
                'slug' => 'web-application',
                'icon' => 'fa-globe',
                'color' => '#6366f1',
                'description' => 'Aplikasi web berbasis browser',
            ],
            [
                'name' => 'Management System',
                'slug' => 'management-system',
                'icon' => 'fa-building',
                'color' => '#8b5cf6',
                'description' => 'Sistem manajemen dan administrasi',
            ],
            [
                'name' => 'E-Learning',
                'slug' => 'e-learning',
                'icon' => 'fa-graduation-cap',
                'color' => '#06b6d4',
                'description' => 'Platform pembelajaran digital',
            ],
            [
                'name' => 'IoT & Hardware',
                'slug' => 'iot-hardware',
                'icon' => 'fa-microchip',
                'color' => '#10b981',
                'description' => 'Proyek Internet of Things dan perangkat keras',
            ],
            [
                'name' => 'Mobile App',
                'slug' => 'mobile-app',
                'icon' => 'fa-mobile-alt',
                'color' => '#f59e0b',
                'description' => 'Aplikasi mobile Android/iOS',
            ],
            [
                'name' => 'API Service',
                'slug' => 'api-service',
                'icon' => 'fa-code',
                'color' => '#ef4444',
                'description' => 'RESTful API dan microservices',
            ],
        ];

        foreach ($categories as $i => $cat) {
            $cat['sort_order'] = $i;
            Category::create($cat);
        }

        // Create Sample Applications
        $apps = [
            [
                'user_id' => $admin->id,
                'category_id' => 1,
                'name' => 'Buku Tamu Digital',
                'slug' => 'bukutamu',
                'tagline' => 'Sistem manajemen tamu digital modern untuk instansi',
                'description' => 'Aplikasi Buku Tamu Digital adalah solusi modern untuk mengelola kunjungan tamu di kantor, sekolah, dan instansi pemerintah. Dilengkapi dengan fitur QR Code check-in, digital signature, notifikasi WhatsApp real-time, dan dashboard analitik yang komprehensif.',
                'content' => "## Fitur Utama\n\n- ✅ Check-in tamu via QR Code\n- ✅ Tanda tangan digital\n- ✅ Notifikasi WhatsApp real-time\n- ✅ Dashboard analitik\n- ✅ Export laporan PDF & Excel\n- ✅ Multi-tenant / White Label\n- ✅ Role-based access control\n\n## Teknologi\n\nDibangun dengan Laravel 11 dan PHP 8.3, menggunakan arsitektur MVC yang bersih dan terstruktur.\n\n## Instalasi\n\n```bash\ncomposer install\nphp artisan migrate --seed\nphp artisan serve\n```",
                'tech_stack' => ['Laravel 11', 'PHP 8.3', 'MySQL', 'Bootstrap 5', 'Chart.js', 'QR Code', 'WhatsApp API'],
                'features' => ['QR Check-in', 'Digital Signature', 'WhatsApp Notifications', 'PDF Reports', 'Excel Export', 'Multi-tenant', 'Activity Log'],
                'version' => '2.1.0',
                'status' => 'published',
                'is_featured' => true,
                'sort_order' => 0,
                'view_count' => 1250,
                'published_at' => now()->subDays(30),
            ],
            [
                'user_id' => $admin->id,
                'category_id' => 2,
                'name' => 'E-Cuti Application',
                'slug' => 'e-cuti',
                'tagline' => 'Sistem pengajuan dan manajemen cuti pegawai online',
                'description' => 'E-Cuti adalah aplikasi manajemen cuti pegawai berbasis web yang memudahkan proses pengajuan, persetujuan, dan tracking cuti secara digital. Mendukung berbagai jenis cuti, hierarki persetujuan, dan pelaporan otomatis.',
                'content' => "## Tentang E-Cuti\n\nSistem manajemen cuti yang efisien untuk organisasi modern.\n\n## Fitur\n\n- 📋 Pengajuan cuti online\n- ✅ Approval bertingkat\n- 📊 Dashboard rekapitulasi\n- 📱 Responsive design\n- 🔔 Notifikasi email\n- 📄 Export rekapitulasi Excel",
                'tech_stack' => ['Laravel 11', 'PHP 8.3', 'MySQL', 'AdminLTE', 'DataTables', 'SweetAlert2'],
                'features' => ['Online Leave Request', 'Multi-level Approval', 'Leave Balance Tracking', 'Report Generation', 'Email Notifications', 'Role Management'],
                'version' => '1.5.0',
                'status' => 'published',
                'is_featured' => true,
                'sort_order' => 1,
                'view_count' => 890,
                'published_at' => now()->subDays(20),
            ],
            [
                'user_id' => $admin->id,
                'category_id' => 2,
                'name' => 'Evakin Performance',
                'slug' => 'evakin',
                'tagline' => 'Evaluasi kinerja pegawai berbasis SKP dan capaian target',
                'description' => 'Evakin adalah sistem evaluasi kinerja pegawai yang mengacu pada standar SKP (Sasaran Kerja Pegawai). Mendukung input target, realisasi, dan perhitungan otomatis nilai kinerja dengan dashboard analitik.',
                'content' => "## Evakin - Evaluasi Kinerja\n\nSistem evaluasi kinerja pegawai berbasis web.\n\n## Fitur Utama\n\n- 🎯 Input target SKP\n- 📊 Tracking realisasi\n- 📈 Perhitungan otomatis\n- 📋 Laporan periodik\n- 👥 Penilaian 360°",
                'tech_stack' => ['Laravel 11', 'PHP 8.3', 'MySQL', 'Bootstrap 5', 'Chart.js', 'DomPDF'],
                'features' => ['SKP Management', 'Target Tracking', 'Auto Calculation', 'Periodic Reports', 'Performance Dashboard', '360° Assessment'],
                'version' => '1.2.0',
                'status' => 'published',
                'is_featured' => true,
                'sort_order' => 2,
                'view_count' => 675,
                'published_at' => now()->subDays(15),
            ],
            [
                'user_id' => $user->id,
                'category_id' => 2,
                'name' => 'Harwat Sarpras',
                'slug' => 'harwat-sarpras',
                'tagline' => 'Sistem pemeliharaan sarana dan prasarana digital',
                'description' => 'Harwat Sarpras adalah aplikasi manajemen pemeliharaan sarana dan prasarana yang mencakup inventaris aset, work order, dan helpdesk maintenance. Dilengkapi dengan QR Code tracking dan dashboard monitoring.',
                'content' => "## Harwat Sarpras\n\nSistem pemeliharaan sarana dan prasarana terpadu.\n\n## Modul\n\n- 🏢 Inventaris Aset\n- 🔧 Work Order\n- 📱 QR Code Tracking\n- 🎫 Helpdesk\n- 📊 Dashboard Monitoring",
                'tech_stack' => ['Laravel 12', 'PHP 8.2', 'MySQL', 'Tailwind CSS', 'Alpine.js', 'QR Code'],
                'features' => ['Asset Inventory', 'Work Orders', 'QR Tracking', 'Helpdesk System', 'Maintenance Schedule', 'Report Generation'],
                'version' => '1.0.0',
                'status' => 'published',
                'is_featured' => false,
                'sort_order' => 3,
                'view_count' => 340,
                'published_at' => now()->subDays(5),
            ],
            [
                'user_id' => $user->id,
                'category_id' => 6,
                'name' => 'WhatsApp Gateway',
                'slug' => 'wa-gateway',
                'tagline' => 'API Gateway untuk integrasi pesan WhatsApp',
                'description' => 'WhatsApp Gateway API service yang memungkinkan aplikasi mengirim pesan WhatsApp secara otomatis. Mendukung multi-device, template messages, dan webhook integration.',
                'content' => "## WA Gateway\n\nRESTful API untuk integrasi WhatsApp.\n\n## Endpoints\n\n- POST /api/send-message\n- POST /api/send-template\n- GET /api/status\n- POST /api/webhook",
                'tech_stack' => ['Node.js', 'Express', 'Baileys', 'MySQL', 'Socket.io'],
                'features' => ['Send Messages', 'Template Messages', 'Multi-device', 'Webhook', 'Message Queue', 'Rate Limiting'],
                'version' => '2.0.0',
                'status' => 'published',
                'is_featured' => false,
                'sort_order' => 4,
                'view_count' => 520,
                'published_at' => now()->subDays(10),
            ],
            [
                'user_id' => $admin->id,
                'category_id' => 1,
                'name' => 'Koperasi Online',
                'slug' => 'koperasi',
                'tagline' => 'Sistem informasi koperasi simpan pinjam',
                'description' => 'Aplikasi koperasi simpan pinjam online yang mengelola anggota, simpanan, pinjaman, dan angsuran secara digital dengan laporan keuangan otomatis.',
                'content' => "## Koperasi Online\n\nSistem informasi koperasi simpan pinjam.\n\n## Fitur\n\n- 👥 Manajemen Anggota\n- 💰 Simpanan\n- 💳 Pinjaman\n- 📊 Laporan Keuangan",
                'tech_stack' => ['Laravel 10', 'PHP 8.1', 'MySQL', 'Bootstrap 4', 'jQuery', 'DataTables'],
                'features' => ['Member Management', 'Savings', 'Loans', 'Installments', 'Financial Reports', 'Interest Calculation'],
                'version' => '1.0.0',
                'status' => 'draft',
                'is_featured' => false,
                'sort_order' => 5,
                'view_count' => 0,
                'published_at' => null,
            ],
        ];

        foreach ($apps as $appData) {
            Application::create($appData);
        }

        // Create Settings
        $settings = [
            ['key' => 'site_name', 'value' => 'Showcase Platform', 'group' => 'general', 'type' => 'text', 'description' => 'Nama platform'],
            ['key' => 'site_description', 'value' => 'Platform portofolio interaktif untuk menampilkan aplikasi-aplikasi terbaik', 'group' => 'general', 'type' => 'textarea', 'description' => 'Deskripsi platform'],
            ['key' => 'site_keywords', 'value' => 'showcase, portfolio, laravel, php, web development', 'group' => 'seo', 'type' => 'text', 'description' => 'Keywords SEO'],
            ['key' => 'contact_email', 'value' => 'admin@showcase.test', 'group' => 'general', 'type' => 'email', 'description' => 'Email kontak'],
            ['key' => 'github_url', 'value' => 'https://github.com', 'group' => 'social', 'type' => 'url', 'description' => 'URL GitHub'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('   Admin: admin@showcase.test / password');
        $this->command->info('   User:  dev@showcase.test / password');
    }
}
