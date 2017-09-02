<?php

namespace App\Http\Controllers;

use App\Department;
use App\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller {

	public function getList() {
		$users = User::with('department')->get();

		return view('user.list', compact('users'));
	}

	public function getCreate() {
		$departments = Department::whereIsActivated(true)->select('id', 'name')->get();

		return view('user.create', compact('departments'));
	}

	public function postSave(Request $request) {
		$this->validate($request, [
			'username'      => 'required|string|max:255|unique:users',
			'password'      => 'required|string|min:6',
			'department_id' => 'required',
			'is_admin'      => 'required',
		]);

		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$user = new User();
			$user->fill($inputs);

			if ($user->save()) {
				$request->session()->flash('success', '用户新增成功');
			} else {
				$request->session()->flash('error', '用户新增失败');
			}

			return redirect()->route('user.list');
		}

		return back()->withErrors();
	}

	public function getEdit($id) {
		$user        = User::find($id);
		$departments = Department::whereIsActivated(true)->select('id', 'name')->get();

		return view('user.edit', compact('user', 'departments'));
	}

	public function putUpdate(Request $request, $id) {
		$this->validate($request, [
			'username'      => 'required|string|max:255',
			'department_id' => 'required',
			'is_admin'      => 'required',
		]);

		$inputs = $request->all();

		if ($request->isMethod('put')) {
			$user = User::find($id);
			$user->fill($inputs);

			if ($user->save()) {
				$request->session()->flash('success', '用户更新成功');
			} else {
				$request->session()->flash('error', '用户更新失败');
			}

			return redirect()->route('user.list');
		}

		return back()->withErrors();
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$user = User::find($id);

			if (is_null($user)) {
				$request->session()->flash('error', '该用户不存在');

				return back();
			} elseif ($user->delete()) {
				$request->session()->flash('success', '用户' . $user->id . '删除成功');
			} else {
				$request->session()->flash('error', '用户' . $user->id . '删除失败');
			}

			return redirect()->route('user.list');
		}

		return back()->withErrors();
	}

	public function getChangePassword() {
		return view('user.change');
	}

	public function putChangePassword(Request $request) {
		$this->validate($request, [
			'old_password' => 'required|string',
			'password'     => 'required|string|confirmed|min:6',
		]);

		if ($request->isMethod('put')) {
			$credentials = [
				'username' => Auth::user()->username,
				'password' => $request->input('old_password'),
			];

			if (Auth::attempt($credentials)) {
				$user           = Auth::user();
				$user->password = $request->input('password');

				if ($user->save()) {
					$request->session()->flash('success', '用户密码修改成功');
				} else {
					$request->session()->flash('error', '用户密码修改失败');
				}

				return redirect()->route('user.chgpwd');
			}
		}

		return back()->withErrors();
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

			if ($user->save()) {
				$request->session()->flash('success', '用户密码重置成功');
			} else {
				$request->session()->flash('error', '用户密码重置失败');
			}

			return redirect()->route('user.list');
		}

		return back()->withErrors();
	}
}
