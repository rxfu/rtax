<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeclarationController extends Controller {

	public function getList() {
		$declarations = Declaration::all();

		return view('declaration.list', compact('declarations'));
	}

	public function getCreate() {
		return view('declaration.create');
	}

	public function postSave(Request $request) {
		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$declaration = new Declaration();
			$declaration->fill($inputs);
			$declaration->save();

			return redirect()->route('declaration.list');
		}
	}

	public function getEdit($id) {
		$declaration = Declaration::find($id);

		return view('declaration.edit', compact('declaration'));
	}

	public function putUpdate(Request $request, $id) {
		$inputs = $request->all();

		if ($request->isMethod('put')) {
			$declaration = Declaration::find($id);
			$declaration->fill($inputs);
			$declaration->save();

			return redirect()->route('declaration.list');
		}
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$declaration = Declaration::find($id);
			$declaration->delete();

			return redirect()->route('declaration.list');
		}
	}
}
