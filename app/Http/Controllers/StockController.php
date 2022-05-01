<?php

namespace App\Http\Controllers;

use App\Models\BottleStock;
use Illuminate\Http\Request;
use App\Models\LitreStock;
use App\Models\MgandoBottle;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','isAdmin']);
    }
    public function index()
    {
        $bottles = BottleStock::orderBy('milk_type')->get();
        // $total_bottle_litres = BottleStock::where('milk_type', '!=', 'yogurt')->sum('litre');
        $total_bottle_quantity = BottleStock::where('milk_type', '!=', 'yogurt')->sum('bottle_quantity');
        $litres = LitreStock::all();
        $litres_in_stock = $litres->sum('litre');
        $mgando_bottles = MgandoBottle::all();
        return view('admin.production.stock',compact('mgando_bottles','litres_in_stock', 'litres', 'total_bottle_quantity', 'bottles'));
    }

    public function remove_litres($milk_type,$litres){
        $stock_litres = LitreStock::where('milk_type',$milk_type)->first();
        $stock_litres->litre = $stock_litres->litre - $litres;
        $stock_litres->save();
    }

    public function remove_bottles($milk_type,$bottle_capacity, $bottles)
    {
        $stock_bottles = BottleStock::where('milk_type', $milk_type)->where('bottle_capacity',$bottle_capacity)->first();
        $stock_bottles->bottle_quantity = $stock_bottles->bottle_quantity - $bottles;
        $stock_bottles->save();
    }

    public function add_litres($milk_type, $litres)
    {
        $stock_litres = LitreStock::where('milk_type', $milk_type)->first();
        $stock_litres->litre = $stock_litres->litre + $litres;
        $stock_litres->save();
    }

    public function add_bottles($milk_type, $bottle_capacity, $bottles)
    {
        $stock_bottles = BottleStock::where('milk_type', $milk_type)->where('bottle_capacity', $bottle_capacity)->first();
        $stock_bottles->bottle_quantity = $stock_bottles->bottle_quantity + $bottles;
        $stock_bottles->save();
    }

    public function remove_spoiled_bottles(Request $request){
        $this->validate($request,[
            'milk_type'=>'required',
            'bottle_capacity'=>'required',
            'bottle_quantity'=>'required'
        ]);

        $this->remove_bottles($request->milk_type,$request->bottle_capacity,$request->bottle_quantity);

        session()->flash('spoiled_bottle_removed', 'taarifa zimebadirishwa kikamilifu');
        return redirect()->back();
    }

    public function remove_spoiled_milk(Request $request)
    {
        $this->validate($request,[
            'milk_type'=>'required',
            'litre'=>'required'
        ]);
        $this->remove_litres($request->milk_type,$request->litre);
        session()->flash('spoiled_milk_removed', 'taarifa zimebadirishwa kikamilifu');
        return redirect()->back();
    }
}
