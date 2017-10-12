<?php

namespace App\Http\Controllers;

use App\Completion;
use App\Project;
use App\Section;
use App\Type;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class CompletionController extends Controller {

	public function getList() {
		if (Auth::user()->is_admin) {
			$completions = Completion::with('section', 'section.project', 'section.type', 'user')->get();
		} else {
			$completions = Completion::with('section', 'section.project', 'section.type', 'user')
				->whereUserId(Auth::user()->id)
				->get();
		}

		return view('completion.list', compact('completions'));
	}

	public function getCreate() {
		$projects = Project::select('id', 'name')->get();
		$types    = Type::select('id', 'name')->get();
		$sections = Section::select('id', 'name', 'project_id', 'type_id')->get();

		return view('completion.create', compact('projects', 'types', 'sections'));
	}

	public function postSave(Request $request) {
		$this->validate($request, [
			'section_id' => 'required|unique:completions,section_id',
			'before'     => 'required|numeric|between:0,100',
			'after'      => 'required|numeric|between:0,100',
		]);

		$inputs = $request->all();
		if (100 != $inputs['before'] + $inputs['after']) {
			$request->session()->flash('error', '前后完工比例相加不等于100%，请检查数据');
			return back();
		}

		if ($request->isMethod('post')) {
			$completion = new Completion();
			$completion->fill($inputs);
			$completion->user_id = Auth::user()->id;

			if ($completion->save()) {
				$request->session()->flash('success', '完工比例新增成功');
			} else {
				$request->session()->flash('error', '完工比例新增失败');
			}

			return redirect()->route('completion.list');
		}

		return back()->withErrors();
	}

	public function getEdit($id) {
		$completion = Completion::find($id);
		$projects   = Project::select('id', 'name')->get();
		$types      = Type::select('id', 'name')->get();
		$sections   = Section::select('id', 'name', 'project_id', 'type_id')->get();

		return view('completion.edit', compact('completion', 'projects', 'types', 'sections'));
	}

	public function putUpdate(Request $request, $id) {
		$this->validate($request, [
			'section_id' => 'required',
			'before'     => 'required|numeric|between:0,100',
			'after'      => 'required|numeric|between:0,100',
		]);

		$inputs = $request->all();
		if (100 != $inputs['before'] + $inputs['after']) {
			$request->session()->flash('error', '前后完工比例相加不等于100%，请检查数据');
			return back();
		}

		if ($request->isMethod('put')) {
			$completion = Completion::find($id);
			$completion->fill($inputs);

			if ($completion->save()) {
				$request->session()->flash('success', '完工比例更新成功');
			} else {
				$request->session()->flash('error', '完工比例更新失败');
			}

			// 更新应纳资源税表
			DB::update('UPDATE taxes SET total = payabletax_before * ' . ($completion->before / 100) . ' + payabletax_after * ' . ($completion->after / 100) . ', updated_at = "' . Carbon::now() . '" WHERE completion_id = ' . $completion->id);

			return redirect()->route('completion.list');
		}

		return back()->withErrors();
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$completion = Completion::find($id);

			if (is_null($completion)) {
				$request->session()->flash('error', '该完工比例不存在');

				return back();
			} elseif ($completion->delete()) {
				$request->session()->flash('success', '完工比例' . $completion->id . '删除成功');
			} else {
				$request->session()->flash('error', '完工比例' . $completion->id . '删除失败');
			}

			return redirect()->route('completion.list');
		}

		return back()->withErrors();
	}
}
