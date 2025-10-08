<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    /**
     * Store a newly created news in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'url' => 'required|url'
            ]);

            $url = $request->url;

            // Fetch metadata from URL
            $metadata = $this->fetchUrlMetadata($url);

            // Create news record
            $berita = Berita::create([
                'title' => $metadata['title'] ?? 'Judul tidak ditemukan',
                'description' => $metadata['description'] ?? 'Deskripsi tidak ditemukan',
                'image_url' => $metadata['image_url'] ?? null,
                'url' => $url,
                'source' => $metadata['source'] ?? parse_url($url, PHP_URL_HOST),
                'published_at' => $metadata['published_at'] ?? now(),
                'position' => 'bawah', // Default position
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Berita berhasil ditambahkan',
                'data' => $berita
            ]);
        } catch (\Exception $e) {
            Log::error('Error storing news: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan berita: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Fetch metadata from URL for preview
     */
    public function preview(Request $request)
    {
        try {
            $request->validate([
                'url' => 'required|url'
            ]);

            $url = $request->url;
            $metadata = $this->fetchUrlMetadata($url);

            return response()->json([
                'success' => true,
                'data' => $metadata
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching preview: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil preview: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the position of the specified news.
     */
    public function updatePosition(Request $request, $id)
    {
        try {
            $request->validate([
                'position' => 'required|in:utama,pinggir,bawah'
            ]);

            $berita = Berita::findOrFail($id);
            $berita->position = $request->position;
            $berita->save();

            return response()->json([
                'success' => true,
                'message' => 'Posisi berita berhasil diperbarui',
                'data' => $berita
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating news position: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui posisi berita: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified news from storage.
     */
    public function destroy($id)
    {
        try {
            $berita = Berita::findOrFail($id);
            $berita->delete();

            return response()->json([
                'success' => true,
                'message' => 'Berita berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting news: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus berita: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Fetch metadata from URL
     */
    private function fetchUrlMetadata($url)
    {
        try {
            // Use a simple HTTP client to fetch the page
            $response = Http::timeout(10)->get($url);

            if (!$response->successful()) {
                throw new \Exception('Tidak dapat mengakses URL');
            }

            $html = $response->body();

            // Extract metadata using regex patterns
            $metadata = [];

            // Extract title
            if (preg_match('/<title[^>]*>(.*?)<\/title>/is', $html, $matches)) {
                $metadata['title'] = trim(strip_tags($matches[1]));
            }

            // Extract description from meta tags
            if (preg_match('/<meta[^>]*name=["\']description["\'][^>]*content=["\']([^"\']*)["\'][^>]*>/i', $html, $matches)) {
                $metadata['description'] = trim($matches[1]);
            } elseif (preg_match('/<meta[^>]*content=["\']([^"\']*)["\'][^>]*name=["\']description["\'][^>]*>/i', $html, $matches)) {
                $metadata['description'] = trim($matches[1]);
            }

            // Extract image from meta tags
            if (preg_match('/<meta[^>]*property=["\']og:image["\'][^>]*content=["\']([^"\']*)["\'][^>]*>/i', $html, $matches)) {
                $metadata['image_url'] = trim($matches[1]);
            } elseif (preg_match('/<meta[^>]*content=["\']([^"\']*)["\'][^>]*property=["\']og:image["\'][^>]*>/i', $html, $matches)) {
                $metadata['image_url'] = trim($matches[1]);
            }

            // Extract source domain
            $parsedUrl = parse_url($url);
            $metadata['source'] = $parsedUrl['host'] ?? 'Unknown';

            // Extract published date if available
            if (preg_match('/<meta[^>]*property=["\']article:published_time["\'][^>]*content=["\']([^"\']*)["\'][^>]*>/i', $html, $matches)) {
                $metadata['published_at'] = $matches[1];
            }

            return $metadata;
        } catch (\Exception $e) {
            Log::error('Error fetching URL metadata: ' . $e->getMessage());

            // Return basic metadata if extraction fails
            $parsedUrl = parse_url($url);
            return [
                'title' => 'Judul tidak ditemukan',
                'description' => 'Deskripsi tidak ditemukan',
                'image_url' => null,
                'source' => $parsedUrl['host'] ?? 'Unknown',
                'published_at' => now()
            ];
        }
    }
}
