# 📚 Contoh Service Class Implementation

## 🎯 Perbandingan: SEBELUM vs SESUDAH

### ❌ **SEBELUM (Fat Controller - 300+ baris)**
```php
class SuperAdminDashboardController extends Controller
{
    public function index()
    {
        // 50+ baris query untuk kasus
        $totalKasus = TkpResidivisIndividu::count();
        $kasusPerKabupaten = TkpResidivisIndividu::select(...)
            ->groupBy('kabupaten')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();
        
        // 40+ baris query untuk residivis
        $residivisCount = DataIndividuTsk::where('residivis', true)->count();
        $nonResidivisCount = DataIndividuTsk::where('residivis', false)->count();
        
        // 50+ baris query untuk anggaran
        $totalAnggaranSebelum = Anggaran::sum('anggaran_sebelum');
        $totalBlokir = Anggaran::sum('blokir');
        
        // 100+ baris lagi untuk data lainnya...
        // ...
        
        return view('super-admin.dashboard', compact(...));
    }
}
```

**❌ MASALAH:**
- Controller jadi 300+ baris (Fat Controller)
- Sulit di-test (harus lewat HTTP)
- Tidak reusable
- Sulit maintain
- Melanggar Single Responsibility Principle

---

### ✅ **SESUDAH (Thin Controller - 30 baris)**
```php
class SuperAdminDashboardController extends Controller
{
    public function __construct(
        private DashboardStatisticsService $dashboardService
    ) {}

    public function index()
    {
        $stats = $this->dashboardService->getAllStatistics();
        extract($stats);
        
        return view('super-admin.dashboard', compact(...));
    }
}
```

**✅ KEUNTUNGAN:**
- Controller jadi 30 baris (Thin Controller)
- Mudah di-test (unit test tanpa HTTP)
- Reusable (bisa dipanggil dari mana saja)
- Mudah maintain
- Clean & Readable

---

## 📂 File Structure

```
app/
├── Services/
│   ├── DashboardStatisticsService.php     ← Service baru
│   └── DuplicateDetectionService.php      ← Service yang sudah ada
│
├── Http/Controllers/
│   ├── SuperAdminDashboardController.php  ← Controller lama (300+ baris)
│   └── SuperAdminDashboardController_REFACTORED_EXAMPLE.php  ← Contoh refactor (30 baris)
│
tests/
└── Unit/
    └── DashboardStatisticsServiceTest.php  ← Unit test untuk service
```

---

## 🚀 Cara Menggunakan Service Class

### 1️⃣ **Di Controller (Dependency Injection)**
```php
class SuperAdminDashboardController extends Controller
{
    // Laravel akan auto-inject service ini
    public function __construct(
        private DashboardStatisticsService $dashboardService
    ) {}

    public function index()
    {
        // Panggil method dari service
        $stats = $this->dashboardService->getAllStatistics();
        
        return view('super-admin.dashboard', compact('stats'));
    }
}
```

### 2️⃣ **Di Command/Job**
```php
class GenerateReportCommand extends Command
{
    public function __construct(
        private DashboardStatisticsService $dashboardService
    ) {
        parent::__construct();
    }

    public function handle()
    {
        $stats = $this->dashboardService->getAllStatistics();
        
        // Generate report with stats...
    }
}
```

### 3️⃣ **Menggunakan app() Helper**
```php
$service = app(DashboardStatisticsService::class);
$stats = $service->getAllStatistics();
```

### 4️⃣ **Di Blade (via Controller)**
```php
// Controller
public function index(DashboardStatisticsService $service)
{
    return view('dashboard', [
        'totalKasus' => $service->getTotalKasus(),
        'residivisStats' => $service->getResidivisStats(),
    ]);
}

// Blade
<h1>Total Kasus: {{ $totalKasus }}</h1>
```

---

## 🧪 Testing

### ❌ **SEBELUM (Tidak bisa unit test)**
```php
// Harus test lewat HTTP (Feature Test) - LAMBAT!
public function test_dashboard_shows_statistics()
{
    $response = $this->get('/super-admin/dashboard');
    $response->assertStatus(200);
    // Susah test logic spesifik...
}
```

### ✅ **SESUDAH (Bisa unit test)**
```php
// Unit test tanpa HTTP - CEPAT!
public function test_can_get_total_kasus()
{
    TkpResidivisIndividu::factory()->count(5)->create();
    
    $service = new DashboardStatisticsService();
    $total = $service->getTotalKasus();
    
    $this->assertEquals(5, $total);
}
```

**Jalankan test:**
```bash
php artisan test --filter DashboardStatisticsServiceTest
```

---

## 📊 Method yang Tersedia

### **Basic Statistics**
- `getTotalKasus()` - Total kasus TKP
- `getTotalDesa()` - Total desa (filtered)
- `getKabupatenCount()` - Jumlah kabupaten
- `getKecamatanCount()` - Jumlah kecamatan

### **Grafik Data (dengan limit)**
- `getKasusPerKabupaten($limit = 5)` - Kasus per kabupaten TKP
- `getKasusPerKabupatenNik($limit = 5)` - Kasus per kabupaten NIK
- `getKasusPerKecamatan($limit = 5)` - Kasus per kecamatan TKP
- `getKasusPerKecamatanNik($limit = 5)` - Kasus per kecamatan NIK

### **Detail Data (20 teratas)**
- `getDataKabupatenTkp($limit = 20)` - Detail kabupaten TKP
- `getDataKabupatenNik($limit = 20)` - Detail kabupaten NIK
- `getDataKecamatanTkp($limit = 20)` - Detail kecamatan TKP
- `getDataKecamatanNik($limit = 20)` - Detail kecamatan NIK

### **Pagination**
- `getAllKecamatanTkpPaginated($perPage = 15)` - All kecamatan dengan pagination

### **Complex Statistics**
- `getResidivisStats()` - Statistik residivis lengkap
- `getAnggaranStats()` - Statistik anggaran lengkap
- `getOrganizationData()` - Data organisasi (komposisi, galeri, dll)
- `getLatestBerita($limit = 5)` - Berita terbaru
- `getKasusTerbaru($limit = 10)` - Kasus terbaru

### **All-in-One**
- `getAllStatistics()` - Semua statistik sekaligus (recommended!)

---

## 💡 Contoh Penggunaan Real

### **1. Dashboard Page**
```php
public function index(DashboardStatisticsService $service)
{
    // Ambil semua data sekaligus
    $stats = $service->getAllStatistics();
    
    return view('super-admin.dashboard', compact('stats'));
}
```

### **2. API Endpoint**
```php
public function getStatisticsApi(DashboardStatisticsService $service)
{
    return response()->json([
        'success' => true,
        'data' => $service->getAllStatistics()
    ]);
}
```

### **3. Export Excel**
```php
public function exportReport(DashboardStatisticsService $service)
{
    $stats = $service->getAllStatistics();
    
    return Excel::download(
        new DashboardReportExport($stats),
        'dashboard-report.xlsx'
    );
}
```

### **4. Scheduled Report (Cron Job)**
```php
class SendDailyReportCommand extends Command
{
    public function __construct(
        private DashboardStatisticsService $service,
        private MailService $mailService
    ) {
        parent::__construct();
    }

    public function handle()
    {
        $stats = $this->service->getAllStatistics();
        
        $this->mailService->sendReport($stats);
        
        $this->info('Report sent!');
    }
}
```

---

## 🎨 Best Practices

### ✅ **DO:**
1. **Satu Service = Satu Domain**
   - `DashboardStatisticsService` - untuk dashboard stats
   - `IndividuService` - untuk logika individu
   - `AnggaranService` - untuk logika anggaran

2. **Method yang Descriptive**
   ```php
   ✅ getTotalKasus()
   ✅ getKasusPerKabupaten($limit)
   ✅ getResidivisStats()
   ```

3. **Type Hinting**
   ```php
   ✅ public function getTotalKasus(): int
   ✅ public function getKasusPerKabupaten(int $limit)
   ```

4. **Dependency Injection**
   ```php
   ✅ public function __construct(
       private DashboardStatisticsService $service
   ) {}
   ```

### ❌ **DON'T:**
1. **Jangan Taruh Logic di Controller**
   ```php
   ❌ public function index()
   {
       $total = Model::where(...)->count(); // Logic di controller!
   }
   ```

2. **Jangan Return View dari Service**
   ```php
   ❌ return view('dashboard', $stats); // Service hanya return data!
   ```

3. **Jangan Handle HTTP di Service**
   ```php
   ❌ return response()->json($stats); // Ini tugas controller!
   ```

---

## 📈 Performance

Service Class **TIDAK** membuat aplikasi lebih lambat!

- ✅ Service di-inject sekali (singleton)
- ✅ Query tetap efficient
- ✅ Bisa di-cache dengan mudah
- ✅ Lebih mudah optimize karena logic terpusat

**Bonus:** Dengan service class, kamu bisa tambahkan caching dengan mudah:

```php
public function getTotalKasus(): int
{
    return Cache::remember('total_kasus', 3600, function() {
        return TkpResidivisIndividu::count();
    });
}
```

---

## 🔧 Migration Strategy

### **Langkah-langkah Refactor:**

1. **Buat Service Class baru**
   ```bash
   php artisan make:class Services/YourService
   ```

2. **Copy logic dari Controller ke Service**
   - Pindahkan semua query & logic
   - Buat method yang descriptive
   - Tambahkan type hinting

3. **Update Controller**
   - Inject service di constructor
   - Panggil method dari service
   - Remove logic dari controller

4. **Test**
   - Buat unit test untuk service
   - Test controller masih jalan

5. **Refactor Bertahap**
   - Tidak perlu refactor semua sekaligus
   - Refactor per feature
   - Prioritas yang paling kompleks

---

## ✅ Kesimpulan

### **Service Class = BETTER karena:**

1. ✅ **Clean Code** - Controller jadi slim
2. ✅ **Testable** - Mudah unit test
3. ✅ **Reusable** - Bisa dipanggil dari mana saja
4. ✅ **Maintainable** - Logic terpusat
5. ✅ **Scalable** - Mudah develop feature baru
6. ✅ **Type Safe** - Full type hinting
7. ✅ **Team Friendly** - Mudah dipahami team

### **Kapan Mulai Pakai Service Class?**
**SEKARANG!** 🚀

Mulai dari controller yang paling kompleks, atau feature baru yang akan dibuat.

---

## 📞 Next Steps

1. Review file yang sudah dibuat:
   - `app/Services/DashboardStatisticsService.php`
   - `app/Http/Controllers/SuperAdminDashboardController_REFACTORED_EXAMPLE.php`
   - `tests/Unit/DashboardStatisticsServiceTest.php`

2. Coba run unit test:
   ```bash
   php artisan test --filter DashboardStatisticsServiceTest
   ```

3. Refactor controller yang sudah ada untuk pakai service

4. Buat service class untuk domain lain:
   - IndividuService
   - AnggaranService
   - VerificationService
   - dll.

---

**Happy Coding! 🎉**



