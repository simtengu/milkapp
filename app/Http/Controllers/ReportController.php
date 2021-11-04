<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Income;
use App\Models\Yogurt;
use App\Models\Expense;
use App\Models\FreshBottle;
use App\Models\FreshVolume;
use App\Models\LitreIncome;
use App\Models\MgandoBottle;
use App\Models\MgandoVolume;
use App\Models\YogurtIncome;
use Illuminate\Http\Request;

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




    //production methods......................................................

    //today...................................................................
    public function production(){
        //bottles...............................................................
        $mgando_bottles = MgandoBottle::all();
        foreach ($mgando_bottles as $bottle) {
             $info =  Income::where('milk_type','mgando')->where('bottle_capacity',$bottle->capacity)->whereDate('created_at', '=', Carbon::today())->get();
            $bottle->count = $info->sum('quantity');
            $bottle->amount = $info->sum('amount');
        }

        $fresh_bottles = FreshBottle::all();
        foreach ($fresh_bottles as $bottle) {
             $info =  Income::where('milk_type','fresh')->where('bottle_capacity',$bottle->capacity)->whereDate('created_at', '=', Carbon::today())->get();
            $bottle->count = $info->sum('quantity');
            $bottle->amount = $info->sum('amount');
        }

        $yogurt_bottles = Yogurt::all();
        foreach ($yogurt_bottles as $bottle) {
            $info =  YogurtIncome::where('capacity', $bottle->capacity)->whereDate('created_at', '=', Carbon::today())->get();
            $bottle->count = $info->sum('quantity');
            $bottle->amount = $info->sum('amount');
        }

        //volumes.......................................................................
      $mgando_volumes = MgandoVolume::all();
        foreach ($mgando_volumes as $volume) {
             $info =  LitreIncome::where('milk_type','mgando')->where('volume',$volume->volume)->whereDate('created_at', '=', Carbon::today())->get();
            $volume->count = $info->sum('quantity');
            $volume->amount = $info->sum('amount');
        }

      $fresh_volumes = FreshVolume::all();
        foreach ($fresh_volumes as $volume) {
             $info =  LitreIncome::where('milk_type','fresh')->where('volume',$volume->volume)->whereDate('created_at', '=', Carbon::today())->get();
            $volume->count = $info->sum('quantity');
            $volume->amount = $info->sum('amount');
        }

         $today_filter = "Taarifa za leo";
         return view('admin.production.index',compact(['today_filter','mgando_volumes','fresh_volumes','mgando_bottles','fresh_bottles','yogurt_bottles']));
    }


    //all data...............................................................
    public function production_all_data(){
        //bottles...............................................................
        $mgando_bottles = MgandoBottle::all();
        foreach ($mgando_bottles as $bottle) {
             $info =  Income::where('milk_type','mgando')->where('bottle_capacity',$bottle->capacity)->get();
            $bottle->count = $info->sum('quantity');
            $bottle->amount = $info->sum('amount');
        }

        $fresh_bottles = FreshBottle::all();
        foreach ($fresh_bottles as $bottle) {
             $info =  Income::where('milk_type','fresh')->where('bottle_capacity',$bottle->capacity)->get();
            $bottle->count = $info->sum('quantity');
            $bottle->amount = $info->sum('amount');
        }

        $yogurt_bottles = Yogurt::all();
        foreach ($yogurt_bottles as $bottle) {
            $info =  YogurtIncome::where('capacity', $bottle->capacity)->get();
            $bottle->count = $info->sum('quantity');
            $bottle->amount = $info->sum('amount');
        }

        //volumes.......................................................................
      $mgando_volumes = MgandoVolume::all();
        foreach ($mgando_volumes as $volume) {
             $info =  LitreIncome::where('milk_type','mgando')->where('volume',$volume->volume)->get();
            $volume->count = $info->sum('quantity');
            $volume->amount = $info->sum('amount');
        }

      $fresh_volumes = FreshVolume::all();
        foreach ($fresh_volumes as $volume) {
             $info =  LitreIncome::where('milk_type','fresh')->where('volume',$volume->volume)->get();
            $volume->count = $info->sum('quantity');
            $volume->amount = $info->sum('amount');
        }

         $all_filter = "Taarifa zote";
         return view('admin.production.index',compact(['all_filter','mgando_volumes','fresh_volumes','mgando_bottles','fresh_bottles','yogurt_bottles']));
    }


//for specific date...................................................................................... 
    public function production_date(Request $request){
        $date = new Carbon($request->date);
        //bottles...............................................................
        $mgando_bottles = MgandoBottle::all();
        foreach ($mgando_bottles as $bottle) {
             $info =  Income::where('milk_type','mgando')->where('bottle_capacity',$bottle->capacity)->whereDate('created_at', '=', $date)->get();
            $bottle->count = $info->sum('quantity');
            $bottle->amount = $info->sum('amount');
        }

        $fresh_bottles = FreshBottle::all();
        foreach ($fresh_bottles as $bottle) {
             $info =  Income::where('milk_type','fresh')->where('bottle_capacity',$bottle->capacity)->whereDate('created_at', '=', $date)->get();
            $bottle->count = $info->sum('quantity');
            $bottle->amount = $info->sum('amount');
        }

        $yogurt_bottles = Yogurt::all();
        foreach ($yogurt_bottles as $bottle) {
            $info =  YogurtIncome::where('capacity', $bottle->capacity)->whereDate('created_at', '=', $date)->get();
            $bottle->count = $info->sum('quantity');
            $bottle->amount = $info->sum('amount');
        }

        //volumes.......................................................................
      $mgando_volumes = MgandoVolume::all();
        foreach ($mgando_volumes as $volume) {
             $info =  LitreIncome::where('milk_type','mgando')->where('volume',$volume->volume)->whereDate('created_at', '=', $date)->get();
            $volume->count = $info->sum('quantity');
            $volume->amount = $info->sum('amount');
        }

      $fresh_volumes = FreshVolume::all();
        foreach ($fresh_volumes as $volume) {
             $info =  LitreIncome::where('milk_type','fresh')->where('volume',$volume->volume)->whereDate('created_at', '=', $date)->get();
            $volume->count = $info->sum('quantity');
            $volume->amount = $info->sum('amount');
        }

         $date_filter = "Tarehe " . $date->toDateString();
         return view('admin.production.index',compact(['date_filter','mgando_volumes','fresh_volumes','mgando_bottles','fresh_bottles','yogurt_bottles']));
    }



//for  date range...................................................................................... 
    public function production_date_range(Request $request){
        $from_date = new Carbon($request->from_date);
        $to_date = new Carbon($request->to_date);
        //bottles...............................................................
        $mgando_bottles = MgandoBottle::all();
        foreach ($mgando_bottles as $bottle) {
             $info =  Income::where('milk_type','mgando')->where('bottle_capacity',$bottle->capacity)->whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date)->get();
            $bottle->count = $info->sum('quantity');
            $bottle->amount = $info->sum('amount');
        }

        $fresh_bottles = FreshBottle::all();
        foreach ($fresh_bottles as $bottle) {
             $info =  Income::where('milk_type','fresh')->where('bottle_capacity',$bottle->capacity)->whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date)->get();
            $bottle->count = $info->sum('quantity');
            $bottle->amount = $info->sum('amount');
        }

        $yogurt_bottles = Yogurt::all();
        foreach ($yogurt_bottles as $bottle) {
            $info =  YogurtIncome::where('capacity', $bottle->capacity)->whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date)->get();
            $bottle->count = $info->sum('quantity');
            $bottle->amount = $info->sum('amount');
        }

        //volumes.......................................................................
      $mgando_volumes = MgandoVolume::all();
        foreach ($mgando_volumes as $volume) {
             $info =  LitreIncome::where('milk_type','mgando')->where('volume',$volume->volume)->whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date)->get();
            $volume->count = $info->sum('quantity');
            $volume->amount = $info->sum('amount');
        }

      $fresh_volumes = FreshVolume::all();
        foreach ($fresh_volumes as $volume) {
             $info =  LitreIncome::where('milk_type','fresh')->where('volume',$volume->volume)->whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date)->get();
            $volume->count = $info->sum('quantity');
            $volume->amount = $info->sum('amount');
        }

  $date_range_filter = "Kuanzia " . $from_date->toDateString() . " mpaka " . $to_date->toDateString();
         return view('admin.production.index',compact(['date_range_filter','mgando_volumes','fresh_volumes','mgando_bottles','fresh_bottles','yogurt_bottles']));
    }

//the end of production methods....................................................................

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
