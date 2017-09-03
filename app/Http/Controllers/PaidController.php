<?php

namespace App\Http\Controllers;

use App\Paid;
use App\Project;
use App\Rate;
use App\Section;
use App\Type;
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
		$projects = Project::select('id', 'name')->get();
		$types    = Type::select('id', 'name')->get();
		$sections = Section::select('id', 'name', 'project_id', 'type_id')->get();
		$rates    = Rate::select('name')->distinct()->get();

		return view('paid.create', compact('projects', 'types', 'sections', 'rates'));
	}

	public function postSave(Request $request) {
		$this->validate($request, [
			'section_id' => 'required',
			'amount'     => 'required|numeric',
			'total'      => 'required|numeric',
			'issue_time' => 'required|date',
			'authority'  => 'required',
			'sale'       => 'required',
			'file'       => 'required|image',
		]);

		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$paid = new Paid();
			$paid->fill($inputs);

			$paid->user_id = Auth::user()->id;
			$paid->year    = date('Y');

			if ($request->hasFile('file') && $request->file('file')->isValid()) {
				$file           = $request->file('file');
				$filename       = time() . '.' . $file->getClientOriginalExtension();
				$paid->name     = $file->getClientOriginalName();
				$paid->ext      = $file->getClientOriginalExtension();
				$paid->pathname = $this->upload . '/' . $filename;
				$file->storeAs('public/' . $this->upload, $filename);
			}

			if ($paid->save()) {
				$request->session()->flash('success', '资源税管理证明新增成功');
			} else {
				$request->session()->flash('error', '资源税管理证明新增失败');
			}

			return redirect()->route('tax.list');
		}

		return back()->withErrors();
	}

	public function getEdit($id) {
		$paid     = Paid::find($id);
		$projects = Project::select('id', 'name')->get();
		$types    = Type::select('id', 'name')->get();
		$sections = Section::select('id', 'name', 'project_id', 'type_id')->get();
		$rates    = Rate::select('name')->distinct()->get();

		return view('paid.edit', compact('paid', 'projects', 'types', 'sections', 'rates'));
	}

	public function putUpdate(Request $request, $id) {
		$this->validate($request, [
			'section_id' => 'required',
			'amount'     => 'required|numeric',
			'total'      => 'required|numeric',
			'issue_time' => 'required|date',
			'authority'  => 'required',
			'sale'       => 'required',
			'file'       => 'image',
		]);

		$inputs = $request->all();

		if ($request->isMethod('put')) {
			$paid = Paid::find($id);
			$paid->fill($inputs);

			if ($request->hasFile('file') && $request->file('file')->isValid()) {
				$file           = $request->file('file');
				$filename       = time() . '.' . $file->getClientOriginalExtension();
				$paid->name     = $file->getClientOriginalName();
				$paid->ext      = $file->getClientOriginalExtension();
				$paid->pathname = $this->upload . '/' . $filename;
				$file->storeAs('public/' . $this->upload, $filename);
			}

			if ($paid->save()) {
				$request->session()->flash('success', '资源税管理证明更新成功');
			} else {
				$request->session()->flash('error', '资源税管理证明更新失败');
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
				$request->session()->flash('error', '该资源税管理证明不存在');

				return back();
			} elseif ($paid->delete()) {
				$request->session()->flash('success', '资源税管理证明' . $paid->id . '删除成功');
			} else {
				$request->session()->flash('error', '资源税管理证明' . $paid->id . '删除失败');
			}

			return redirect()->route('tax.list');
		}

		return back()->withErrors();
	}
}
