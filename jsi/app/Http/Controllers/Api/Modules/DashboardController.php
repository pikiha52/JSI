<?php

namespace App\Http\Controllers\Api\Modules;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Peminjaman;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $thisMonth = Peminjaman::whereBetween('borrow_date', [$startOfMonth, $endOfMonth])->count();

        $startDate = Carbon::now()->subMonths(6);

        $sixMonth = Peminjaman::where('borrow_date', '>=', $startDate)->count();

        $user = User::select('users.name', DB::raw('count(peminjaman.id) as borrow_count'))
            ->join('peminjaman', 'users.id', '=', 'peminjaman.user_id')
            ->groupBy('users.id')
            ->orderByDesc('borrow_count')
            ->limit(5)
            ->get();

        return response()->json([
            'code' => 200,
            'results' => [
                'this_month' => $thisMonth,
                'six_month' => $sixMonth,
                'user' => $user,
            ],
            'message' => 'Success'
        ]);
    }
}
