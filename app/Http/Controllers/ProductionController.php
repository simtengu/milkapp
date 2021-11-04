<?php

namespace App\Http\Controllers;

use App\Models\LitreProduction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ReceivedLitre;

class ProductionController extends Controller
{
  
  public function stock(){
    return view('admin.production.stock');
  }

  public function index(){
    $today_litres = ReceivedLitre::whereDate('created_at', '=', Carbon::today())->latest()->get();
    $produced_litres = LitreProduction::whereDate('created_at', '=', Carbon::today())->latest()->get();
    $total_litres = $today_litres->sum('lita');
    $total_litres_produced = $produced_litres->sum('litre');
   return view('admin.production.production',compact('today_litres','total_litres','produced_litres','total_litres_produced'));
  } 

    public function receive_milk(Request $request){

      $this->validate($request,[
        'lita' => 'required'
      ]);
   $litre = ReceivedLitre::whereDate('created_at', '=', Carbon::today())->first();
   if ($litre) {
     $litre->lita = $litre->lita + $request->lita;
     $litre->save(); 
   }else{

     ReceivedLitre::create($request->all());
   }
       session()->flash('milk_received', 'Umepokea kikamilifu..');

        return redirect()->back();

    }


       public function update_received_milk(Request $request, $id)
    {
        $this->validate($request, [
            'lita' => 'required'
        ]);

        $data = ReceivedLitre::findOrFail($id);
        $data->lita = $request->lita;
       
        $data->save();
        session()->flash('received_litre_updated', 'taarifa zimebadirishwa kikamilifu');
        return redirect()->back();
    }

    public function produce_bottle(Request $request){

       return redirect()->back();
    }

  public function produce_litre(Request $request)
  {
    $this->validate($request,[
      'milk_type'=>'required',
      'litre'=>'required'
    ]);

   $litre = LitreProduction::whereDate('created_at', '=', Carbon::today())->where('milk_type',$request->milk_type)->first();
   if ($litre) {
     $litre->litre = $litre->litre + $request->litre;
     $litre->save(); 
   }else{
     LitreProduction::create($request->all());
   }
    session()->flash('litres_produced', 'taarifa zimehifadhika kikamilifu');

    return redirect()->back();
  }

  public function update_litre_produced(Request $request, $id)
  {
    $this->validate($request, [
      'milk_type' => 'required',
      'litre' => 'required'
    ]);

    $data = LitreProduction::findOrFail($id);
    $data->milk_type = $request->milk_type;
    $data->litre = $request->litre;

    $data->save();
    session()->flash('litres_updated', 'taarifa zimebadirishwa kikamilifu');
    return redirect()->back();
  }
}
