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
		$this->validate($request, [
			'name' => 'required',
			'file' => 'required|file|mimes:doc,docx,pdf,zip,rar',
		]);

		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$policy = new Policy();
			$policy->fill($inputs);

			if ($request->hasFile('file') && $request->file('file')->isValid()) {
				$file             = $request->file('file');
				$filename         = time() . '.' . $file->getClientOriginalExtension();
				$policy->name     = $inputs['name'];
				$policy->ext      = $file->getClientOriginalExtension();
				$policy->pathname = $this->upload . '/' . $filename;
				$file->storeAs('public/' . $this->upload, $filename);
			}

			if ($policy->save()) {
				$request->session()->flash('success', '政策文件上传成功');
			} else {
				$request->session()->flash('error', '政策文件上传失败');
			}

			return redirect()->route('policy.list');
		}

		return back()->withErrors();
	}

	public function getEdit($id) {
		$policy = Policy::find($id);

		return view('policy.edit', compact('policy'));
	}

	public function putUpdate(Request $request, $id) {
		$this->validate($request, [
			'name' => 'required',
			'file' => 'file|mimes:doc,docx,pdf,zip,rar',
		]);

		$inputs = $request->all();

		if ($request->isMethod('put')) {
			$policy = Policy::find($id);
			$policy->fill($inputs);

			if ($request->hasFile('file') && $request->file('file')->isValid()) {
				$file             = $request->file('file');
				$filename         = time() . '.' . $file->getClientOriginalExtension();
				$policy->name     = $inputs['name'];
				$policy->ext      = $file->getClientOriginalExtension();
				$policy->pathname = $this->upload . '/' . $filename;
				$file->storeAs('public/' . $this->upload, $filename);
			}

			if ($policy->save()) {
				$request->session()->flash('success', '政策文件更新成功');
			} else {
				$request->session()->flash('error', '政策文件更新失败');
			}

			return redirect()->route('policy.list');
		}

		return back()->withErrors();
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$policy = Policy::find($id);

			if (is_null($policy)) {
				$request->session()->flash('error', '该政策文件不存在');

				return back();
			} elseif (
				$policy->delete()) {
				$request->session()->flash('success', '政策文件' . $policy->id . '删除成功');
			} else {
				$request->session()->flash('error', '政策文件' . $policy->id . '删除失败');
			}

			return redirect()->route('policy.list');
		}

		return back()->withErrors();
	}
}