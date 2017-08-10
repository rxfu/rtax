<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller {

	public function getList() {
		$users = User::all();

		return view('user.list', compact('users'));
	}

	public function getCreate() {
		return view('user.create');
	}

	public function postSave(Request $request) {
		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$user = new User();
			$user->fill($inputs);
			$user->save();

			return redirect('user.list');
		}
	}

	public function getEdit($id) {
		$user = User::find($id);

		return view('user.edit', compact('user'));
	}

	public function postUpdate(Request $request, $id) {
		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$user = User::find($id);
			$user->fill($inputs);
			$user->save();

			return redirect('user.list');
		}
	}

	public function postDelete(Request $request, $id) {
		if ($request->isMethod('post')) {
			$user = User::find($id);
			$user->delete();

			return redirect('user.list');
		}
	}
}
