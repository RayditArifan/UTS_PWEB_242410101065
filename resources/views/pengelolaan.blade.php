@extends('layouts.app')

@section('title', 'Pengelolaan Inventaris - RobuxRadit')

@section('content')

<section class="hero">
  <div>
    <span class="hero-tag">Pengelolaan - Daftar Barang - Filter</span>
    <h2>Pengelolaan Inventaris</h2>
    <p>
      Halo <strong>{{ $username }}</strong>, berikut adalah seluruh data barang yang tersimpan.
    </p>
  </div>
</section>

<section class="dashboard-section">
  <div class="section-heading">
    <h2>Ringkasan Barang</h2>
    <p>Total {{ $totalBarang }} jenis barang terdaftar.</p>
  </div>

  <div class="card-grid">
    <article class="card stat-card">
      <p class="stat-label">Jenis Barang</p>
      <h3>{{ $totalBarang }}</h3>
      <small>Total jenis</small>
    </article>

    <article class="card stat-card">
      <p class="stat-label">Total Stok</p>
      <h3>{{ $totalStok }}</h3>
      <small>Seluruh unit</small>
    </article>

    <article class="card stat-card">
      <p class="stat-label">Nilai Inventaris</p>
      <h3 class="money-text">Rp {{ number_format($totalNilai, 0, ',', '.') }}</h3>
      <small>Stok x harga</small>
    </article>

    <article class="card stat-card warning-card">
      <p class="stat-label">Stok Menipis</p>
      <h3>{{ $stokMenipis }}</h3>
      <small>Stok &lt; 5</small>
    </article>
  </div>
</section>

<section id="inventaris-section" class="table-section">
  <div class="section-heading">
    <h2>Daftar Inventaris Barang</h2>
  </div>

  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Kode Barang</th>
          <th>Nama Barang</th>
          <th>Kategori</th>
          <th>Stok</th>
          <th>Harga</th>
          <th>Tanggal Masuk</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($inventaris as $index => $item)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item['kode'] }}</td>
            <td>{{ $item['nama'] }}</td>
            <td><span class="badge-kategori">{{ $item['kategori'] }}</span></td>
            <td>{{ $item['stok'] }}</td>
            <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
            <td>{{ \Carbon\Carbon::parse($item['tanggal'])->translatedFormat('d F Y') }}</td>
            <td>
              @if ($item['stok'] < 5)
                <span class="badge badge-low">Menipis</span>
              @else
                <span class="badge badge-safe">Aman</span>
              @endif
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="8" class="empty-state">Belum ada data barang.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</section>

<div class="stock-note">
  <h2>Keterangan Status Stok</h2>
  <p><strong>Aman</strong> - stok 5 atau lebih, barang masih cukup tersedia.</p>
  <p><strong>Menipis</strong> - stok di bawah 5, segera lakukan penambahan stok.</p>
</div>

@endsection
