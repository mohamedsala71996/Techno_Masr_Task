<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;
use App\Services\AdminService;
use Illuminate\Routing\Controller as BaseController;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
class AdminController extends BaseController
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
        $this->middleware('permission:view admins')->only('index');
        $this->middleware('permission:create admins')->only(['create', 'store']);
        $this->middleware('permission:edit admins')->only(['edit', 'update']);
        $this->middleware('permission:ban admins')->only(['ban', 'unban']);
    }

    public function index(Request $request)
    {
        $filters = $request->only([
            'email', 'status', 'date_from', 'date_to'
        ]);
        $firstAdmin = Admin::first();
        $admins = $this->adminService->filterAdminsWithPostCount($filters);
        return view('admin.admins.index', compact('admins', 'firstAdmin', 'filters'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.admins.create', compact('roles'));
    }

    public function store(AdminRequest $request)
    {
        $admin = $this->adminService->createAdmin($request->validated());
        if ($request->filled('role')) {
            $admin->assignRole($request->input('role'));
        }
        return redirect()->route('admin.admins.index')->with('success', 'تم إضافة المشرف بنجاح');
    }

    public function edit($id)
    {
        $admin = $this->adminService->findAdmin($id);
        $roles = Role::all();
        $adminRoles = $admin->roles->pluck('name')->toArray();
        return view('admin.admins.edit', compact('admin', 'roles', 'adminRoles'));
    }

    public function update(AdminRequest $request, $id)
    {
        $admin = $this->adminService->updateAdmin($id, $request->validated());
        if ($request->filled('role')) {
            $admin->syncRoles($request->input('role'));
        }
        return redirect()->route('admin.admins.index')->with('success', 'تم تحديث بيانات المشرف بنجاح');
    }

    public function ban($id)
    {
        try {
            $this->adminService->banAdmin($id);
            return redirect()->route('admin.admins.index')->with('success', 'تم حظر المشرف');
        } catch (\Exception $e) {
            return redirect()->route('admin.admins.index')->with('error', $e->getMessage());
        }
    }

    public function unban($id)
    {
        $this->adminService->unbanAdmin($id);
        return redirect()->route('admin.admins.index')->with('success', 'تم فك الحظر');
    }
}
