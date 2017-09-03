<?php

namespace App\Http\Controllers;

use App\Completion;
use App\Declaration;
use App\Paid;
use App\Project;
use App\Rate;
use App\Section;
use App\Tax;
use App\Type;
use Auth;
use Excel;
use Illuminate\Http\Request;

class TaxController extends Controller {

	private $upload = 'files';

	public function getList() {
		if (Auth::user()->is_admin) {
			$taxes        = Tax::with('section', 'section.project', 'section.type')->get();
			$paids        = Paid::with('section', 'section.project', 'section.type')->get();
			$declarations = Declaration::with('section', 'section.project', 'section.type')->get();
		} else {
			$taxes        = Tax::whereUserId(Auth::user()->id)->get();
			$paids        = Paid::with('project')->whereUserId(Auth::user()->id)->get();
			$declarations = Declaration::with('project')->whereUserId(Auth::user()->id)->get();
		}

		return view('tax.list', compact('taxes', 'paids', 'declarations'));
	}

	public function getCreate() {
		$projects = Project::select('id', 'name')->get();
		$types    = Type::select('id', 'name')->get();
		$sections = Section::select('id', 'name', 'project_id', 'type_id')->get();
		$rates    = Rate::select('name')->distinct()->get();
		$units    = Rate::select('unit')->distinct()->get();

		return view('tax.create', compact('projects', 'types', 'sections', 'rates', 'units'));
	}

	public function postSave(Request $request) {
		$this->validate($request, [
			'section_id'         => 'required',
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

			$tax->user_id = Auth::user()->id;
			$tax->year    = date('Y');

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
		$projects = Project::select('id', 'name')->get();
		$types    = Type::select('id', 'name')->get();
		$sections = Section::select('id', 'name', 'project_id', 'type_id')->get();
		$rates    = Rate::select('name')->distinct()->get();
		$units    = Rate::select('unit')->distinct()->get();

		return view('tax.edit', compact('tax', 'projects', 'types', 'sections', 'rates', 'units'));
	}

	public function putUpdate(Request $request, $id) {
		$this->validate($request, [
			'section_id'         => 'required',
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
		$projects = Project::select('id', 'name')->get();
		$types    = Type::select('id', 'name')->get();
		$sections = Section::select('id', 'name')->distinct()->get();
		$rates    = Rate::select('name')->distinct()->get();

		$searched    = false;
		$results     = [];
		$payable     = 0;
		$paid        = 0;
		$declaration = 0;
		$condition   = '';

		if ($request->isMethod('get')) {
			$searched = $request->input('flag');

			// 查询数据
			$tax = Tax::with('section', 'section.project', 'section.type', 'completion');

			if ('全部' === $request->input('project')) {
				$pids = Project::all()->pluck('id');
			} else {
				$pids = Project::whereName($request->input('project'))->pluck('id');
			}
			$condition .= '项目名称包括<strong class="text-danger">' . $request->input('project') . '</strong>';

			if ('全部' === $request->input('type')) {
				$tids = Type::all()->pluck('id');
			} else {
				$tids = Type::whereName($request->input('type'))->pluck('id');
			}
			$condition .= ' 标段类型包括<strong class="text-danger">' . $request->input('type') . '</strong>';

			if ('全部' === $request->input('section')) {
				$sids = Section::whereIn('project_id', $pids)
					->whereIn('type_id', $tids)
					->pluck('id');
			} else {
				$sids = Section::whereIn('project_id', $pids)
					->whereIn('type_id', $tids)
					->whereName($request->input('section'))
					->pluck('id');
			}
			$condition .= ' 标段名称包括<strong class="text-danger">' . $request->input('section') . '</strong>';

			if ('全部' === $request->input('tax_name')) {
				$tax = $tax->whereIn('section_id', $sids);
			} else {
				$tax = $tax->whereIn('section_id', $sids)
					->whereTaxName($request->input('tax_name'));
			}
			$condition .= ' 税目包括<strong class="text-danger">' . $request->input('tax_name') . '</strong>';

			$results = $tax->get();

			$payable     = $results->sum('total');
			$paid        = Paid::whereIn('section_id', $sids)->sum('total');
			$declaration = Declaration::whereIn('section_id', $sids)->sum('total');
		}

		return view('tax.search', compact('searched', 'projects', 'types', 'sections', 'rates', 'results', 'payable', 'paid', 'declaration', 'condition'));
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

		// 获取完工进度
		$completion         = Completion::whereSectionId($tax->section_id)->first();
		$tax->completion_id = $completion->id;
		$completion_before  = $completion->before;
		$completion_after   = $completion->after;

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
		$tax->rate_id_before    = $before['id'];
		$tax->payabletax_before = $tax->taxamount_before * $before['rate'];

		// 改革后税额计算
		$tax->rate_id_after    = $after['id'];
		$tax->payabletax_after = $tax->taxamount_after * $after['rate'];

		// 应缴纳税额
		$tax->total = $tax->payabletax_before * $completion_before / 100 + $tax->payabletax_after * $completion_after / 100;
	}
}
