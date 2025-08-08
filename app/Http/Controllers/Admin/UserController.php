<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\ImageHandler;
use Illuminate\Routing\Controller as BaseController;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends BaseController
{
    use ImageHandler;
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('permission:view users')->only('index');
        $this->middleware('permission:create users')->only('create', 'store');
        $this->middleware('permission:edit users')->only('edit', 'update');
        $this->middleware('permission:ban users')->only('ban', 'unban');
    }

    public function index(Request $request)
    {
        $filters = $request->only([
            'email', 'status', 'date_from', 'date_to'
        ]);
        $users = $this->userService->filterUsersWithPostCount($filters);
        return view('admin.users.index', compact('users', 'filters'));
    }

    public function export(Request $request)
    {
        $filters = $request->only([
            'email', 'status', 'date_from', 'date_to'
        ]);
        return Excel::download(new UserExport($filters), 'users.xlsx');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UserRequest $request)
    {
        $user = $this->userService->createUser($request->validated());
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $this->updateMorphImage($user, $path, 'profile_image');
        }
        return redirect()->route('admin.users.index')->with('success', 'تم إضافة المستخدم بنجاح');
    }

    public function edit($id)
    {
        $user = $this->userService->findUser($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(UserRequest $request, $id)
    {
        $user = $this->userService->updateUser($id, $request->validated());
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $this->updateMorphImage($user, $path, 'profile_image');
        }
        return redirect()->route('admin.users.index')->with('success', 'تم تحديث بيانات المستخدم');
    }

    public function ban($id)
    {
        $this->userService->banUser($id);
        return redirect()->route('admin.users.index')->with('success', 'تم حظر المستخدم');
    }

    public function unban($id)
    {
        $this->userService->unbanUser($id);
        return redirect()->route('admin.users.index')->with('success', 'تم فك الحظر عن المستخدم');
    }
}
