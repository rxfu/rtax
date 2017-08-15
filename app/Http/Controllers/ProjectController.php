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
		$this->validate($request, [
			'project_name' => 'required',
			'lot_name'     => 'required',
			'lot_type'     => 'required',
		]);

		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$project = new Project();
			$project->fill($inputs);
			$project->user_id = Auth::user()->id;

			if ($project->save()) {
				$request->session()->flash('success', '标段新增成功');
			} else {
				$request->session()->flash('error', '标段新增失败');
			}

			return redirect()->route('project.list');
		}

		return back()->withErrors();
	}

	public function getEdit($id) {
		$project = Project::find($id);

		return view('project.edit', compact('project'));
	}

	public function putUpdate(Request $request, $id) {
		$this->validate($request, [
			'project_name' => 'required',
			'lot_name'     => 'required',
			'lot_type'     => 'required',
		]);

		$inputs = $request->all();

		if ($request->isMethod('put')) {
			$project = Project::find($id);
			$project->fill($inputs);
			$project->user_id = Auth::user()->id;

			if ($project->save()) {
				$request->session()->flash('success', '标段更新成功');
			} else {
				$request->session()->flash('error', '标段更新失败');
			}

			return redirect()->route('project.list');
		}

		return back()->withErrors();
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$project = Project::find($id);

			if (is_null($project)) {
				$request->session()->flash('error', '该标段不存在');

				return back();
			} elseif ($project->delete()) {
				$request->session()->flash('success', '标段' . $project->id . '删除成功');
			} else {
				$request->session()->flash('error', '标段' . $project->id . '删除失败');
			}

			return redirect()->route('project.list');
		}

		return back()->withErrors();
	}
}
