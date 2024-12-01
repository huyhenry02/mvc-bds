<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Project;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class IndexCustomerController extends Controller
{
    public function showIndex(): View|Factory|Application
    {
        return view('customer.page.index');
    }

    public function showProjects(): View|Factory|Application
    {
        $projects = Project::all();
        $cities = City::all();
        $categories = Category::all();
        return view('customer.page.projects',
            [
                'projects' => $projects,
                'cities' => $cities,
                'categories' => $categories
            ]
        );
    }

    public function showProjectDetail(Project $project): View|Factory|Application
    {
        $zones = $project->zones;
        return view('customer.page.project-detail',
            [
                'project' => $project,
                'zones' => $zones
            ]
        );
    }

    public function showService(): View|Factory|Application
    {
        return view('customer.page.service');
    }

    public function showAbout(): View|Factory|Application
    {
        return view('customer.page.about');
    }

    public function showTransaction(): View|Factory|Application
    {
        $transactions = Transaction::where('user_id', auth()->id())->get();
        return view('customer.page.transaction',
            [
                'transactions' => $transactions
            ]
        );
    }
    public function searchProjects(Request $request): JsonResponse
    {
        $query = Project::query();

        if ($request->has('city_id') && $request->city_id) {
            $query->where('city_id', $request->city_id);
        }
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $projects = $query->with('investor')->get();

        return response()->json([
            'projects' => $projects,
        ]);
    }

    public function postTransaction(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $transaction = new Transaction();
            $input['user_id'] = auth()->id();
            $input['status'] = Transaction::STATUS_PENDING;
            $input['transaction_date'] = now();
            $transaction->fill($input);
            $transaction->save();
            DB::commit();
            return redirect()->route('customer.showTransaction')->with('success', 'Gửi yêu cầu thành công');
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }
}
