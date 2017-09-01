<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;

class TypeController extends Controller {

	public function getList() {
		$types = Type::all();

		return view('type.list', compact('types'));
	}

	public function getCreate() {
		return view('type.create');
	}

	public function postSave(Request $request) {
		$this->validate($request, [
			'name' => 'required',
		]);

		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$type = new Type();
			$type->fill($inputs);

			if ($type->save()) {
				$request->session()->flash('success', '标段类型新增成功');
			} else {
				$request->session()->flash('error', '标段类型新增失败');
			}

			return redirect()->route('type.list');
		}

		return back()->withErrors();
	}

	public function getEdit($id) {
		$type = Type::find($id);

		return view('type.edit', compact('type'));
	}

	public function putUpdate(Request $request, $id) {
		$this->validate($request, [
			'name' => 'required',
		]);

		$inputs = $request->all();

		if ($request->isMethod('put')) {
			$type = Type::find($id);
			$type->fill($inputs);

			if ($type->save()) {
				$request->session()->flash('success', '标段类型更新成功');
			} else {
				$request->session()->flash('error', '标段类型更新失败');
			}

			return redirect()->route('type.list');
		}

		return back()->withErrors();
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$type = Type::find($id);

			if (is_null($type)) {
				$request->session()->flash('error', '该标段类型不存在');

				return back();
			} elseif ($type->delete()) {
				$request->session()->flash('success', '标段类型' . $type->id . '删除成功');
			} else {
				$request->session()->flash('error', '标段类型' . $type->id . '删除失败');
			}

			return redirect()->route('type.list');
		}

		return back()->withErrors();
	}
}
