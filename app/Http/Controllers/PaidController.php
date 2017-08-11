<?php

namespace App\Http\Controllers;

use App\Paid;
use Illuminate\Http\Request;

class PaidController extends Controller {

	public function getList() {
		$paids = Paid::all();

		return view('paid.list', compact('paids'));
	}

	public function getCreate() {
		return view('paid.create');
	}

	public function postSave(Request $request) {
		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$paid = new Paid();
			$paid->fill($inputs);
			$paid->save();

			return redirect()->route('paid.list');
		}
	}

	public function getEdit($id) {
		$paid = Paid::find($id);

		return view('paid.edit', compact('paid'));
	}

	public function putUpdate(Request $request, $id) {
		$inputs = $request->all();

		if ($request->isMethod('put')) {
			$paid = Paid::find($id);
			$paid->fill($inputs);
			$paid->save();

			return redirect()->route('paid.list');
		}
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$paid = Paid::find($id);
			$paid->delete();

			return redirect()->route('paid.list');
		}
	}
}
