<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HalController extends Controller
{
    private function getInventarisData(): array
    {
        return [
            [
                'kode'     => 'BRG-001',
                'nama'     => 'Gamepass Dandys',
                'kategori' => 'Gamepass',
                'stok'     => 12,
                'harga'    => 35000,
                'tanggal'  => '2026-04-10',
            ],
            [
                'kode'     => 'BRG-002',
                'nama'     => 'Voucher Robux 400',
                'kategori' => 'Voucher',
                'stok'     => 4,
                'harga'    => 79000,
                'tanggal'  => '2026-04-11',
            ],
            [
                'kode'     => 'BRG-003',
                'nama'     => 'Private Server Sailor Piece',
                'kategori' => 'Private Server',
                'stok'     => 7,
                'harga'    => 129000,
                'tanggal'  => '2026-04-12',
            ],
            [
                'kode'     => 'BRG-004',
                'nama'     => 'Gamepass VIP Blox Fruits',
                'kategori' => 'Gamepass',
                'stok'     => 3,
                'harga'    => 89000,
                'tanggal'  => '2026-04-13',
            ],
            [
                'kode'     => 'BRG-005',
                'nama'     => 'Voucher Robux 800',
                'kategori' => 'Voucher',
                'stok'     => 9,
                'harga'    => 149000,
                'tanggal'  => '2026-04-14',
            ],
            [
                'kode'     => 'BRG-006',
                'nama'     => 'Private Server King Legacy',
                'kategori' => 'Private Server',
                'stok'     => 2,
                'harga'    => 99000,
                'tanggal'  => '2026-04-15',
            ],
        ];
    }

    private function hitungRingkasan(array $inventaris): array
    {
        $totalStok = array_sum(array_column($inventaris, 'stok'));
        $totalNilai = array_sum(array_map(function ($item) {
            return $item['stok'] * $item['harga'];
        }, $inventaris));
        $stokMenipis = count(array_filter($inventaris, function ($item) {
            return $item['stok'] < 5;
        }));

        return [
            'totalBarang' => count($inventaris),
            'totalStok' => $totalStok,
            'totalNilai' => $totalNilai,
            'stokMenipis' => $stokMenipis,
        ];
    }

    private function getUsername(Request $request): ?string
    {
        $username = trim($request->query('username', ''));
        return $username !== '' ? $username : null;
    }

    public function showLogin()
    {
        return view('login');
    }

    public function processLogin(Request $request)
    {
        $username = trim($request->input('username', ''));
        $password = trim($request->input('password', ''));

        if ($username === '' || $password === '') {
            return redirect()->route('login')
                ->with('error', 'Username dan password wajib diisi.')
                ->withInput(['username' => $username]);
        }

        if (strlen($username) < 3) {
            return redirect()->route('login')
                ->with('error', 'Username minimal 3 karakter.')
                ->withInput(['username' => $username]);
        }

        $validUsers = [
            'radit' => 'robux123',
            'admin' => 'admin123',
            'user'  => 'user123',
        ];

        if (!isset($validUsers[$username]) || $validUsers[$username] !== $password) {
            return redirect()->route('login')
                ->with('error', 'Username atau password salah. Coba: radit / robux123')
                ->withInput(['username' => $username]);
        }

        return redirect()->route('dashboard', ['username' => $username]);
    }

    public function logout()
    {
        return redirect()->route('login')->with('info', 'Kamu berhasil keluar.');
    }

    public function showDashboard(Request $request)
    {
        $username = $this->getUsername($request);

        if (!$username) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $inventaris = $this->getInventarisData();
        $ringkasan = $this->hitungRingkasan($inventaris);

        return view('dashboard', array_merge(['username' => $username], $ringkasan));
    }

    public function showPengelolaan(Request $request)
    {
        $username = $this->getUsername($request);

        if (!$username) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $inventaris = $this->getInventarisData();
        $ringkasan = $this->hitungRingkasan($inventaris);

        return view('pengelolaan', array_merge([
            'username' => $username,
            'inventaris' => $inventaris,
        ], $ringkasan));
    }

    public function showProfile(Request $request)
    {
        $username = $this->getUsername($request);

        if (!$username) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $profileData = [
            'username' => $username,
            'namaLengkap' => ucfirst($username) . ' (RobuxRadit)',
            'email' => $username . '@robuxradit.id',
            'role' => 'Admin Inventaris',
            'bergabung' => '10 April 2026',
            'keahlian' => ['Manajemen Stok', 'Transaksi Robux', 'Pengelolaan Gamepass'],
        ];

        return view('profile', compact('username', 'profileData'));
    }
}
