<?php

namespace App\Http\Controllers;

use App\Declaration;
use App\Paid;
use App\Project;
use App\Rate;
use App\Tax;
use Auth;
use Illuminate\Http\Request;
use JavaScript;

class TaxController extends Controller {

	public function getList() {
		$taxes        = Tax::all();
		$paids        = Paid::with('project')->get();
		$declarations = Declaration::with('project')->get();

		return view('tax.list', compact('taxes', 'paids', 'declarations'));
	}

	public function getCreate() {
		$projects = Project::all();
		$rates    = Rate::select('name')->distinct()->get();

		return view('tax.create', compact('projects', 'rates'));
	}

	public function postSave(Request $request) {
		$inputs = $request->all();

		if ($request->isMethod('post')) {
			$tax = new Tax();
			$tax->fill($inputs);
			$this->caculateTax($tax, $inputs);
			$tax->save();

			return redirect()->route('tax.list');
		}
	}

	public function getEdit($id) {
		$tax      = Tax::find($id);
		$projects = Project::all();
		$rates    = Rate::select('name')->distinct()->get();

		return view('tax.edit', compact('tax', 'projects', 'rates'));
	}

	public function putUpdate(Request $request, $id) {
		$inputs = $request->all();

		if ($request->isMethod('put')) {
			$tax = Tax::find($id);
			$tax->fill($inputs);
			$this->caculateTax($tax, $inputs);
			$tax->save();

			return redirect()->route('tax.list');
		}
	}

	public function deleteDelete(Request $request, $id) {
		if ($request->isMethod('delete')) {
			$tax = Tax::find($id);
			$tax->delete();

			return redirect()->route('tax.list');
		}
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
				$results = Tax::all();
			} else {
				$results = Tax::where('project_name', 'like', '%' . $request->input('keywords') . '%')->get();
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

	private function caculateTax(&$tax, $inputs) {

		// 获取项目ID
		$project = Project::whereProjectName($inputs['project_name'])
			->whereLotName($inputs['lot_name'])
			->whereLotType($inputs['lot_type'])
			->first();

		$tax->project_id = $project->id;

		// 获取税率
		$rates  = Rate::whereName($inputs['tax_name'])->get();
		$rates  = $rates->keyBy('flag')->all();
		$before = $rates['前'];
		$after  = $rates['后'];

		if (str_contains($inputs['tax_name'], '建筑用砂')) {

			// 改革前数量
			$tax->taxamount_before = $inputs['total_amount'] * 1.5;

			// 改革后数量
			$tax->taxamount_after = $inputs['total_amount'];
		} elseif (str_contains($inputs['tax_name'], '其他粘土')) {

			// 改革前数量
			$tax->taxamount_before = $inputs['total_amount'] * 1.8;

			// 改革后数量
			$tax->taxamount_after = $inputs['total_amount'];
		} elseif (str_contains($inputs['tax_name'], '石灰石')) {

			// 改革前数量
			$tax->taxamount_before = $inputs['total_amount'] * 1.5;

			// 改革后数量
			$tax->taxamount_after = $inputs['total_amount'] * $inputs['unit_price'];
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
