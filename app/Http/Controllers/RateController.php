<?php

namespace App\Http\Controllers;

use App\Rate;
use Illuminate\Http\Request;

class RateController extends Controller {

	public function getList() {
		$rates = Rate::all();

		return view('rate.list', compact('rates'));
	}

	public function getCreate() {
		return view('rate.create');
	}

	public function postSave(Request $request) {
		$this->validate($request, [
			'category' => 'required',
			'flag'     => 'required',
			'name'     => 'required',
			'unit'     => 'required',
			'rate'     => 'required|numeric',
		]);

		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$rate = new Rate();
			$rate->fill($inputs);

			if ($rate->save()) {
				$request->session()->flash('success', '税率更新成功');
			} else {
				$request->session()->flash('error', '税率更新失败');
			}

			return redirect()->route('rate.list');
		}

		return back()->withErrors();
	}

	public function getEdit($id) {
		$rate = Rate::find($id);

		return view('rate.edit', compact('rate'));
	}

	public function putUpdate(Request $request, $id) {
		$this->validate($request, [
			'category' => 'required',
			'flag'     => 'required',
			'name'     => 'required',
			'unit'     => 'required',
			'rate'     => 'required|numeric',
		]);

		$inputs = $request->all();

		if ($request->isMethod('put')) {
			$rate = Rate::find($id);
			$rate->fill($inputs);

			if ($rate->save()) {
				$request->session()->flash('success', '税率更新成功');
			} else {
				$request->session()->flash('error', '税率更新失败');
			}

			return redirect()->route('rate.list');
		}

		return back()->withErrors();
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$rate = Rate::find($id);

			if (is_null($rate)) {
				$request->session()->flash('error', '该税率不存在');

				return back();
			} elseif (
				$rate->delete()) {
				$request->session()->flash('success', '税率' . $rate->id . '删除成功');
			} else {
				$request->session()->flash('error', '税率' . $rate->id . '删除失败');
			}

			return redirect()->route('rate.list');
		}

		return back()->withErrors();
	}
}
