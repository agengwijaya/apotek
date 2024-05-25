<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\AksesMobile;
use App\Models\Role;
use App\Models\User;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
	public function index()
	{
		try {
			return view('master.user.index', [
				'users' => User::where('users.soft_delete', 0)->select('users.*')->get(),
				'roles' => Role::all(),
			]);
		} catch (\Throwable $th) {
			return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
		}
	}

	public function data(Request $request)
	{
		if ($request->ajax()) {
			$query = User::where('soft_delete', 0);

			if (!auth()->user()->hasRole('Administrator')) {
				$query->where('id', auth()->user()->id);
			}

			$data = $query->get();

			return DataTables::of($data)->addIndexColumn()
				->addColumn('role', function ($item) {
					foreach ($item->role as $role) {
						return $role->name;
					}
				})
				->addColumn('action', function ($item) {
					$btn = '';
					$btn .= '<button class="btn btn-danger btn-xs me-1" id="btn_delete" data-id="' . $item->id . '" data-bs-toggle="modal" data-bs-target="#modalDelete"><i class="fa fa-trash"></i></button>';
					$btn .= "<a href='" . url("data-master-user/data-user", $item->id) . "' class='btn btn-warning btn-xs me-1'><i class='fa fa-pencil'></i></a>";
					return $btn;
				})
				->rawColumns(['action'])
				->make(true);
		}
	}

	public function store(Request $request)
	{
		try {
			$data_insert = [
				'name' => $request->name,
				'username' => $request->username,
				'email' => $request->email,
				'password' => bcrypt($request->password),
			];

			$user = User::create($data_insert);
			$user->assignRole($request->input('role'));

			return back();
		} catch (\Throwable $th) {
			return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
		}
	}

	public function edit(User $user)
	{
		try {
			return view('master.user.edit', [
				'user' => $user,
				'userRole' => $user->roles->pluck('name')->toArray(),
				'roles' => Role::latest()->get()
			]);
		} catch (\Throwable $th) {
			return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
		}
	}

	public function update(Request $request, User $user)
	{
		try {
			$data_update = [
				'name' => $request->name,
				'username' => $request->username,
				'email' => $request->email,
			];

			if (!empty($request->password)) {
				$data_update['password'] = bcrypt($request->password);
			}

			$user->update($data_update);

			$user->syncRoles($request->get('role'));

			return redirect('data-master-user/data-user');
		} catch (\Throwable $th) {
			return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
		}
	}

	public function destroy($id)
	{
		try {
			User::where('id', $id)->update(['soft_delete' => 1]);

			return back();
		} catch (\Throwable $th) {
			return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
		}
	}

	public function profil(User $user)
	{
		try {
			return view('master.user.profil', [
				'user' => $user,
			]);
		} catch (\Throwable $th) {
			return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
		}
	}

	public function update_profil(Request $request, User $user)
	{
		try {
			$data_update = [
				'name' => $request->name,
				'username' => $request->username,
				'email' => $request->email,
			];

			if (!empty($request->password)) {
				$data_update['password'] = bcrypt($request->password);
			}

			$user->update($data_update);

			return back()->with('success', 'Berhasil memperbarui data!');
		} catch (\Throwable $th) {
			return back()->with('error', 'Maaf, ada kesalahan data. Silahkan coba kembali!');
		}
	}
}
