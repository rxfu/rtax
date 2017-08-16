<?php

namespace App\Http\Controllers;

use App\Completion;
use App\Declaration;
use App\Paid;
use App\Project;
use App\Rate;
use App\Tax;
use Auth;
use DB;
use Excel;
use Illuminate\Http\Request;

class TaxController extends Controller {

	private $upload = 'files';

	public function getList() {
		if (Auth::user()->is_admin) {
			$taxes        = Tax::all();
			$paids        = Paid::with('project')->get();
			$declarations = Declaration::with('project')->get();
		} else {
			$taxes        = Tax::whereUserId(Auth::user()->id)->get();
			$paids        = Paid::with('project')->whereUserId(Auth::user()->id)->get();
			$declarations = Declaration::with('project')->whereUserId(Auth::user()->id)->get();
		}

		return view('tax.list', compact('taxes', 'paids', 'declarations'));
	}

	public function getCreate() {
		$projects = Project::all();
		$rates    = Rate::select('name')->distinct()->get();

		return view('tax.create', compact('projects', 'rates'));
	}

	public function postSave(Request $request) {
		$this->validate($request, [
			'project_name'       => 'required',
			'lot_name'           => 'required',
			'lot_type'           => 'required',
			'specification_name' => 'required',
			'tax_name'           => 'required',
			'unit'               => 'required',
			'unit_price'         => 'required|numeric',
			'total_amount'       => 'required|numeric',
			'flag'               => 'required',
		]);

		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$tax = new Tax();
			$tax->fill($inputs);
			$this->caculateTax($tax, $inputs);

			$tax->year = date('Y');

			if ($tax->save()) {
				$request->session()->flash('success', '评估项目新增成功');
			} else {
				$request->session()->flash('error', '评估项目新增失败');
			}

			return redirect()->route('tax.list');
		}

		return back()->withErrors();
	}

	public function getEdit($id) {
		$tax      = Tax::find($id);
		$projects = Project::all();
		$rates    = Rate::select('name')->distinct()->get();

		return view('tax.edit', compact('tax', 'projects', 'rates'));
	}

	public function putUpdate(Request $request, $id) {
		$this->validate($request, [
			'project_name'       => 'required',
			'lot_name'           => 'required',
			'lot_type'           => 'required',
			'specification_name' => 'required',
			'tax_name'           => 'required',
			'unit'               => 'required',
			'unit_price'         => 'required|numeric',
			'total_amount'       => 'required|numeric',
			'flag'               => 'required',
		]);

		$inputs = $request->all();

		if ($request->isMethod('put')) {
			$tax = Tax::find($id);
			$tax->fill($inputs);
			$this->caculateTax($tax);

			if ($tax->save()) {
				$request->session()->flash('success', '评估项目更新成功');
			} else {
				$request->session()->flash('error', '评估项目更新失败');
			}

			return redirect()->route('tax.list');
		}

		return back()->withErrors();
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$tax = Tax::find($id);

			if (is_null($tax)) {
				$request->session()->flash('error', '该评估项目不存在');

				return back();
			} elseif ($tax->delete()) {
				$request->session()->flash('success', '评估项目' . $tax->id . '删除成功');
			} else {
				$request->session()->flash('error', '评估项目' . $tax->id . '删除失败');
			}

			return redirect()->route('tax.list');
		}

		return back()->withErrors();
	}

	public function getSearch(Request $request) {
		$searched    = false;
		$results     = [];
		$payable     = 0;
		$paid        = 0;
		$declaration = 0;
		$condition   = '';

		if ($request->isMethod('get')) {
			$searched = $request->input('flag');

			// 查询数据
			if (Auth::user()->is_admin) {
				$tax = DB::table('taxes');
			} else {
				$tax = DB::table('taxes')->whereUserId(Auth::user()->id);
			}

			if (!empty($request->input('project_name'))) {
				$tax = $tax->where('project_name', 'like', '%' . $request->input('project_name') . '%');
				$condition .= '项目名称包括<strong class="text-danger">' . $request->input('project_name') . '</strong>';
			} else {
				$condition .= '<strong class="text-danger">全部</strong>项目名称';
			}

			if (!empty($request->input('lot_name'))) {
				$tax = $tax->where('lot_name', 'like', '%' . $request->input('lot_name') . '%');
				$condition .= ' AND 标段名称包括<strong class="text-danger">' . $request->input('lot_name') . '</strong>';
			} else {
				$condition .= ' AND <strong class="text-danger">全部</strong>标段名称';
			}

			if (!empty($request->input('lot_type'))) {
				$tax = $tax->where('lot_type', 'like', '%' . $request->input('lot_type') . '%');
				$condition .= ' AND 标段类型包括<strong class="text-danger">' . $request->input('lot_type') . '</strong>';
			} else {
				$condition .= ' AND <strong class="text-danger">全部</strong>标段类型';
			}

			if (!empty($request->input('specification_name'))) {
				$tax = $tax->where('specification_name', 'like', '%' . $request->input('specification_name') . '%');
				$condition .= ' AND 规格名称包括<strong class="text-danger">' . $request->input('specification_name') . '</strong>';
			} else {
				$condition .= ' AND <strong class="text-danger">全部</strong>规格名称';
			}

			if (!empty($request->input('tax_name'))) {
				$tax = $tax->where('tax_name', 'like', '%' . $request->input('tax_name') . '%');
				$condition .= ' AND 税目包括<strong class="text-danger">' . $request->input('tax_name') . '</strong>';
			} else {
				$condition .= ' AND <strong class="text-danger">全部</strong>税目';
			}

			if ('all' !== $request->input('flag')) {
				$tax = $tax->whereFlag($request->input('flag'));
				$condition .= ' AND 资源税改革标记包括<strong class="text-danger">' . $request->input('flag') . '</strong>';
			} else {
				$condition .= ' AND <strong class="text-danger">全部</strong>资源税改革标记';
			}

			if (!empty($request->input('completion_before'))) {
				$tax = $tax->where('completion_before', $request->input('completion_before_condition'), $request->input('completion_before'));
				$condition .= ' AND 改革前完工比例<strong class="text-danger">' . $request->input('completion_before_condition') . ' ' . $request->input('completion_before') . '</strong>';
			}

			if (!empty($request->input('completion_after'))) {
				$tax = $tax->where('completion_after', $request->input('completion_after_condition'), $request->input('completion_after'));
				$condition .= ' AND 改革后完工比例<strong class="text-danger">' . $request->input('completion_after_condition') . ' ' . $request->input('completion_after') . '</strong>';
			}

			$results = $tax->get();

			$payable     = $results->sum('total');
			$paid        = Paid::whereIn('project_id', $results->pluck('project_id')->all())->sum('total');
			$declaration = Declaration::whereIn('project_id', $results->pluck('project_id')->all())->sum('total');
		}

		return view('tax.search', compact('searched', 'results', 'payable', 'paid', 'declaration', 'condition'));
	}

	public function getImport() {
		return view('tax.import');
	}

	public function postImport(Request $request) {
		$this->validate($request, [
			'file' => 'required|file|mimes:xls,xlsx',
		]);

		if ($request->isMethod('post')) {

			if ($request->hasFile('file') && $request->file('file')->isValid()) {
				$file     = $request->file('file');
				$filename = time() . '.' . $file->getClientOriginalExtension();
				$path     = $file->storeAs($this->upload, $filename);

				Excel::selectSheetsByIndex(0)->load(storage_path('app') . '/' . $path, function ($excel) use ($request) {
					$excel->noHeading();

					$results = $excel->skip(1)->all();

					foreach ($results as $result) {
						$exist = Tax::whereProjectName($result[0])
							->whereLotName($result[1])
							->whereLotType($result[2])
							->whereSpecificationName($result[3])
							->whereTaxName($result[4])
							->exists();

						if ($exist) {
							$tax = Tax::whereProjectName($result[0])
								->whereLotName($result[1])
								->whereLotType($result[2])
								->whereSpecificationName($result[3])
								->whereTaxName($result[4])
								->first();
						} else {
							$tax = new Tax();
						}

						$tax->project_name       = $result[0];
						$tax->lot_name           = $result[1];
						$tax->lot_type           = $result[2];
						$tax->specification_name = $result[3];
						$tax->tax_name           = $result[4];
						$tax->unit               = $result[5];
						$tax->unit_price         = $result[6];
						$tax->total_amount       = $result[7];
						$tax->flag               = $result[8];
						$tax->year               = date('Y');

						$this->caculateTax($tax);

						if ($tax->save()) {
							$request->session()->flash('success', '评估项目导入成功');
						} else {
							$request->session()->flash('error', '评估项目导入失败');
						}

					}
				}, 'utf-8');
			}

			return redirect()->route('tax.excel');
		}

		return back()->withErrors();
	}

	private function caculateTax(&$tax) {

		// 获取项目ID
		$project = Project::whereProjectName($tax->project_name)
			->whereLotName($tax->lot_name)
			->whereLotType($tax->lot_type)
			->first();

		if (is_null($project)) {
			$request->session()->flash('error', '该标段不存在');

			return back();
		}

		$tax->project_id = $project->id;

		// 获取完工进度
		$completion             = Completion::whereProjectId($tax->project_id)->first();
		$tax->completion_before = $completion->completion_before;
		$tax->completion_after  = $completion->completion_after;

		// 获取税率
		$rates  = Rate::whereName($tax->tax_name)->get();
		$rates  = $rates->keyBy('flag')->all();
		$before = $rates['前'];
		$after  = $rates['后'];

		if (str_contains($tax->tax_name, '建筑用砂')) {

			// 改革前数量
			$tax->taxamount_before = $tax->total_amount * 1.5;

			// 改革后数量
			$tax->taxamount_after = $tax->total_amount;
		} elseif (str_contains($tax->tax_name, '其他粘土')) {

			// 改革前数量
			$tax->taxamount_before = $tax->total_amount * 1.8;

			// 改革后数量
			$tax->taxamount_after = $tax->total_amount;
		} elseif (str_contains($tax->tax_name, '石灰石')) {

			// 改革前数量
			$tax->taxamount_before = $tax->total_amount * 1.5;

			// 改革后数量
			$tax->taxamount_after = $tax->total_amount * $tax->unit_price;
		}

		// 改革前税额计算
		$tax->taxunit_before    = $before['unit'];
		$tax->unittax_before    = $before['rate'];
		$tax->payabletax_before = $tax->taxamount_before * $tax->unittax_before;

		// 改革后税额计算
		$tax->taxunit_after    = $after['unit'];
		$tax->unittax_after    = $after['rate'];
		$tax->payabletax_after = $tax->taxamount_after * $tax->unittax_after;

		// 应缴纳税额
		$tax->total = $tax->payabletax_before * $tax->completion_before / 100 + $tax->payabletax_after * $tax->completion_after / 100;

		$tax->user_id = Auth::user()->id;
	}
}
