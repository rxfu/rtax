<?php

namespace App\Http\Controllers;

use App\Declaration;
use App\Project;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeclarationController extends Controller {

	public function getList() {
		if (Auth::user()->is_admin) {
			$declarations = Declaration::all();
		} else {
			$declarations = Declaration::whereUserId(Auth::user()->id)->get();
		}

		return view('tax.list', compact('declarations'));
	}

	public function getCreate() {
		$projects = Project::all();

		return view('declaration.create', compact('projects'));
	}

	public function postSave(Request $request) {
		$this->validate($request, [
			'project_name' => 'required',
			'lot_name'     => 'required',
			'lot_type'     => 'required',
			'total'        => 'required|numeric',
		]);

		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$declaration = new Declaration();
			$declaration->fill($inputs);

			// 获取项目ID
			$project = Project::whereProjectName($inputs['project_name'])
				->whereLotName($inputs['lot_name'])
				->whereLotType($inputs['lot_type'])
				->first();

			if (is_null($project)) {
				$request->session()->flash('error', '该标段不存在');

				return back();
			}

			$declaration->project_id = $project->id;
			$declaration->user_id    = Auth::user()->id;
			$declaration->year       = Carbon::year();

			if ($declaration->save()) {
				$request->session()->flash('success', '自行申报项目新增成功');
			} else {
				$request->session()->flash('error', '自行申报项目新增失败');
			}

			return redirect()->route('tax.list');
		}

		return back()->withErrors();
	}

	public function getEdit($id) {
		$declaration = Declaration::find($id);
		$projects    = Project::all();

		return view('declaration.edit', compact('declaration', 'projects'));
	}

	public function putUpdate(Request $request, $id) {
		$this->validate($request, [
			'project_name' => 'required',
			'lot_name'     => 'required',
			'lot_type'     => 'required',
			'total'        => 'required|numeric',
		]);

		$inputs = $request->all();

		if ($request->isMethod('put')) {
			$declaration = Declaration::find($id);
			$declaration->fill($inputs);

			// 获取项目ID
			$project = Project::whereProjectName($inputs['project_name'])
				->whereLotName($inputs['lot_name'])
				->whereLotType($inputs['lot_type'])
				->first();

			if (is_null($project)) {
				$request->session()->flash('error', '该标段不存在');

				return back();
			}

			$declaration->project_id = $project->id;
			$declaration->user_id    = Auth::user()->id;

			if ($declaration->save()) {
				$request->session()->flash('success', '自行申报项目更新成功');
			} else {
				$request->session()->flash('error', '自行申报项目更新失败');
			}

			return redirect()->route('tax.list');
		}

		return back()->withErrors();
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$declaration = Declaration::whereId($id)
				->whereUserId(Auth::user()->id)
				->first();

			if (is_null($declaration)) {
				$request->session()->flash('error', '该自行申报项目不存在');

				return back();
			} elseif ($declaration->delete()) {
				$request->session()->flash('success', '自行申报项目' . $declaration->id . '删除成功');
			} else {
				$request->session()->flash('error', '自行申报项目' . $declaration->id . '删除失败');
			}

			return redirect()->route('tax.list');
		}

		return back()->withErrors();
	}
}
