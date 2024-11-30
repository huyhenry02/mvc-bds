<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class ZoneController extends Controller
{
    public function showIndex(): View|Factory|Application
    {
        $zones = Zone::all();
        return view('admin.page.zone.index',
            ['zones' => $zones]
        );
    }

    public function showCreate(): View|Factory|Application
    {
        $projects = Project::all();
        return view('admin.page.zone.create',
            ['projects' => $projects]
        );
    }

    public function showUpdate(Zone $zone): View|Factory|Application
    {
        $projects = Project::all();
        return view('admin.page.zone.update',
            [
                'zone' => $zone,
                'projects' => $projects
            ]
        );
    }

    public function postCreate(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $zone = new Zone();
            $zone->fill($input);
            $zone->save();
            DB::commit();
            return redirect()->route('zone.showIndex')->with('success', 'Tạo mới thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    public function postUpdate(Request $request, Zone $zone): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $zone->fill($input);
            $zone->save();
            DB::commit();
            return redirect()->route('zone.showIndex')->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    public function delete(Zone $zone): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $zone->delete();
            DB::commit();
            return redirect()->route('zone.showIndex')->with('success', 'Xóa thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }
}
