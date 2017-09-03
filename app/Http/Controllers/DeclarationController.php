<?php

namespace App\Http\Controllers;

use App\Declaration;
use App\Project;
use App\Rate;
use App\Section;
use App\Type;
use Auth;
use Illuminate\Http\Request;

class DeclarationController extends Controller {

	private $upload = 'files';

	public function getList() {
		return view('tax.list');
	}

	public function getCreate() {
		$projects = Project::select('id', 'name')->get();
		$types    = Type::select('id', 'name')->get();
		$sections = Section::select('id', 'name', 'project_id', 'type_id')->get();
		$rates    = Rate::select('name')->distinct()->get();

		return view('declaration.create', compact('projects', 'types', 'sections', 'rates'));
	}

	public function postSave(Request $request) {
		$this->validate($request, [
			'section_id' => 'required',
			'tax_name'   => 'required',
			'total'      => 'required|numeric',
			'issue_time' => 'required|date',
			'number'     => 'required',
			'file'       => 'required|image',
		]);

		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$declaration = new Declaration();
			$declaration->fill($inputs);

			$declaration->user_id = Auth::user()->id;
			$declaration->year    = date('Y');

			if ($request->hasFile('file') && $request->file('file')->isValid()) {
				$file                  = $request->file('file');
				$filename              = time() . '.' . $file->getClientOriginalExtension();
				$declaration->name     = $file->getClientOriginalName();
				$declaration->ext      = $file->getClientOriginalExtension();
				$declaration->pathname = $this->upload . '/' . $filename;
				$file->storeAs('public/' . $this->upload, $filename);
			}

			if ($declaration->save()) {
				$request->session()->flash('success', '自行申报税新增成功');
			} else {
				$request->session()->flash('error', '自行申报税新增失败');
			}

			return redirect()->route('tax.list');
		}

		return back()->withErrors();
	}

	public function getEdit($id) {
		$declaration = Declaration::find($id);
		$projects    = Project::select('id', 'name')->get();
		$types       = Type::select('id', 'name')->get();
		$sections    = Section::select('id', 'name', 'project_id', 'type_id')->get();
		$rates       = Rate::select('name')->distinct()->get();

		return view('declaration.edit', compact('declaration', 'projects', 'types', 'sections', 'rates'));
	}

	public function putUpdate(Request $request, $id) {
		$this->validate($request, [
			'section_id' => 'required',
			'tax_name'   => 'required',
			'total'      => 'required|numeric',
			'issue_time' => 'required|date',
			'number'     => 'required',
			'file'       => 'image',
		]);

		$inputs = $request->all();

		if ($request->isMethod('put')) {
			$declaration = Declaration::find($id);
			$declaration->fill($inputs);

			if ($request->hasFile('file') && $request->file('file')->isValid()) {
				$file                  = $request->file('file');
				$filename              = time() . '.' . $file->getClientOriginalExtension();
				$declaration->name     = $file->getClientOriginalName();
				$declaration->ext      = $file->getClientOriginalExtension();
				$declaration->pathname = $this->upload . '/' . $filename;
				$file->storeAs('public/' . $this->upload, $filename);
			}

			if ($declaration->save()) {
				$request->session()->flash('success', '自行申报税更新成功');
			} else {
				$request->session()->flash('error', '自行申报税更新失败');
			}

			return redirect()->route('tax.list');
		}

		return back()->withErrors();
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$declaration = Declaration::find($id);

			if (is_null($declaration)) {
				$request->session()->flash('error', '该自行申报税不存在');

				return back();
			} elseif ($declaration->delete()) {
				$request->session()->flash('success', '自行申报税' . $declaration->id . '删除成功');
			} else {
				$request->session()->flash('error', '自行申报税' . $declaration->id . '删除失败');
			}

			return redirect()->route('tax.list');
		}

		return back()->withErrors();
	}
}
