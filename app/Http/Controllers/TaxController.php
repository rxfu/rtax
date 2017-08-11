<?php

namespace App\Http\Controllers;

use App\Project;
use App\Rate;
use App\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller {

	public function getList() {
		$taxes = Tax::all();

		return view('tax.list', compact('taxes'));
	}

	public function getCreate() {
		$projects = Project::all();
		$rates    = Rate::select('name')->distinct()->get();

		return view('tax.create', compact('projects', 'rates'));
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
