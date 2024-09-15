<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function user(Request $request)
    {
        $todayUsersCount = User::whereDate('created_at', Carbon::today())->count();

        // Thống kê tài khoản theo tuần
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $weekUsersCount = User::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();

        // Thống kê tài khoản theo tháng
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $monthUsersCount = User::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

        // Trả về view 'admin.dashboard.user' với dữ liệu
        return view('admin.dashboard.user', [
            'todayUsersCount' => $todayUsersCount,
            'weekUsersCount' => $weekUsersCount,
            'monthUsersCount' => $monthUsersCount,
        ]);
    }

    public function getMonthlyStats()
    {
        $monthlyStats = User::selectRaw('COUNT(*) as user_count, MONTH(created_at) as month')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        return response()->json($monthlyStats);
    }
    public function calendar(Request $request)
    {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            if ($startDate > $endDate) {
                toastr()->error('Ngày bắt đầu không được lớn hơn ngày kết thúc');
                return redirect()->back();
            }
            if ($startDate && $endDate) {
                try {
                    $startDate = Carbon::parse($startDate)->startOfDay();
                    $endDate = Carbon::parse($endDate)->endOfDay();

                    $totalBookingsThisCalendar = Orders::whereBetween('created_at', [$startDate, $endDate])->count();

                    $totalConfirmedAmountThisCalendar = Orders::where('status',4)

                        ->whereBetween('created_at', [$startDate, $endDate])
                        ->sum('total_order');

                    $totalBookings = Orders::whereBetween('created_at', [$startDate, $endDate])->count();

                    $statusCounts = Orders::whereBetween('created_at', [$startDate, $endDate])

                        ->selectRaw('status, COUNT(*) as count')
                        ->groupBy('status')
                        ->pluck('count', 'status')
                        ->toArray();

                    $statusPercentages = [];
                    foreach ($statusCounts as $status => $count) {
                        $percentage = ($count / $totalBookings) * 100;
                        $statusPercentages[$status] = round($percentage, 2);
                    }

                    return view('admin.dashboard.calendar', [
                        'totalBookingsThisCalendar' => $totalBookingsThisCalendar,
                        'totalConfirmedAmountThisCalendar' => $totalConfirmedAmountThisCalendar,
                        'statusPercentages' => $statusPercentages,
                        'startDate' => $startDate->toDateString(), // Truyền ngày bắt đầu khoảng thời gian
                        'endDate' => $endDate->toDateString() // Truyền ngày kết thúc khoảng thời gian
                    ]);
                } catch (\Exception $e) {
                    toastr()->error('Ngày không hợp lệ');
                    return redirect()->back();
                }
            } else {
                toastr()->error('Vui lòng chọn đầy đủ ngày');
                return redirect()->back();
            }
    }
    public function getCountStatusCalendar(Request $request)
    {
            try {
                $startDate = $request->input('start_date');
                $endDate = $request->input('end_date');

                if ($startDate && $endDate) {
                    $endDate = Carbon::parse($endDate)->endOfDay();
                    $startDate = Carbon::parse($startDate)->startOfDay();

                    $status2Count = Orders::where('status', 1)
                        ->whereBetween('created_at', [$startDate, $endDate])

                        ->count();

                    $status4ount = Orders::where('status', 4)
                        ->whereBetween('created_at', [$startDate, $endDate])

                        ->count();

                    $status5Count = Orders::where('status', 5)
                        ->whereBetween('created_at', [$startDate, $endDate])

                        ->count();

                    return response()->json([
                        'status2' => $status2Count,
                        'status3' => $status4ount,
                        'status4' => $status5Count,
                    ]);
                } else {
                    return response()->json(['error' => 'Vui lòng chọn đầy đủ ngày.'], 400);
                }
            } catch (\Exception $e) {
                return response()->json(['error' => 'Lỗi khi lấy thông tin booking theo trạng thái.'], 500);
            }
    }
    public function fetchDailyData(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Truy vấn cơ sở dữ liệu để lấy thống kê theo ngày trong khoảng ngày được chọn
        $dailyData = Orders::where('status', 4)

            ->whereBetween('created_at', [Carbon::parse($startDate)->startOfDay(), Carbon::parse($endDate)->endOfDay()])
            ->selectRaw('DATE(created_at) as date, SUM(total_order) as total_amount')
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy(DB::raw('DATE(created_at)'))
            ->pluck('total_amount', 'date');

        return response()->json(['dailyData' => $dailyData]);
    }
}
