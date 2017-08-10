<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
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

			return redirect()->route('user.list');
		}
	}

	public function getEdit($id) {
		$user = User::find($id);

		return view('user.edit', compact('user'));
	}

	public function putUpdate(Request $request, $id) {
		$inputs = $request->all();

		if ($request->isMethod('put')) {
			$user = User::find($id);
			$user->fill($inputs);
			$user->save();

			return redirect()->route('user.list');
		}
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$user = User::find($id);
			$user->delete();

			return redirect()->route('user.list');
		}
	}

	public function getChangePassword() {
		return view('user.change');
	}

	public function putChangePassword(Request $request) {
		$this->validate($request, [
			'password' => 'required|confirmed|min:6',
		]);

		if ($request->isMethod('put')) {
			$credentials = [
				'username' => Auth::user()->username,
				'password' => $request->input('old_password'),
			];

			if (Auth::attempt($credentials)) {
				$user           = Auth::user();
				$user->password = $request->input('password');
				$user->save();

				return redirect()->route('user.chgpwd');
			}
		}
	}

	public function getResetPassword($id) {
		$user = User::find($id);

		return view('user.reset', compact('user'));
	}

	public function putResetPassword(Request $request, $id) {
		$this->validate($request, [
			'password' => 'required|confirmed|min:6',
		]);

		if ($request->isMethod('put')) {
			$user           = User::find($id);
			$user->password = $request->input('password');
			$user->save();

			return redirect()->route('user.list');
		}
	}
}
