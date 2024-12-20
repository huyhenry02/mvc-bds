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

    public function searchProjects(Request $request): View|Factory|Application
    {
        $query = $request->input('query');
        $status = $request->input('status');

        $projects = Project::query()
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'like', '%' . $query . '%');
            })
            ->when($status, function ($queryBuilder) use ($status) {
                $queryBuilder->where('status', $status);
            })
            ->get();

        return view('admin.page.project.search-results', compact('projects'));
    }

    public function postCreate(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $project = new Project();
            $input = $request->all();
            $investor_ids_array = explode(',', $input['investor_ids'][0]);
            $project->fill($input);
            $project->save();
            $project->investors()->attach($investor_ids_array);
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
            $input = $request->all();
            $investor_ids_array = explode(',', $input['investor_ids'][0]);
            $project->fill($input);
            $project->save();
            $project->investors()->sync($investor_ids_array);
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
