<?php

namespace App\Http\Controllers;

use App\Rate;
use Illuminate\Http\Request;

class RateController extends Controller {

	public function getList() {
		$rates = Rate::all();

		return view('rate.list', compact('rates'));
	}

	public function getCreate() {
		return view('rate.create');
	}

	public function postSave(Request $request) {
		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$rate = new Rate();
			$rate->fill($inputs);
			$rate->save();

			return redirect()->route('rate.list');
		}
	}

	public function getEdit($id) {
		$rate = Rate::find($id);

		return view('rate.edit', compact('rate'));
	}

	public function putUpdate(Request $request, $id) {
		$inputs = $request->all();

		if ($request->isMethod('put')) {
			$rate = Rate::find($id);
			$rate->fill($inputs);
			$rate->save();

			return redirect()->route('rate.list');
		}
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$rate = Rate::find($id);
			$rate->delete();

			return redirect()->route('rate.list');
		}
	}
}
