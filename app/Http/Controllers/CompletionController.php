<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompletionController extends Controller {

	public function getList() {
		$completions = Completion::all();

		return view('completion.list', compact('completions'));
	}

	public function getCreate() {
		$projects = Project::all();

		return view('completion.create', compact('projects'));
	}

	public function postSave(Request $request) {
		$this->validate($request, [
			'project_name'      => 'required',
			'lot_name'          => 'required',
			'completion_before' => 'required|numeric',
			'completion_after'  => 'required|numeric',
		]);

		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$completion = new Completion();
			$completion->fill($inputs);

			// 获取项目ID
			$project = Project::whereProjectName($inputs['project_name'])
				->whereLotName($inputs['lot_name'])
				->first();

			if (is_null($project)) {
				$request->session()->flash('error', '该标段不存在');

				return back();
			}

			$completion->project_id = $project->id;

			if ($completion->save()) {
				$request->session()->flash('success', '完工进度新增成功');
			} else {
				$request->session()->flash('error', '完工进度新增失败');
			}

			return redirect()->route('completion.list');
		}

		return back()->withErrors();
	}

	public function getEdit($id) {
		$completion = Completion::find($id);
		$projects   = Project::all();

		return view('completion.edit', compact('completion', 'projects'));
	}

	public function putUpdate(Request $request, $id) {
		$this->validate($request, [
			'project_name'      => 'required',
			'lot_name'          => 'required',
			'completion_before' => 'required|numeric',
			'completion_after'  => 'required|numeric',
		]);

		$inputs = $request->all();

		if ($request->isMethod('put')) {
			$completion = Completion::find($id);
			$completion->fill($inputs);

			// 获取项目ID
			$project = Project::whereProjectName($inputs['project_name'])
				->whereLotName($inputs['lot_name'])
				->first();

			if (is_null($project)) {
				$request->session()->flash('error', '该标段不存在');

				return back();
			}

			$completion->project_id = $project->id;
			$completion->user_id    = Auth::user()->id;

			if ($completion->save()) {
				$request->session()->flash('success', '完工进度更新成功');
			} else {
				$request->session()->flash('error', '完工进度更新失败');
			}

			return redirect()->route('completion.list');
		}

		return back()->withErrors();
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$completion = Completion::find($id);

			if (is_null($completion)) {
				$request->session()->flash('error', '该完工进度不存在');

				return back();
			} elseif ($completion->delete()) {
				$request->session()->flash('success', '完工进度' . $completion->id . '删除成功');
			} else {
				$request->session()->flash('error', '完工进度' . $completion->id . '删除失败');
			}

			return redirect()->route('completion.list');
		}

		return back()->withErrors();
	}
}
