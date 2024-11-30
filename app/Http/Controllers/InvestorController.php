<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Investor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class InvestorController extends Controller
{
    public function showIndex(): View|Factory|Application
    {
        $investors = Investor::all();
        return view('admin.page.investor.index'
            , ['investors' => $investors]
        );
    }

    public function showCreate(): View|Factory|Application
    {
        return view('admin.page.investor.create');
    }

    public function showUpdate(Investor $investor): View|Factory|Application
    {
        return view('admin.page.investor.update',
            ['investor' => $investor]
        );
    }

    public function postCreate(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $investor = new Investor();
            $investor->fill($input);
            $investor->save();
            DB::commit();
            return redirect()->route('investor.showIndex');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    public function postUpdate(Request $request, Investor $investor): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $investor->fill($input);
            $investor->save();
            DB::commit();
            return redirect()->route('investor.showIndex');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    public function delete(Investor $investor): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $investor->projects()->delete();
            $investor->delete();
            DB::commit();
            return redirect()->route('investor.showIndex');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }
}
