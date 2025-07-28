# Sistem Verifikasi Data Duplikat

## Overview
Sistem ini dirancang untuk mendeteksi data duplikat yang dimasukkan oleh admin dan memerlukan verifikasi dari super admin sebelum data tersebut disimpan ke database.

## Fitur Utama

### 1. Deteksi Otomatis Data Duplikat
- Sistem akan secara otomatis mendeteksi data duplikat berdasarkan field-field tertentu
- Data yang terdeteksi duplikat akan disimpan ke tabel `data_verifications` dengan status `pending`

### 2. Menu Verifikasi untuk Super Admin
- Super admin dapat melihat semua data yang memerlukan verifikasi di menu "Verification"
- Tampilan yang user-friendly dengan informasi data lama dan data baru
- Kemampuan untuk approve atau reject data duplikat

### 3. Field Duplikasi yang Diperiksa

#### Data Individu TSK
- NIK
- NKK

#### LSM Narkotika
- Nama LSM
- Ketua LSM

#### Media Sosial
- Nama Akun
- Link Akun

#### Penjual Vape
- Nama Toko
- Pemilik

#### Perusahaan Farmasi Prekursor
- Nama Perusahaan
- Manager

#### Objek Vital
- Nama Objek
- Nama Manager

#### Penggiat Narkotika
- Nama
- No. HP

#### Penginapan
- Nama
- Nama Pengelola

#### Rutan/Lapas
- Nama
- Manager

#### THM
- Nama THM
- Ketua THM

#### Transportasi
- Jenis Transportasi
- Nama Pihak

#### Ekspedisi
- Nama
- Manager

#### Lembaga Rehabilitasi
- Nama

## Cara Kerja

### 1. Admin Memasukkan Data
```php
// Contoh di LsmAdminController
$data = $request->all();
$data['created_by'] = $request->user()->id;

// Check for duplicates
$isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
    'lsm_narkotika',
    $data,
    $request->user()->id
);

if ($isDuplicate) {
    return redirect()->back()
        ->with('warning', 'Data terdeteksi duplikat. Data akan diverifikasi oleh Super Admin terlebih dahulu.')
        ->withInput();
}

// Jika tidak duplikat, simpan langsung
LsmNarkotika::create($data);
```

### 2. Super Admin Melakukan Verifikasi
- Super admin membuka menu "Verification"
- Melihat daftar data yang memerlukan verifikasi
- Klik "Lihat Detail" untuk melihat perbandingan data lama dan baru
- Klik "Approve" untuk menyetujui atau "Reject" untuk menolak

### 3. Proses Approve/Reject
```php
// Approve - data akan disimpan ke tabel utama
public function approve($id)
{
    $verification = DataVerification::findOrFail($id);
    
    if ($verification->data_id == 0) {
        // Data baru - create record
        $model = new $modelClass();
        $model->fill($newData);
        $model->save();
    } else {
        // Update existing record
        $model = $modelClass::find($verification->data_id);
        $model->update($newData);
    }
    
    $verification->status = 'approved';
    $verification->save();
}

// Reject - hanya update status
public function reject($id)
{
    $verification = DataVerification::findOrFail($id);
    $verification->status = 'rejected';
    $verification->save();
}
```

## Struktur Database

### Tabel `data_verifications`
```sql
CREATE TABLE data_verifications (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    table_name VARCHAR(255) NOT NULL,
    data_id BIGINT UNSIGNED DEFAULT 0,
    old_data JSON NULL,
    new_data JSON NOT NULL,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    admin_id BIGINT UNSIGNED NOT NULL,
    super_admin_id BIGINT UNSIGNED NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

## Implementasi di Controller

### 1. Import Service
```php
use App\Services\DuplicateDetectionService;
```

### 2. Tambahkan di Method Store
```php
public function store(Request $request)
{
    // Validation...
    
    $data = $request->all();
    $data['created_by'] = $request->user()->id;
    
    // Check for duplicates
    $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
        'table_name',
        $data,
        $request->user()->id
    );
    
    if ($isDuplicate) {
        return redirect()->back()
            ->with('warning', 'Data terdeteksi duplikat. Data akan diverifikasi oleh Super Admin terlebih dahulu.')
            ->withInput();
    }
    
    // Save data if not duplicate
    Model::create($data);
}
```

### 3. Tambahkan di Method Update
```php
public function update(Request $request, $id)
{
    $model = Model::findOrFail($id);
    $newData = $request->all();
    $newData['created_by'] = $request->user()->id;
    
    // Check for duplicates
    $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
        'table_name',
        $newData,
        $request->user()->id,
        $id
    );
    
    if ($isDuplicate) {
        return redirect()->back()
            ->with('warning', 'Data terdeteksi duplikat. Perubahan akan diverifikasi oleh Super Admin terlebih dahulu.')
            ->withInput();
    }
    
    // Update data if not duplicate
    $model->update($newData);
}
```

## Keuntungan Sistem

1. **Mencegah Data Duplikat**: Data yang sama tidak akan tersimpan tanpa verifikasi
2. **Kontrol Super Admin**: Super admin memiliki kontrol penuh atas data yang masuk
3. **Audit Trail**: Semua proses verifikasi tercatat dengan baik
4. **User Friendly**: Interface yang mudah digunakan untuk verifikasi
5. **Fleksibel**: Mudah menambahkan field duplikasi baru

## Catatan Penting

1. Pastikan semua controller admin mengimplementasikan sistem ini
2. Field duplikasi dapat disesuaikan di `DuplicateDetectionService`
3. Super admin harus aktif memeriksa menu verification
4. Data yang sudah diapprove/reject tidak akan muncul lagi di daftar verification 