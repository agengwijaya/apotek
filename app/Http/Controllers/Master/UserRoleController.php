<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
	public function index()
	{
		return view('master.role_management.index', [
			'roles' => Role::all()
		]);
	}

	public function store(Request $request)
	{
		$data_insert = [
			'nama' => $request->nama,
		];

		Role::create($data_insert);

		return redirect('data-master-user/data-user-role');
	}
}
