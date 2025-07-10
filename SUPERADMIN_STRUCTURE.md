# Struktur Komponen Superadmin

## Overview
Dashboard superadmin telah dipisah menjadi komponen-komponen terpisah yang lebih modular dan mudah dikelola.

## Struktur File

### 1. Layout Master
- **File**: `resources/views/layouts/superadmin-master.blade.php`
- **Fungsi**: Layout utama yang memanggil semua komponen
- **Fitur**:
  - Include navbar, sidebar (opsional), dan footer
  - Support untuk `@stack('styles')` dan `@stack('scripts')`
  - Responsive design

### 2. Komponen Navbar
- **File**: `resources/views/components/superadmin-navbar.blade.php`
- **CSS**: `public/css/superadmin-navbar.css`
- **Fitur**:
  - Logo BNN dan SIJAGAD
  - Menu dropdown untuk Data
  - Menu Peta, Input, User Management
  - Logout button

### 3. Komponen Sidebar (Opsional)
- **File**: `resources/views/components/superadmin-sidebar.blade.php`
- **CSS**: `public/css/superadmin-components.css`
- **Fitur**:
  - Menu navigasi dengan icon
  - Active state untuk menu yang sedang aktif
  - Responsive design

### 4. Komponen Footer
- **File**: `resources/views/components/superadmin-footer.blade.php`
- **CSS**: `public/css/superadmin-components.css`
- **Fitur**:
  - Copyright BNN Provinsi Jawa Timur
  - Nama aplikasi SIJAGAD

## Halaman yang Menggunakan Layout Master

### 1. Dashboard
- **File**: `resources/views/super-admin/dashboard.blade.php`
- **Layout**: `@extends('layouts.superadmin-master')`
- **Fitur**: Statistik dashboard dengan card cards

### 2. Peta Kerawanan
- **File**: `resources/views/super-admin/peta.blade.php`
- **Layout**: `@extends('layouts.superadmin-master')`
- **Fitur**: Peta Leaflet dengan data GeoJSON

### 3. User Management
- **File**: `resources/views/super-admin/user-management/index.blade.php`
- **Layout**: `@extends('layouts.superadmin-master')`
- **Fitur**: Tabel user dengan aksi CRUD

## Cara Penggunaan

### 1. Membuat Halaman Baru
```php
@extends('layouts.superadmin-master')

@section('content')
<div class="container mx-auto">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <!-- Konten Anda di sini -->
        </div>
    </div>
</div>
@endsection
```

### 2. Menambahkan CSS Kustom
```php
@push('styles')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush
```

### 3. Menambahkan JavaScript
```php
@push('scripts')
<script src="{{ asset('js/custom.js') }}"></script>
@endpush
```

### 4. Mengaktifkan Sidebar
Untuk mengaktifkan sidebar, uncomment baris ini di `superadmin-master.blade.php`:
```php
@include('components.superadmin-sidebar')
```

## Keuntungan Struktur Baru

1. **Modular**: Setiap komponen terpisah dan dapat digunakan ulang
2. **Maintainable**: Mudah untuk mengubah satu komponen tanpa mempengaruhi yang lain
3. **Consistent**: Semua halaman menggunakan layout yang sama
4. **Flexible**: Bisa menambah/mengurangi komponen sesuai kebutuhan
5. **Responsive**: Design yang responsive untuk semua ukuran layar

## CSS Files

### 1. superadmin-navbar.css
- Styling untuk navbar utama
- Gradient background
- Dropdown menu
- Responsive design

### 2. superadmin-components.css
- Styling untuk sidebar dan footer
- Hover effects
- Active states
- Responsive breakpoints

## Tips Pengembangan

1. **Menambah Menu Baru**: Edit file `superadmin-navbar.blade.php`
2. **Mengubah Style**: Edit file CSS yang sesuai
3. **Menambah Halaman**: Buat file baru dan extend `superadmin-master`
4. **Menambah Route**: Pastikan route sudah terdaftar di `web.php`
5. **Testing**: Test di berbagai ukuran layar untuk responsive design 
