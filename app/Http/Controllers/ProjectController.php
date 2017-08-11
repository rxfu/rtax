<?php

namespace App\Http\Controllers;

use App\Project;
use Auth;
use Illuminate\Http\Request;

class ProjectController extends Controller {

	public function getList() {
		$projects = Project::all();

		return view('project.list', compact('projects'));
	}

	public function getCreate() {
		return view('project.create');
	}

	public function postSave(Request $request) {
		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$project = new Project();
			$project->fill($inputs);
			$project->user_id = Auth::user()->id;
			$project->save();

			return redirect()->route('project.list');
		}
	}

	public function getEdit($id) {
		$project = Project::find($id);

		return view('project.edit', compact('project'));
	}

	public function putUpdate(Request $request, $id) {
		$inputs = $request->all();

		if ($request->isMethod('put')) {
			$project = Project::find($id);
			$project->fill($inputs);
			$project->save();

			return redirect()->route('project.list');
		}
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$project = Project::find($id);
			$project->delete();

			return redirect()->route('project.list');
		}
	}
}
