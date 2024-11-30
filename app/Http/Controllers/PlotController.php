<?php

namespace App\Http\Controllers;

use App\Models\Plot;
use App\Models\Zone;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class PlotController extends Controller
{
    public function showIndex(): View|Factory|Application
    {
        $plots = Plot::all();
        return view('admin.page.plot.index',
            ['plots' => $plots]
        );
    }

    public function showCreate(): View|Factory|Application
    {
        $projects = Project::all();
        $zones = Zone::all();
        return view('admin.page.plot.create',
            [
                'projects' => $projects,
                'zones' => $zones
            ]
        );
    }

    public function showUpdate(Plot $plot): View|Factory|Application
    {
        $projects = Project::all();
        $zones = Zone::all();
        return view('admin.page.plot.update',
            [
                'plot' => $plot,
                'projects' => $projects,
                'zones' => $zones
            ]
        );
    }

    public function getZonesOfProject(Request $request): JsonResponse
    {
        $project_id = $request->project_id;
        $zones = Zone::where('project_id', $project_id)->get();
        return response()->json($zones);
    }

    public function postCreate(Request $request): RedirectResponse
    {
        try {
            $input = $request->all();
            $plot = new Plot();
            $plot->fill($input);
            $plot->save();
            if ($request->hasFile('main_image')) {
                $plot->main_image = $this->handleUploadFile($request->file('main_image'), $plot, 'main_image');
            }
            if ($request->hasFile('sub_image_1')) {
                $plot->sub_image_1 = $this->handleUploadFile($request->file('sub_image_1'), $plot, 'sub_image_1');
            }
            if ($request->hasFile('sub_image_2')) {
                $plot->sub_image_2 = $this->handleUploadFile($request->file('sub_image_2'), $plot, 'sub_image_2');
            }
            if ($request->hasFile('sub_image_3')) {
                $plot->sub_image_3 = $this->handleUploadFile($request->file('sub_image_3'), $plot, 'sub_image_3');
            }
            if ($request->hasFile('sub_image_4')) {
                $plot->sub_image_4 = $this->handleUploadFile($request->file('sub_image_4'), $plot, 'sub_image_4');
            }
            $plot->save();
            return redirect()->route('plot.showIndex');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    public function postUpdate(Request $request, Plot $plot): RedirectResponse
    {
        try {
            $input = $request->all();
            $plot->fill($input);
            $plot->save();
            if ($request->hasFile('main_image')) {
                $plot->main_image = $this->handleUploadFile($request->file('main_image'), $plot, 'main_image');
            }
            if ($request->hasFile('sub_image_1')) {
                $plot->sub_image_1 = $this->handleUploadFile($request->file('sub_image_1'), $plot, 'sub_image_1');
            }
            if ($request->hasFile('sub_image_2')) {
                $plot->sub_image_2 = $this->handleUploadFile($request->file('sub_image_2'), $plot, 'sub_image_2');
            }
            if ($request->hasFile('sub_image_3')) {
                $plot->sub_image_3 = $this->handleUploadFile($request->file('sub_image_3'), $plot, 'sub_image_3');
            }
            if ($request->hasFile('sub_image_4')) {
                $plot->sub_image_4 = $this->handleUploadFile($request->file('sub_image_4'), $plot, 'sub_image_4');
            }
            $plot->save();
            return redirect()->route('plot.showIndex');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    public function delete(Plot $plot): RedirectResponse
    {
        try {
            $plot->delete();
            return redirect()->route('plot.showIndex');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    private function handleUploadFile($file, $model, $type): string
    {
        $fileName = $type . '_' . $model->id . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storePubliclyAs('plots/' . $type, $fileName);
        return asset('storage/' . $filePath);
    }
}
