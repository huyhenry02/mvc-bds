<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\City;
use App\Models\Project;
use App\Models\Category;
use App\Models\District;
use App\Models\Investor;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class ProjectController extends Controller
{
    public function showIndex(): View|Factory|Application
    {
        $projects = Project::all();
        return view('admin.page.project.index'
            , ['projects' => $projects]
        );
    }

    public function showCreate(): View|Factory|Application
    {
        $categories = Category::all();
        $cities = City::all();
        $investors = Investor::all();
        return view('admin.page.project.create',
            [
                'categories' => $categories,
                'cities' => $cities,
                'investors' => $investors
            ]
        );
    }

    public function showUpdate(Project $project): View|Factory|Application
    {
        $categories = Category::all();
        $cities = City::all();
        $investors = Investor::all();
        return view('admin.page.project.update',
            [
                'project' => $project,
                'categories' => $categories,
                'cities' => $cities,
                'investors' => $investors
            ]
        );
    }

    public function getDistricts(Request $request): JsonResponse
    {
        $cityId = $request->city_id;
        $districts = District::where('city_id', $cityId)->get();

        return response()->json($districts);
    }

    public function postCreate(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $project = new Project();
            $project->fill($request->all());
            $project->save();
            if ($request->hasFile('qr_code')) {
                $project->qr_code = $this->handleUploadFile($request->file('qr_code'), $project, 'qr_code');
            }
            if ($request->hasFile('image_project')) {
                $project->image_project = $this->handleUploadFile($request->file('image_project'), $project, 'image_project');
            }
            $project->save();
            DB::commit();
            return redirect()->route('project.showIndex')->with('success', 'Tạo dự án thành công');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    public function postUpdate(Request $request, Project $project): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $project->fill($request->all());
            if ($request->hasFile('qr_code')) {
                $project->qr_code = $this->handleUploadFile($request->file('qr_code'), $project, 'qr_code');
            }
            if ($request->hasFile('image_project')) {
                $project->image_project = $this->handleUploadFile($request->file('image_project'), $project, 'image_project');
            }
            $project->save();
            DB::commit();
            return redirect()->route('project.showIndex')->with('success', 'Cập nhật dự án thành công');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    public function delete(Project $project): RedirectResponse
    {
        try {
            $project->delete();
            return redirect()->route('project.showIndex')->with('success', 'Xóa dự án thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    private function handleUploadFile($file, $model, $type): string
    {
        $fileName = $type . '_' . $model->id . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storePubliclyAs('projects/' . $type, $fileName);
        return asset('storage/' . $filePath);
    }
}
