<?php

namespace App\Http\Controllers;

use App\Project;
use App\Section;
use App\Type;
use Illuminate\Http\Request;

class SectionController extends Controller {

	public function getList() {
		$sections = Section::with('project', 'type')->get();

		return view('section.list', compact('sections'));
	}

	public function getCreate() {
		$projects = Project::select('id', 'name')->get();
		$types    = Type::select('id', 'name')->get();

		return view('section.create', compact('projects', 'types'));
	}

	public function postSave(Request $request) {
		$this->validate($request, [
			'project_id'    => 'required',
			'type_id'       => 'required',
			'name'          => 'required',
			'building'      => 'required',
			'constructor'   => 'required',
			'investment'    => 'required|numeric',
			'kilometre'     => 'required|numeric',
			'address'       => 'required',
			'begtime'       => 'required|date',
			'endtime'       => 'required|date',
			'authority'     => 'required',
			'bureau'        => 'required',
			'finance'       => 'required',
			'finance_phone' => 'required',
			'bank'          => 'required',
			'bank_name'     => 'required',
			'bank_account'  => 'required',
		]);

		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$section = new Section();
			$section->fill($inputs);

			if ($section->save()) {
				$request->session()->flash('success', '标段新增成功');
			} else {
				$request->session()->flash('error', '标段新增失败');
			}

			return redirect()->route('section.list');
		}

		return back()->withErrors();
	}

	public function getEdit($id) {
		$section  = Section::find($id);
		$projects = Project::select('id', 'name')->get();
		$types    = Type::select('id', 'name')->get();

		return view('section.edit', compact('section', 'projects', 'types'));
	}

	public function putUpdate(Request $request, $id) {
		$this->validate($request, [
			'project_id'    => 'required',
			'type_id'       => 'required',
			'name'          => 'required',
			'building'      => 'required',
			'constructor'   => 'required',
			'investment'    => 'required|numeric',
			'kilometre'     => 'required|numeric',
			'address'       => 'required',
			'begtime'       => 'required|date',
			'endtime'       => 'required|date',
			'authority'     => 'required',
			'bureau'        => 'required',
			'finance'       => 'required',
			'finance_phone' => 'required',
			'bank'          => 'required',
			'bank_name'     => 'required',
			'bank_account'  => 'required',
		]);

		$inputs = $request->all();

		if ($request->isMethod('put')) {
			$section = Section::find($id);
			$section->fill($inputs);

			if ($section->save()) {
				$request->session()->flash('success', '标段更新成功');
			} else {
				$request->session()->flash('error', '标段更新失败');
			}

			return redirect()->route('section.list');
		}

		return back()->withErrors();
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$section = Section::find($id);

			if (is_null($section)) {
				$request->session()->flash('error', '该标段不存在');

				return back();
			} elseif ($section->delete()) {
				$request->session()->flash('success', '标段' . $section->id . '删除成功');
			} else {
				$request->session()->flash('error', '标段' . $section->id . '删除失败');
			}

			return redirect()->route('section.list');
		}

		return back()->withErrors();
	}
}
