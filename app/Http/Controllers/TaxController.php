<?php

namespace App\Http\Controllers;

use App\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller {

	public function getList() {
		$taxs = Tax::all();

		return view('tax.list', compact('taxs'));
	}

	public function getCreate() {
		return view('tax.create');
	}

	public function postSave(Request $request) {
		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$tax = new Tax();
			$tax->fill($inputs);
			$tax->save();

			return redirect()->route('tax.list');
		}
	}

	public function getEdit($id) {
		$tax = Tax::find($id);

		return view('tax.edit', compact('tax'));
	}

	public function putUpdate(Request $request, $id) {
		$inputs = $request->all();

		if ($request->isMethod('put')) {
			$tax = Tax::find($id);
			$tax->fill($inputs);
			$tax->save();

			return redirect()->route('tax.list');
		}
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$tax = Tax::find($id);
			$tax->delete();

			return redirect()->route('tax.list');
		}
	}
}
