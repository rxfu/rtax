<?php

namespace App\Http\Controllers;

use App\Declaration;
use App\Project;
use Auth;
use Illuminate\Http\Request;

class DeclarationController extends Controller {

	public function getList() {
		$declarations = Declaration::all();

		return view('tax.list', compact('declarations'));
	}

	public function getCreate() {
		$projects = Project::all();

		return view('declaration.create', compact('projects'));
	}

	public function postSave(Request $request) {
		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$declaration = new Declaration();
			$declaration->fill($inputs);

			// 获取项目ID
			$project = Project::whereProjectName($inputs['project_name'])
				->whereLotName($inputs['lot_name'])
				->whereLotType($inputs['lot_type'])
				->first();

			$declaration->project_id = $project->id;
			$declaration->user_id    = Auth::user()->id;

			$declaration->save();

			return redirect()->route('tax.list');
		}
	}

	public function getEdit($id) {
		$declaration = Declaration::find($id);
		$projects    = Project::all();

		return view('declaration.edit', compact('declaration', 'projects'));
	}

	public function putUpdate(Request $request, $id) {
		$inputs = $request->all();

		if ($request->isMethod('put')) {
			$declaration = Declaration::find($id);
			$declaration->fill($inputs);

			// 获取项目ID
			$project = Project::whereProjectName($inputs['project_name'])
				->whereLotName($inputs['lot_name'])
				->whereLotType($inputs['lot_type'])
				->first();

			$declaration->project_id = $project->id;
			$declaration->user_id    = Auth::user()->id;

			$declaration->save();

			return redirect()->route('tax.list');
		}
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$declaration = Declaration::find($id);
			$declaration->delete();

			return redirect()->route('tax.list');
		}
	}
}
