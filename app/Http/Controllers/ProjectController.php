<?php

namespace App\Http\Controllers;

use App\Project;
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
			'name'            => 'required',
			'building'        => 'required',
			'building_number' => 'required',
			'roadbed_amount'  => 'required|numeric',
			'road_amount'     => 'required|numeric',
			'investment'      => 'required|numeric',
			'kilometre'       => 'required|numeric',
			'address'         => 'required',
			'begtime'         => 'required|date',
			'endtime'         => 'required|date',
			'authority'       => 'required',
			'bureau'          => 'required',
			'finance'         => 'required',
			'finance_phone'   => 'required',
		]);

		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$project = new Project();
			$project->fill($inputs);

			if ($project->save()) {
				$request->session()->flash('success', '项目新增成功');
			} else {
				$request->session()->flash('error', '项目新增失败');
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
			'name'            => 'required',
			'building'        => 'required',
			'building_number' => 'required',
			'roadbed_amount'  => 'required|numeric',
			'road_amount'     => 'required|numeric',
			'investment'      => 'required|numeric',
			'kilometre'       => 'required|numeric',
			'address'         => 'required',
			'begtime'         => 'required|date',
			'endtime'         => 'required|date',
			'authority'       => 'required',
			'bureau'          => 'required',
			'finance'         => 'required',
			'finance_phone'   => 'required',
		]);

		$inputs = $request->all();

		if ($request->isMethod('put')) {
			$project = Project::find($id);
			$project->fill($inputs);

			if ($project->save()) {
				$request->session()->flash('success', '项目更新成功');
			} else {
				$request->session()->flash('error', '项目更新失败');
			}

			return redirect()->route('project.list');
		}

		return back()->withErrors();
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$project = Project::find($id);

			if (is_null($project)) {
				$request->session()->flash('error', '该项目不存在');

				return back();
			} elseif ($project->delete()) {
				$request->session()->flash('success', '项目' . $project->id . '删除成功');
			} else {
				$request->session()->flash('error', '项目' . $project->id . '删除失败');
			}

			return redirect()->route('project.list');
		}

		return back()->withErrors();
	}
}
