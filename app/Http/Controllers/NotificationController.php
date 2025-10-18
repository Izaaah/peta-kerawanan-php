<?php

namespace App\Http\Controllers;

use App\Models\DataVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Mark specific notification as read
     */
    public function markAsRead(Request $request)
    {
        $request->validate([
            'verification_id' => 'required|integer|exists:data_verifications,id',
        ]);

        $verification = DataVerification::where('id', $request->verification_id)
            ->where('admin_id', Auth::id())
            ->where('status', 'approved')
            ->first();

        if (!$verification) {
            return response()->json([
                'success' => false,
                'message' => 'Notifikasi tidak ditemukan atau tidak dapat diakses.'
            ], 404);
        }

        $verification->delete();

        return response()->json([
            'success' => true,
            'message' => 'Notifikasi telah ditandai sebagai dibaca.'
        ]);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        $deletedCount = DataVerification::where('admin_id', Auth::id())
            ->where('status', 'approved')
            ->delete();

        return response()->json([
            'success' => true,
            'message' => "Semua notifikasi telah ditandai sebagai dibaca.",
            'deleted_count' => $deletedCount
        ]);
    }
}
