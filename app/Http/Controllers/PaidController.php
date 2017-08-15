<?php

namespace App\Http\Controllers;

use App\Paid;
use App\Project;
use App\Rate;
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
		$rates    = Rate::select('name')->distinct()->get();

		return view('paid.create', compact('projects', 'rates'));
	}

	public function postSave(Request $request) {
		$this->validate($request, [
			'project_name' => 'required',
			'lot_name'     => 'required',
			'amount'       => 'required|numeric',
			'total'        => 'required|numeric',
			'file'         => 'file|mimes:doc,docx,zip,rar,jpg,png',
		]);

		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$paid = new Paid();
			$paid->fill($inputs);

			// 获取项目ID
			$project = Project::whereProjectName($inputs['project_name'])
				->whereLotName($inputs['lot_name'])
				->first();

			if (is_null($project)) {
				$request->session()->flash('error', '该标段不存在');

				return back();
			}

			$paid->project_id = $project->id;
			$paid->user_id    = Auth::user()->id;
			$paid->year       = date('Y');

			if ($request->hasFile('file') && $request->file('file')->isValid()) {
				$file           = $request->file('file');
				$filename       = time() . '.' . $file->getClientOriginalExtension();
				$paid->name     = $file->getClientOriginalName();
				$paid->ext      = $file->getClientOriginalExtension();
				$paid->pathname = $this->upload . '/' . $filename;
				$file->storeAs('public/' . $this->upload, $filename);
			}

			if ($paid->save()) {
				$request->session()->flash('success', '可抵税项目新增成功');
			} else {
				$request->session()->flash('error', '可抵税项目新增失败');
			}

			return redirect()->route('tax.list');
		}

		return back()->withErrors();
	}

	public function getEdit($id) {
		$paid     = Paid::find($id);
		$projects = Project::all();
		$rates    = Rate::select('name')->distinct()->get();

		return view('paid.edit', compact('paid', 'projects', 'rates'));
	}

	public function putUpdate(Request $request, $id) {
		$this->validate($request, [
			'project_name' => 'required',
			'lot_name'     => 'required',
			'amount'       => 'required|numeric',
			'total'        => 'required|numeric',
			'file'         => 'file|mimes:doc,docx,zip,rar,jpg,png',
		]);

		$inputs = $request->all();

		if ($request->isMethod('put')) {
			$paid = Paid::find($id);
			$paid->fill($inputs);

			// 获取项目ID
			$project = Project::whereProjectName($inputs['project_name'])
				->whereLotName($inputs['lot_name'])
				->first();

			if (is_null($project)) {
				$request->session()->flash('error', '该标段不存在');

				return back();
			}

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

			if ($paid->save()) {
				$request->session()->flash('success', '可抵税项目更新成功');
			} else {
				$request->session()->flash('error', '可抵税项目更新失败');
			}

			return redirect()->route('tax.list');
		}

		return back()->withErrors();
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$paid = Declaration::whereId($id)
				->whereUserId(Auth::user()->id)
				->first();

			if (is_null($paid)) {
				$request->session()->flash('error', '该可抵税项目不存在');

				return back();
			} elseif ($paid->delete()) {
				$request->session()->flash('success', '可抵税项目' . $paid->id . '删除成功');
			} else {
				$request->session()->flash('error', '可抵税项目' . $paid->id . '删除失败');
			}

			return redirect()->route('tax.list');
		}

		return back()->withErrors();
	}
}
