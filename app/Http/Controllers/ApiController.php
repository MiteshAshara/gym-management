<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function getInquiriesStats(Request $request)
    {
        $period = $request->input('period', 'today');
        
        $query = Inquiry::query();
        
        // Apply date filter
        switch ($period) {
            case 'today':
                $query->whereDate('created_at', Carbon::today());
                break;
            case 'month':
                $query->whereMonth('created_at', Carbon::now()->month)
                      ->whereYear('created_at', Carbon::now()->year);
                break;
            case 'prev_month':
                $lastMonth = Carbon::now()->subMonth();
                $query->whereMonth('created_at', $lastMonth->month)
                      ->whereYear('created_at', $lastMonth->year);
                break;
            case 'year':
                $query->whereYear('created_at', Carbon::now()->year);
                break;
            case 'all':
                // No filter, return all inquiries
                break;
        }
        
        // Get counts by status
        $hotCount = (clone $query)->where('status', 'hot')->count();
        $coldCount = (clone $query)->where('status', 'cold')->count();
        $pendingCount = (clone $query)->where('status', 'pending')->count();
        
        // Calculate conversion rate
        $total = $hotCount + $coldCount + $pendingCount;
        $conversionRate = $total > 0 ? number_format(($hotCount / $total) * 100, 1) : 0;
        
        return response()->json([
            'hot' => $hotCount,
            'cold' => $coldCount,
            'pending' => $pendingCount,
            'total' => $total,
            'conversionRate' => $conversionRate,
            'period' => $period
        ]);
    }
    
    public function getInquiriesTrends(Request $request)
    {
        $period = $request->input('period', 'month');
        
        if ($period === 'month') {
            // Get data for the last 12 months
            $startDate = Carbon::now()->subMonths(11)->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
            
            $results = DB::table('inquiries')
                ->select(
                    DB::raw('YEAR(created_at) as year'),
                    DB::raw('MONTH(created_at) as month'),
                    DB::raw('COUNT(CASE WHEN status = "hot" THEN 1 END) as hot_count'),
                    DB::raw('COUNT(CASE WHEN status = "cold" THEN 1 END) as cold_count'),
                    DB::raw('COUNT(CASE WHEN status = "pending" THEN 1 END) as pending_count')
                )
                ->where('created_at', '>=', $startDate)
                ->groupBy('year', 'month')
                ->orderBy('year')
                ->orderBy('month')
                ->get();
                
            // Fill in gaps for months with no data
            $labels = [];
            $hotData = [];
            $coldData = [];
            $pendingData = [];
            
            $current = $startDate->copy();
            while ($current <= $endDate) {
                $year = $current->year;
                $month = $current->month;
                $monthName = $current->format('M Y');
                
                $found = false;
                foreach ($results as $result) {
                    if ($result->year == $year && $result->month == $month) {
                        $labels[] = $monthName;
                        $hotData[] = $result->hot_count;
                        $coldData[] = $result->cold_count;
                        $pendingData[] = $result->pending_count;
                        $found = true;
                        break;
                    }
                }
                
                if (!$found) {
                    $labels[] = $monthName;
                    $hotData[] = 0;
                    $coldData[] = 0;
                    $pendingData[] = 0;
                }
                
                $current->addMonth();
            }
            
        } else {
            // Get data for the last 5 years
            $startYear = Carbon::now()->subYears(4)->year;
            $endYear = Carbon::now()->year;
            
            $results = DB::table('inquiries')
                ->select(
                    DB::raw('YEAR(created_at) as year'),
                    DB::raw('COUNT(CASE WHEN status = "hot" THEN 1 END) as hot_count'),
                    DB::raw('COUNT(CASE WHEN status = "cold" THEN 1 END) as cold_count'),
                    DB::raw('COUNT(CASE WHEN status = "pending" THEN 1 END) as pending_count')
                )
                ->where('created_at', '>=', Carbon::createFromDate($startYear, 1, 1))
                ->groupBy('year')
                ->orderBy('year')
                ->get();
                
            // Fill in gaps for years with no data
            $labels = [];
            $hotData = [];
            $coldData = [];
            $pendingData = [];
            
            for ($year = $startYear; $year <= $endYear; $year++) {
                $found = false;
                foreach ($results as $result) {
                    if ($result->year == $year) {
                        $labels[] = (string)$year;
                        $hotData[] = $result->hot_count;
                        $coldData[] = $result->cold_count;
                        $pendingData[] = $result->pending_count;
                        $found = true;
                        break;
                    }
                }
                
                if (!$found) {
                    $labels[] = (string)$year;
                    $hotData[] = 0;
                    $coldData[] = 0;
                    $pendingData[] = 0;
                }
            }
        }
        
        return response()->json([
            'labels' => $labels,
            'hot' => $hotData,
            'cold' => $coldData,
            'pending' => $pendingData,
            'period' => $period
        ]);
    }
}
