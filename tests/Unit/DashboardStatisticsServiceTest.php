<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\DashboardStatisticsService;
use App\Models\TkpResidivisIndividu;
use App\Models\DataIndividuTsk;
use App\Models\DesaGeojson;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * CONTOH UNIT TEST untuk Service Class
 *
 * Ini mustahil dilakukan kalau logic ada di Controller!
 * Dengan Service Class, kita bisa test logic tanpa HTTP!
 */
class DashboardStatisticsServiceTest extends TestCase
{
    use RefreshDatabase;

    private DashboardStatisticsService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new DashboardStatisticsService();
    }

    /** @test */
    public function it_can_get_total_kasus()
    {
        // Arrange: Buat dummy data
        TkpResidivisIndividu::factory()->count(5)->create();

        // Act: Panggil method
        $total = $this->service->getTotalKasus();

        // Assert: Cek hasilnya
        $this->assertEquals(5, $total);
    }

    /** @test */
    public function it_can_get_kasus_per_kabupaten_with_limit()
    {
        // Arrange
        TkpResidivisIndividu::factory()->create(['kabupaten' => 'Surabaya']);
        TkpResidivisIndividu::factory()->create(['kabupaten' => 'Surabaya']);
        TkpResidivisIndividu::factory()->create(['kabupaten' => 'Malang']);

        // Act
        $result = $this->service->getKasusPerKabupaten(2);

        // Assert
        $this->assertCount(2, $result);
        $this->assertEquals('Surabaya', $result->first()->kabupaten);
        $this->assertEquals(2, $result->first()->total);
    }

    /** @test */
    public function it_can_get_residivis_stats()
    {
        // Arrange
        DataIndividuTsk::factory()->count(3)->create(['residivis' => true]);
        DataIndividuTsk::factory()->count(7)->create(['residivis' => false]);

        // Act
        $stats = $this->service->getResidivisStats();

        // Assert
        $this->assertEquals(10, $stats['totalIndividu']);
        $this->assertEquals(3, $stats['residivisCount']);
        $this->assertEquals(7, $stats['nonResidivisCount']);
        $this->assertArrayHasKey('residivisPie', $stats);
    }

    /** @test */
    public function it_filters_invalid_desa_entries()
    {
        // Arrange
        DesaGeojson::factory()->create(['nama_desa' => 'Desa Valid']);
        DesaGeojson::factory()->create(['nama_desa' => 'area unknown']);
        DesaGeojson::factory()->create(['nama_desa' => 'Desa/Invalid']);

        // Act
        $total = $this->service->getTotalDesa();

        // Assert
        $this->assertEquals(1, $total); // Hanya 1 yang valid
    }

    /** @test */
    public function it_can_get_all_statistics_structure()
    {
        // Act
        $stats = $this->service->getAllStatistics();

        // Assert: Cek struktur data
        $this->assertIsArray($stats);
        $this->assertArrayHasKey('totalKasus', $stats);
        $this->assertArrayHasKey('totalDesa', $stats);
        $this->assertArrayHasKey('kabupatenCount', $stats);
        $this->assertArrayHasKey('kasusPerKabupaten', $stats);
        $this->assertArrayHasKey('residivisStats', $stats);
        $this->assertArrayHasKey('anggaranStats', $stats);
    }

    /** @test */
    public function it_can_get_latest_berita()
    {
        // Arrange
        \App\Models\Berita::factory()->count(10)->create();

        // Act
        $berita = $this->service->getLatestBerita(5);

        // Assert
        $this->assertCount(5, $berita);
    }
}


