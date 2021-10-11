<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Income;
use App\Models\Expense;
use App\Models\LitreIncome;
use App\Models\YogurtIncome;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
    }
    public function index()
    {

        $bottle_incomes = Income::whereDate('created_at', '=', Carbon::today())->latest()->simplePaginate(60);
        $litre_incomes = LitreIncome::whereDate('created_at', '=', Carbon::today())->latest()->simplePaginate(60);
        $yogurt_incomes = YogurtIncome::whereDate('created_at', '=', Carbon::today())->latest()->simplePaginate(60);
        $total_yogurt_income = $yogurt_incomes->sum('amount');
        $total_bottle_income = $bottle_incomes->sum('amount');
        $total_litre_income = $litre_incomes->sum('amount');
        $total_income = $total_bottle_income + $total_litre_income + $total_yogurt_income;
        $expenses = Expense::whereDate('created_at', '=', Carbon::today())->latest()->simplePaginate(60);
        $total_expense = $expenses->sum('amount');
        $today_filter = "Taarifa za leo";
        return view('admin.reports.income', compact('today_filter', 'yogurt_incomes', 'litre_incomes', 'bottle_incomes', 'expenses', 'total_income', 'total_bottle_income', 'total_expense', 'total_litre_income', 'total_yogurt_income'));
    }

    public function all_data()
    {
        $bottle_incomes = Income::latest()->simplePaginate(60);
        $litre_incomes = LitreIncome::latest()->simplePaginate(60);
        $yogurt_incomes = YogurtIncome::latest()->simplePaginate(60);
        $total_yogurt_income = $yogurt_incomes->sum('amount');
        $total_bottle_income = $bottle_incomes->sum('amount');
        $total_litre_income = $litre_incomes->sum('amount');
        $total_income = $total_bottle_income + $total_litre_income + $total_yogurt_income;
        $expenses = Expense::latest()->simplePaginate(60);
        $total_expense = $expenses->sum('amount');
        $all_filter = "Taarifa zote ";
        return view('admin.reports.income', compact('all_filter', 'yogurt_incomes', 'litre_incomes', 'bottle_incomes', 'expenses', 'total_income', 'total_bottle_income', 'total_expense', 'total_litre_income', 'total_yogurt_income'));
    }

    public function date_data(Request $request)
    {

        $date = new Carbon($request->date);
        $bottle_incomes = Income::whereDate('created_at', '=', $date)->latest()->simplePaginate(60);
        $litre_incomes = LitreIncome::whereDate('created_at', '=', $date)->latest()->simplePaginate(60);
        $yogurt_incomes = YogurtIncome::whereDate('created_at', '=', $date)->latest()->simplePaginate(60);
        $total_yogurt_income = $yogurt_incomes->sum('amount');
        $total_bottle_income = $bottle_incomes->sum('amount');
        $total_litre_income = $litre_incomes->sum('amount');
        $total_income = $total_bottle_income + $total_litre_income + $total_yogurt_income;
        $expenses = Expense::whereDate('created_at', '=', $date)->latest()->simplePaginate(60);
        $total_expense = $expenses->sum('amount');
        $date_filter = "Tarehe " . $date->toDateString();
        return view('admin.reports.income', compact('date_filter', 'yogurt_incomes', 'litre_incomes', 'bottle_incomes', 'expenses', 'total_income', 'total_bottle_income', 'total_expense', 'total_litre_income', 'total_yogurt_income'));
    }


    public function date_range_data(Request $request)
    {


        $from_date = new Carbon($request->from_date);
        $to_date = new Carbon($request->to_date);
        $bottle_incomes = Income::whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date)->latest()->simplePaginate(60);
        $litre_incomes = LitreIncome::whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date)->latest()->simplePaginate(60);
        $yogurt_incomes = YogurtIncome::whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date)->latest()->simplePaginate(60);
        $total_yogurt_income = $yogurt_incomes->sum('amount');
        $total_bottle_income = $bottle_incomes->sum('amount');
        $total_litre_income = $litre_incomes->sum('amount');
        $total_income = $total_bottle_income + $total_litre_income + $total_yogurt_income;
        $expenses = Expense::whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date)->latest()->simplePaginate(60);
        $total_expense = $expenses->sum('amount');
        $date_range_filter = "Kuanzia " . $from_date->toDateString() . " mpaka " . $to_date->toDateString();
        return view('admin.reports.income', compact('date_range_filter', 'yogurt_incomes', 'litre_incomes', 'bottle_incomes', 'expenses', 'total_income', 'total_bottle_income', 'total_expense', 'total_litre_income', 'total_yogurt_income'));
    }




    //print data according to given category............................................................ 
    public function print_reports()
    {

        $bottle_incomes = Income::whereDate('created_at', '=', Carbon::today())->latest()->simplePaginate(60);
        $litre_incomes = LitreIncome::whereDate('created_at', '=', Carbon::today())->latest()->simplePaginate(60);
        $yogurt_incomes = YogurtIncome::whereDate('created_at', '=', Carbon::today())->latest()->simplePaginate(60);
        $total_yogurt_income = $yogurt_incomes->sum('amount');
        $total_bottle_income = $bottle_incomes->sum('amount');
        $total_litre_income = $litre_incomes->sum('amount');
        $total_income = $total_bottle_income + $total_litre_income + $total_yogurt_income;
        $expenses = Expense::whereDate('created_at', '=', Carbon::today())->latest()->simplePaginate(60);
        $total_expense = $expenses->sum('amount');
        $today_filter = "Taarifa za leo";
        return view('admin.reports.generate_report', compact('today_filter', 'yogurt_incomes', 'litre_incomes', 'bottle_incomes', 'expenses', 'total_income', 'total_bottle_income', 'total_expense', 'total_litre_income', 'total_yogurt_income'));
    }

    public function print_index()
    {

        $bottle_incomes = Income::whereDate('created_at', '=', Carbon::today())->latest()->simplePaginate(60);
        $litre_incomes = LitreIncome::whereDate('created_at', '=', Carbon::today())->latest()->simplePaginate(60);
        $yogurt_incomes = YogurtIncome::whereDate('created_at', '=', Carbon::today())->latest()->simplePaginate(60);
        $total_yogurt_income = $yogurt_incomes->sum('amount');
        $total_bottle_income = $bottle_incomes->sum('amount');
        $total_litre_income = $litre_incomes->sum('amount');
        $total_income = $total_bottle_income + $total_litre_income + $total_yogurt_income;
        $expenses = Expense::whereDate('created_at', '=', Carbon::today())->latest()->simplePaginate(60);
        $total_expense = $expenses->sum('amount');
        $today_filter = "Tarehe:  ".Carbon::today()->toDateString();
        $pdf = PDF::loadView('admin.reports.print', compact('today_filter', 'yogurt_incomes', 'litre_incomes', 'bottle_incomes', 'expenses', 'total_income', 'total_bottle_income', 'total_expense', 'total_litre_income', 'total_yogurt_income'));
        return $pdf->download('report.pdf');
        //return view('admin.reports.print', compact('today_filter', 'yogurt_incomes', 'litre_incomes', 'bottle_incomes', 'expenses', 'total_income', 'total_bottle_income', 'total_expense', 'total_litre_income', 'total_yogurt_income'));
    }

    public function print_all_data()
    {
        $bottle_incomes = Income::latest()->simplePaginate(60);
        $litre_incomes = LitreIncome::latest()->simplePaginate(60);
        $yogurt_incomes = YogurtIncome::latest()->simplePaginate(60);
        $total_yogurt_income = $yogurt_incomes->sum('amount');
        $total_bottle_income = $bottle_incomes->sum('amount');
        $total_litre_income = $litre_incomes->sum('amount');
        $total_income = $total_bottle_income + $total_litre_income + $total_yogurt_income;
        $expenses = Expense::latest()->simplePaginate(60);
        $total_expense = $expenses->sum('amount');
        $all_filter = "Taarifa zote ";
        $pdf = PDF::loadView('admin.reports.print', compact('all_filter', 'yogurt_incomes', 'litre_incomes', 'bottle_incomes', 'expenses', 'total_income', 'total_bottle_income', 'total_expense', 'total_litre_income', 'total_yogurt_income'));
        return $pdf->download('report.pdf');
        //return view('admin.reports.print', compact('all_filter', 'yogurt_incomes', 'litre_incomes', 'bottle_incomes', 'expenses', 'total_income', 'total_bottle_income', 'total_expense', 'total_litre_income', 'total_yogurt_income'));
    }

    public function print_date_data(Request $request)
    {

        $date = new Carbon($request->date);
        $bottle_incomes = Income::whereDate('created_at', '=', $date)->latest()->simplePaginate(60);
        $litre_incomes = LitreIncome::whereDate('created_at', '=', $date)->latest()->simplePaginate(60);
        $yogurt_incomes = YogurtIncome::whereDate('created_at', '=', $date)->latest()->simplePaginate(60);
        $total_yogurt_income = $yogurt_incomes->sum('amount');
        $total_bottle_income = $bottle_incomes->sum('amount');
        $total_litre_income = $litre_incomes->sum('amount');
        $total_income = $total_bottle_income + $total_litre_income + $total_yogurt_income;
        $expenses = Expense::whereDate('created_at', '=', $date)->latest()->simplePaginate(60);
        $total_expense = $expenses->sum('amount');
        $date_filter = "Tarehe " . $date->toDateString();
        $pdf = PDF::loadView('admin.reports.print', compact('date_filter', 'yogurt_incomes', 'litre_incomes', 'bottle_incomes', 'expenses', 'total_income', 'total_bottle_income', 'total_expense', 'total_litre_income', 'total_yogurt_income'));
        return $pdf->download('report.pdf');
       // return view('admin.reports.print', compact('date_filter', 'yogurt_incomes', 'litre_incomes', 'bottle_incomes', 'expenses', 'total_income', 'total_bottle_income', 'total_expense', 'total_litre_income', 'total_yogurt_income'));
    }


    public function print_date_range_data(Request $request)
    {


        $from_date = new Carbon($request->from_date);
        $to_date = new Carbon($request->to_date);
        $bottle_incomes = Income::whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date)->latest()->simplePaginate(60);
        $litre_incomes = LitreIncome::whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date)->latest()->simplePaginate(60);
        $yogurt_incomes = YogurtIncome::whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date)->latest()->simplePaginate(60);
        $total_yogurt_income = $yogurt_incomes->sum('amount');
        $total_bottle_income = $bottle_incomes->sum('amount');
        $total_litre_income = $litre_incomes->sum('amount');
        $total_income = $total_bottle_income + $total_litre_income + $total_yogurt_income;
        $expenses = Expense::whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date)->latest()->simplePaginate(60);
        $total_expense = $expenses->sum('amount');
        $date_range_filter = "Tarehe " . $from_date->toDateString() . " mpaka " . $to_date->toDateString();
        $pdf = PDF::loadView('admin.reports.print', compact('date_range_filter', 'yogurt_incomes', 'litre_incomes', 'bottle_incomes', 'expenses', 'total_income', 'total_bottle_income', 'total_expense', 'total_litre_income', 'total_yogurt_income'));
        return $pdf->download('report.pdf');
        //return view('admin.reports.print', compact('date_range_filter', 'yogurt_incomes', 'litre_incomes', 'bottle_incomes', 'expenses', 'total_income', 'total_bottle_income', 'total_expense', 'total_litre_income', 'total_yogurt_income'));
    }
}
