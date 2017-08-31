<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller {

	public function getList() {
		$departments = Department::all();

		return view('department.list', compact('departments'));
	}

	public function getCreate() {
		return view('department.create');
	}

	public function postSave(Request $request) {
		$this->validate($request, [
			'name'         => 'required',
			'is_activated' => 'required',
		]);

		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$department = new Department();
			$department->fill($inputs);

			if ($department->save()) {
				$request->session()->flash('success', '单位新增成功');
			} else {
				$request->session()->flash('error', '单位新增失败');
			}

			return redirect()->route('department.list');
		}

		return back()->withErrors();
	}

	public function getEdit($id) {
		$department = Department::find($id);

		return view('department.edit', compact('department'));
	}

	public function putUpdate(Request $request, $id) {
		$this->validate($request, [
			'name'         => 'required',
			'is_activated' => 'required',
		]);

		$inputs = $request->all();

		if ($request->isMethod('put')) {
			$department = Department::find($id);
			$department->fill($inputs);

			if ($department->save()) {
				$request->session()->flash('success', '单位更新成功');
			} else {
				$request->session()->flash('error', '单位更新失败');
			}

			return redirect()->route('department.list');
		}

		return back()->withErrors();
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$department = Department::find($id);

			if (is_null($department)) {
				$request->session()->flash('error', '该单位不存在');

				return back();
			} elseif ($department->delete()) {
				$request->session()->flash('success', '单位' . $department->id . '删除成功');
			} else {
				$request->session()->flash('error', '单位' . $department->id . '删除失败');
			}

			return redirect()->route('department.list');
		}

		return back()->withErrors();
	}
}
