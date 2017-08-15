<?php

namespace App\Http\Controllers;

use App\Declaration;
use App\Paid;
use App\Project;
use App\Rate;
use App\Tax;
use Auth;
use Carbon\Carbon;
use Excel;
use Illuminate\Http\Request;
use JavaScript;

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
			'completion_before'  => 'required|numeric',
			'completion_after'   => 'required|numeric',
		]);

		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$tax = new Tax();
			$tax->fill($inputs);
			$this->caculateTax($tax, $inputs);

			$tax->year = Carbon::year();

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
			'completion_before'  => 'required|numeric',
			'completion_after'   => 'required|numeric',
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

		if ($request->isMethod('get')) {
			$searched = $request->input('flag');

			if (empty($request->input('keywords'))) {
				if (Auth::user()->is_admin) {
					$results = Tax::all();
				} else {
					$results = Tax::whereUserId(Auth::user()->id)->get();
				}
			} else {
				if (Auth::user()->is_admin) {
					$results = Tax::where('project_name', 'like', '%' . $request->input('keywords') . '%')->get();
				} else {
					$results = Tax::where('project_name', 'like', '%' . $request->input('keywords') . '%')
						->whereUserId(Auth::user()->id)
						->get();
				}
			}

			$payable     = $results->sum('total');
			$paid        = Paid::whereIn('project_id', $results->pluck('project_id')->all())->sum('total');
			$declaration = Declaration::whereIn('project_id', $results->pluck('project_id')->all())->sum('total');
		}

		$lot_names = $results->pluck('lot_name')->unique()->values();
		$tax_names = $results->pluck('tax_name')->unique()->values();
		$bardata   = [];
		$piedata   = [];

		// Bar chart
		foreach ($tax_names as $name) {
			$taxRecords = $results->where('tax_name', $name);

			$data = [];
			foreach ($results->pluck('lot_name')->unique() as $lotName) {
				$data[] = $taxRecords->where('lot_name', $lotName)->sum('total');
			}

			$bardata[] = [
				'label'           => $name,
				'data'            => $data,
				'backgroundColor' => '#' . dechex(rand(0x000000, 0xffffff)),
			];
		}

		// Pie chart
		foreach ($lot_names as $name) {
			$lotRecords = $results->where('lot_name', $name);

			$data     = [];
			$bgcolors = [];
			foreach ($lotRecords->groupBy('tax_name') as $tax) {
				$data[]     = $tax->sum('total');
				$bgcolors[] = '#' . dechex(rand(0x000000, 0xffffff));
			}

			$piedata[] = [
				'data'            => $data,
				'backgroundColor' => $bgcolors,
				'label'           => $name,
			];
		}

		JavaScript::put([
			'lot_names' => $lot_names,
			'tax_names' => $tax_names,
			'bardata'   => $bardata,
			'piedata'   => $piedata,
		]);

		return view('tax.search', compact('searched', 'results', 'payable', 'paid', 'declaration'));
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

				Excel::selectSheetsByIndex(0)->load(storage_path('app') . '/' . $path, function ($excel) {
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
							$existProject = Project::whereProjectName($result[0])
								->whereLotName($result[1])
								->whereLotType($result[2])
								->exists();

							if (!$existProject) {
								$project = new Project();

								$project->project_name = $result[0];
								$project->lot_name     = $result[1];
								$project->lot_type     = $result[2];
								$project->user_id      = Auth::user()->id;

								if ($project->save()) {
									$request->session()->flash('success', '标段新增成功');
								} else {
									$request->session()->flash('error', '标段新增失败');
								}

							}

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
						$tax->completion_before  = $result[9];
						$tax->completion_after   = $result[10];

						$this->caculateTax($tax);

						if ($tax->save()) {
							$request->session()->flash('success', '评估项目新增成功');
						} else {
							$request->session()->flash('error', '评估项目新增失败');
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
