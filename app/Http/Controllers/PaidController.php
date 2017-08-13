<?php

namespace App\Http\Controllers;

use App\Paid;
use App\Project;
use Auth;
use Illuminate\Http\Request;

class PaidController extends Controller {

	private $upload = 'files';

	public function getList() {
		if (Auth::user()->is_admin) {
			$paids = Paid::all();
		} else {
			$paids = Paid::whereUserId(Auth::user()->id)->get();
		}

		return view('tax.list', compact('paids'));
	}

	public function getCreate() {
		$projects = Project::all();

		return view('paid.create', compact('projects'));
	}

	public function postSave(Request $request) {
		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$paid = new Paid();
			$paid->fill($inputs);

			// 获取项目ID
			$project = Project::whereProjectName($inputs['project_name'])
				->whereLotName($inputs['lot_name'])
				->whereLotType($inputs['lot_type'])
				->first();

			$paid->project_id = $project->id;
			$paid->user_id    = Auth::user()->id;

			if ($request->hasFile('file') && $request->file('file')->isValid()) {
				$file           = $request->file('file');
				$filename       = time() . '.' . $file->getClientOriginalExtension();
				$paid->name     = $file->getClientOriginalName();
				$paid->ext      = $file->getClientOriginalExtension();
				$paid->pathname = $this->upload . '/' . $filename;
				$file->storeAs('public/' . $this->upload, $filename);
			}

			$paid->save();

			return redirect()->route('tax.list');
		}
	}

	public function getEdit($id) {
		$paid     = Paid::find($id);
		$projects = Project::all();

		return view('paid.edit', compact('paid', 'projects'));
	}

	public function putUpdate(Request $request, $id) {
		$inputs = $request->all();

		if ($request->isMethod('put')) {
			$paid = Paid::find($id);
			$paid->fill($inputs);

			// 获取项目ID
			$project = Project::whereProjectName($inputs['project_name'])
				->whereLotName($inputs['lot_name'])
				->whereLotType($inputs['lot_type'])
				->first();

			$paid->project_id = $project->id;
			$paid->user_id    = Auth::user()->id;

			if ($request->hasFile('file') && $request->file('file')->isValid()) {
				$file           = $request->file('file');
				$filename       = time() . '.' . $file->getClientOriginalExtension();
				$paid->name     = $file->getClientOriginalName();
				$paid->ext      = $file->getClientOriginalExtension();
				$paid->pathname = $this->upload . '/' . $filename;
				$file->storeAs('public/' . $this->upload, $filename);
			}

			$paid->save();

			return redirect()->route('tax.list');
		}
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$paid = Paid::find($id);
			$paid->delete();

			return redirect()->route('tax.list');
		}
	}
}
