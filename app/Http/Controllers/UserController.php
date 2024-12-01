<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class UserController extends Controller
{
    public function showIndex(): View|Factory|Application
    {
        $uses = User::all();
        return view('admin.page.user.index'
            , [
                'users' => $uses
            ]);
    }

    public function showCreate(): View|Factory|Application
    {
        return view('admin.page.user.create');
    }

    public function showUpdate(User $user): View|Factory|Application
    {
        return view('admin.page.user.update',
            [
                'user' => $user
            ]);
    }
    public function searchUsers(Request $request): View|Factory|Application
    {
        $query = $request->input('query');

        $users = User::where('full_name', 'like', '%' . $query . '%')->get();
        return view('admin.page.user.search-results', compact('users'));
    }

    public function postUpdate(User $user, Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            if ($input['password'] == null) {
                unset($input['password']);
            } else {
                $input['password'] = bcrypt($input['password']);
            }
            $user->fill($input);
            $user->save();
            DB::commit();
            return redirect()->route('user.showIndex')->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }
}
