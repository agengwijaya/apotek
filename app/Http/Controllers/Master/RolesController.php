<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $roles = Role::orderBy('id', 'DESC')->get();
            $title = 'Data Role Managemen';
            return view('master.role_management.index', compact('roles', 'title'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $permissions = Permission::get();
            return view('master.role_management.create', compact('permissions'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|unique:roles,name',
                'permission' => 'required',
            ]);
    
            $role = Role::create(['name' => $request->get('name')]);
            $role->syncPermissions($request->get('permission'));
    
            return redirect()->route('roles.index')
                ->with('success', 'Role Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        try {
            $role = $role;
            $rolePermissions = $role->permissions;
    
            return view('roles.show', compact('role', 'rolePermissions'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        try {
            $role = $role;
            $rolePermissions = $role->permissions->pluck('name')->toArray();
            $permissions = Permission::get();
    
            return view('master.role_management.edit', compact('role', 'rolePermissions', 'permissions'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Role $role, Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                // 'permission' => 'required',
            ]);
    
            $role->update($request->only('name'));
    
            $role->syncPermissions($request->get('permission'));
    
            return redirect()->route('roles.index')
                ->with('success', 'Role updated successfully');
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        try {
            $role->delete();

            return redirect()->route('roles.index')
                ->with('success', 'Role deleted successfully');
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
        }
    }

    public function tambah_route(Request $request, $id)
    {
        try {
            $data = [
                'module_id' => $id,
                'name' => $request->route_name,
                'nama_aksi' => $request->nama_aksi,
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            DB::table('permissions')->insert($data);
            return back();
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
        }
    }

    public function hapus_route($id)
    {
        try {
            DB::table('permissions')->where('id', $id)->delete();
            return back();
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
        }
    }
}
