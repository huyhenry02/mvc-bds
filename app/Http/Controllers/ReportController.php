<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Project;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class ReportController extends Controller
{
    public function showReportUser(): View|Factory|Application
    {
        return view('admin.page.report.user');
    }

    public function showReportTransaction(): View|Factory|Application
    {
        $projects = Project::all();
        return view('admin.page.report.transaction',
            [
                'projects' => $projects
            ]
        );
    }

    public function showReportProject(): View|Factory|Application
    {
        return view('admin.page.report.project');
    }

    public function showDataChart($timeType, $typeChart): JsonResponse
    {
        $now = Carbon::now();

        switch ($timeType) {
            case 'year':
                $data = $this->getYearlyStatistics($now, $typeChart);
                break;

            case 'month':
                $data = $this->getMonthlyStatistics($now, $typeChart);
                break;

            case 'week':
                $data = $this->getWeeklyStatistics($now, $typeChart);
                break;

            case 'day':
                $data = $this->getDailyStatistics($now, $typeChart);
                break;

            default:
                return response()->json(['error' => 'Invalid time type'], 400);
        }

        return response()->json($data);
    }

    public function showPreviewExport(Request $request): View|Factory|Application
    {
        if ($request->has('projects') && !empty($request->projects)) {
            $request->projects = array_map('intval', explode(',', $request->projects));
        }
        $data = $this->handleDataTransaction($request);
        return view('admin.page.report.preview_export', [
            'data' => $data,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'projects' => $request->projects ?? [],
        ]);
    }

    public function showDataTransaction(Request $request): JsonResponse
    {
        try {
            $data = $this->handleDataTransaction($request);
            return response()->json($data);
        } catch (Exception $e) {
            Log::error('Lỗi khi lấy dữ liệu giao dịch: ' . $e->getMessage());
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function generatePDF(Request $request): Response
    {
        if ($request->has('projects') && !empty($request->projects)) {
            $request->projects = array_map('intval', explode(',', $request->projects));
        }
        $data = $this->handleDataTransaction($request);
        $dataView = [
            'title' => 'Laravel PDF Export',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'data' => $data,
        ];
        return Pdf::loadView('admin.page.report.template_export', $dataView)->download('Báo cáo giao dịch.pdf');
    }

    private function getYearlyStatistics($now, $typeChart)
    {
        $currentYear = $now->year;
        $startYear = $currentYear - 5;

        return DB::table((string)$typeChart)
            ->selectRaw('YEAR(created_at) as year, COUNT(*) as count')
            ->whereBetween('created_at', ["$startYear-01-01", "$currentYear-12-31"])
            ->groupBy('year')
            ->get()
            ->mapWithKeys(function ($item) use ($startYear, $currentYear) {
                $years = array_fill($startYear, $currentYear - $startYear + 1, 0);
                $years[$item->year] = $item->count;
                return $years;
            });
    }

    private function getMonthlyStatistics($now, $typeChart)
    {
        $year = $now->year;

        return DB::table((string)$typeChart)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->get()
            ->mapWithKeys(function ($item) {
                $counts = array_fill(1, 12, 0);
                $counts[$item->month] = $item->count;
                return $counts;
            });
    }

    private function getWeeklyStatistics($now, $typeChart): Collection
    {
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        return DB::table((string)$typeChart)
            ->selectRaw('WEEK(created_at, 1) as week, COUNT(*) as count')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->groupBy('week')
            ->get();
    }

    private function getDailyStatistics($now, $typeChart): Collection
    {
        $startOfWeek = $now->copy()->startOfWeek();
        $endOfWeek = $now->copy()->endOfWeek();

        return DB::table((string)$typeChart)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->groupBy('date')
            ->get();
    }

    private function handleDataTransaction($request): array
    {
        $query = Transaction::query()
            ->join('plots', 'transactions.plot_id', '=', 'plots.id')
            ->join('zones', 'plots.zone_id', '=', 'zones.id')
            ->join('projects', 'zones.project_id', '=', 'projects.id')
            ->select(
                'projects.name as project_name',
                'zones.name as zone_name',
                'zones.code as zone_code',
                'plots.name as plot_name',
                'plots.size',
                'plots.deposit',
                'transactions.transaction_date',
                'transactions.status',
                DB::raw('COUNT(plots.id) as plot_count')
            )
            ->groupBy(
                'projects.id',
                'zones.id',
                'plots.id',
                'transactions.transaction_date',
                'transactions.status',
                'plots.size'
            );

        if ($request->has('projects') && !empty($request->projects)) {
            $query->whereIn('projects.id', $request->projects);
        }

        if ($request->has('start_date') && !empty($request->start_date)) {
            $query->where('transactions.transaction_date', '>=', $request->start_date );
        }

        if ($request->has('end_date') && !empty($request->end_date)) {
            $query->where('transactions.transaction_date', '<=', $request->end_date);
        }

        if ($request->has('status') && !empty($request->status)) {
            $query->where('transactions.status', $request->status);
        }

        $transactions = $query->get();

        $data = [];

        foreach ($transactions as $transaction) {
            $projectName = $transaction->project_name;
            $zoneCode = $transaction->zone_code;

            if (!isset($data[$projectName])) {
                $data[$projectName] = [];
            }

            if (!isset($data[$projectName][$zoneCode])) {
                $data[$projectName][$zoneCode] = [];
            }

            $data[$projectName][$zoneCode][] = [
                'project_name' => $transaction->project_name,
                'zone_name' => $transaction->zone_name,
                'plot_name' => $transaction->plot_name,
                'size' => $transaction->size,
                'deposit' => $transaction->deposit,
                'transaction_date' => $transaction->transaction_date,
                'status' => $transaction->status,
            ];
        }
        return $data;
    }
}
