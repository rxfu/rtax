<?php

namespace App\Http\Controllers;

use App\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller {

	private $upload = 'policies';

	public function getList() {
		$policies = Policy::all();

		return view('policy.list', compact('policies'));
	}

	public function getCreate() {
		return view('policy.create');
	}

	public function postSave(Request $request) {
		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$policy = new Policy();
			$policy->fill($inputs);

			if ($request->hasFile('file') && $request->file('file')->isValid()) {
				$file             = $request->file('file');
				$filename         = time() . '.' . $file->getClientOriginalExtension();
				$policy->name     = $file->getClientOriginalName();
				$policy->ext      = $file->getClientOriginalExtension();
				$policy->pathname = $this->upload . '/' . $filename;
				$file->storeAs('public/' . $this->upload, $filename);
			}

			$policy->save();

			return redirect()->route('policy.list');
		}
	}

	public function getEdit($id) {
		$policy = Policy::find($id);

		return view('policy.edit', compact('policy'));
	}

	public function putUpdate(Request $request, $id) {
		$inputs = $request->all();

		if ($request->isMethod('put')) {
			$policy = Policy::find($id);
			$policy->fill($inputs);

			if ($request->hasFile('file') && $request->file('file')->isValid()) {
				$file             = $request->file('file');
				$filename         = time() . '.' . $file->getClientOriginalExtension();
				$policy->name     = $file->getClientOriginalName();
				$policy->ext      = $file->getClientOriginalExtension();
				$policy->pathname = $this->upload . '/' . $filename;
				$file->storeAs('public/' . $this->upload, $filename);
			}

			$policy->save();

			return redirect()->route('policy.list');
		}
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$policy = Policy::find($id);
			$policy->delete();

			return redirect()->route('policy.list');
		}
	}
}