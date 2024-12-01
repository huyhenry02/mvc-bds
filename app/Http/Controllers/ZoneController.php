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
        $projects = Project::all();
        return view('admin.page.zone.index',
            [
                'zones' => $zones,
                'projects' => $projects
            ]
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
    public function searchZones(Request $request): View|Factory|Application
    {
        $query = $request->input('query');
        $project_id = $request->input('project_id');

        $zones = Zone::query()
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'like', '%' . $query . '%')
                    ->orWhere('code', 'like', '%' . $query . '%');
            })
            ->when($project_id, function ($queryBuilder) use ($project_id) {
                $queryBuilder->where('project_id', $project_id);
            })
            ->get();
        return view('admin.page.zone.search-results', compact('zones'));
    }

    public function postCreate(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $zone = new Zone();
            $zone->fill($input);
            $zone->save();

            $zone->code = 'PK-' . $zone->id;
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
