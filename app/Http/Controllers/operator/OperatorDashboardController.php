<?php

namespace App\Http\Controllers\operator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OperatorDashboardController extends Controller
{
    public function index()
    {
    $totalViews = DB::table('page_views')->count();
    $todayViews = DB::table('page_views')->whereDate('created_at', today())->count();
    $viewsPerDay = DB::table('page_views')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
        ->groupBy('date')
        ->orderBy('date', 'desc')
        ->limit(14)
        ->get()
        ->reverse()
        ->values();

    return view('operator.dashboard', compact('totalViews', 'todayViews', 'viewsPerDay'));
    }
}
