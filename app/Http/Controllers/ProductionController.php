<?php

namespace App\Http\Controllers;

use App\Models\BottleProduction;
use App\Models\BottleStock;
use Carbon\Carbon;
use App\Models\Yogurt;
use App\Models\FreshBottle;
use App\Models\MgandoBottle;
use Illuminate\Http\Request;
use App\Models\ReceivedLitre;
use App\Models\LitreProduction;
use App\Models\LitreStock;

class ProductionController extends Controller
{

  public function index(){
    //received litres.......................................
    $today_litres = ReceivedLitre::whereDate('created_at', '=', Carbon::today())->latest()->get();
    $total_litres = $today_litres->sum('lita');
    //produced bottles.......................................
    $produced_bottles = BottleProduction::whereDate('created_at', '=', Carbon::today())->orderBy('milk_type')->get();
    $total_bottle_litres = BottleProduction::whereDate('created_at', '=', Carbon::today())->where('milk_type','!=','yogurt')->sum('litre');
    $total_bottle_quantity = BottleProduction::whereDate('created_at', '=', Carbon::today())->where('milk_type','!=','yogurt')->sum('bottle_quantity');
   //produced litres........................................
    $produced_litres = LitreProduction::whereDate('created_at', '=', Carbon::today())->latest()->get();
    $total_litres_produced = $produced_litres->sum('litre');

    $mgando_bottles = MgandoBottle::all();
    return view('admin.production.production', compact('total_bottle_quantity','total_bottle_litres','produced_bottles','mgando_bottles', 'today_litres', 'total_litres', 'produced_litres', 'total_litres_produced'));
  }

  public function production_report()
  {
    //received litres.......................................
    $today_litres = ReceivedLitre::whereDate('created_at', '=', Carbon::today())->latest()->get();
    $total_litres = $today_litres->sum('lita');
    //produced bottles.......................................
    $produced_bottles = BottleProduction::whereDate('created_at', '=', Carbon::today())->orderBy('milk_type')->get();
    $total_bottle_litres = BottleProduction::whereDate('created_at', '=', Carbon::today())->where('milk_type', '!=', 'yogurt')->sum('litre');
    $total_bottle_quantity = BottleProduction::whereDate('created_at', '=', Carbon::today())->where('milk_type', '!=', 'yogurt')->sum('bottle_quantity');
    //produced litres........................................
    $produced_litres = LitreProduction::whereDate('created_at', '=', Carbon::today())->latest()->get();
    $total_litres_produced = $produced_litres->sum('litre');

    $mgando_bottles = MgandoBottle::all();
    $filter = "Taarifa za leo";
    return view('admin.production.production_report', compact('filter','total_bottle_quantity', 'total_bottle_litres', 'produced_bottles', 'mgando_bottles', 'today_litres', 'total_litres', 'produced_litres', 'total_litres_produced'));
  }

  public function production_at_date( Request $request)
  {
    $this->validate($request,[
      'date'=>'required'
    ]);
    
    $date = $request->date;
    //received litres.......................................
    $today_litres = ReceivedLitre::whereDate('created_at', '=', $date)->latest()->get();
    $total_litres = $today_litres->sum('lita');
    //produced bottles.......................................
    $produced_bottles = BottleProduction::whereDate('created_at', '=', $date)->orderBy('milk_type')->get();
    $total_bottle_litres = BottleProduction::whereDate('created_at', '=', $date)->where('milk_type', '!=', 'yogurt')->sum('litre');
    $total_bottle_quantity = BottleProduction::whereDate('created_at', '=', $date)->where('milk_type', '!=', 'yogurt')->sum('bottle_quantity');
    //produced litres........................................
    $produced_litres = LitreProduction::whereDate('created_at', '=', $date)->latest()->get();
    $total_litres_produced = $produced_litres->sum('litre');
  
    $mgando_bottles = MgandoBottle::all();
    $filter = "Taarifa za tarehe ".$date;
    return view('admin.production.production_report', compact('filter','total_bottle_quantity', 'total_bottle_litres', 'produced_bottles', 'mgando_bottles', 'today_litres', 'total_litres', 'produced_litres', 'total_litres_produced'));
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
        $this->validate($request,[
            'milk_type' => 'required',
            'litre' => 'required',
            'bottle_capacity' => 'required',
            'bottle_quantity' => 'required'
        ]);
       $bottle = BottleProduction::whereDate('created_at', '=', Carbon::today())->where('milk_type',$request->milk_type)->where('bottle_capacity',$request->bottle_capacity)->first();
      if ($bottle) {
        $bottle->litre = $bottle->litre + $request->litre;
        $bottle->bottle_quantity =  $bottle->bottle_quantity + $request->bottle_quantity;
        $bottle->save();
      }else{
        BottleProduction::create($request->all()); 
      }

    //update stock due to new added data............................................
    $bottles_in_stock = BottleStock::where('milk_type', $request->milk_type)->where('bottle_capacity',$request->bottle_capacity)->first();
    if ($bottles_in_stock) {
      // $bottles_in_stock->litre = $bottles_in_stock->litre + $request->litre;
      $bottles_in_stock->bottle_quantity = $bottles_in_stock->bottle_quantity + $request->bottle_quantity;
      $bottles_in_stock->save();
    } else {
      BottleStock::create($request->except("litre"));
    }
       session()->flash('bottle_produced', 'taarifa zimehifadhiwa kikamilifu');
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
    //update stock due to new added data............................................
    $litre_in_stock = LitreStock::where('milk_type', $request->milk_type)->first();
    if ($litre_in_stock) {
      $litre_in_stock->litre = $litre_in_stock->litre + $request->litre;
      $litre_in_stock->save();
    } else {
      LitreStock::create($request->all());
    }

    return redirect()->back();
  }



  public function update_litre_produced(Request $request, $id)
  {
    $this->validate($request, [
      'litre' => 'required'
    ]);

    $data = LitreProduction::findOrFail($id);   
    //update stock due to above changes..................................... 
    $last_added_litres = $data->litre;
    $new_litres = $request->litre;
    $litre_stock = LitreStock::where('milk_type', $data->milk_type)->first();
   
if ($litre_stock) {
      
      //remove last added litres from the stock to create a room for new updated entry of litres..................
      $litre_stock->litre = $litre_stock->litre - $last_added_litres;
      $litre_stock->save();
      // update litre stock now...................
      $litre_stock->litre = $litre_stock->litre + $new_litres;
      $litre_stock->save();
}
    $data->litre = $request->litre;
    $data->save();
    session()->flash('litres_updated', 'taarifa zimebadirishwa kikamilifu');
    return redirect()->back();
  }

  public function edit_bottle_produced( BottleProduction $data)
  {
 
  
    if ($data->milk_type == 'maziwa mgando') {
      $bottles = MgandoBottle::all();
    }elseif ($data->milk_type == 'maziwa fresh') {
      $bottles = FreshBottle::all();
    }elseif ($data->milk_type == 'yogurt') {
      $bottles = Yogurt::all();
    }

    return view('admin.production.edit_bottle_production',compact('data','bottles'));
  }

  public function update_bottle_produced(Request $request, $id)
  {
    $this->validate($request, [
      'litre'=> 'required',
      'bottle_quantity'=> 'required'
    ]);


    $data = BottleProduction::findOrFail($id);
    //update stock due to above changes..................................... 
    // $last_added_bottle_litres = $data->litre;
    $last_added_bottle_quantity = $data->bottle_quantity;
    // $new_litres = $request->litre;
    $new_bottle_quantity = $request->bottle_quantity;
    $bottle_stock = BottleStock::where('milk_type', $data->milk_type)->where('bottle_capacity',$data->bottle_capacity)->first();

    if ($bottle_stock) {

      //remove last added bottle litres and quantity from the stock to create a room for new updated entry of bottle info..................
      // $bottle_stock->litre = $bottle_stock->litre - $last_added_bottle_litres;
      $bottle_stock->bottle_quantity = $bottle_stock->bottle_quantity - $last_added_bottle_quantity;
      $bottle_stock->save();
      // update bottle stock now...................
      // $bottle_stock->litre = $bottle_stock->litre + $new_litres;
      $bottle_stock->bottle_quantity = $bottle_stock->bottle_quantity + $new_bottle_quantity;
      $bottle_stock->save();
    }

//update produced bottles now................................
    $data->litre = $request->litre;
    $data->bottle_quantity = $request->bottle_quantity;
    $data->save();

    session()->flash('bottle_updated', 'taarifa zimebadirishwa kikamilifu');
    return redirect()->route('production');
  }

  //fetch bottles .....................................................................................

  public function fetch_bottles($milk_type)
  {                                                                                  

    if ($milk_type == "fresh") {
      $res = " <select class='form-control  bottle_capacity' name='bottle_capacity' id='bottle_types'>";
      $bottles = FreshBottle::all();
      if (count($bottles) > 0) {
          $res .= "<option value=''>chagua</option>";
        foreach ($bottles as $bottle) {
          $res .= "<option value='" . $bottle->capacity . "'>$bottle->capacity</option> ";
        }
        $res .= "</select>";
       
      } else {
        
        $res .= "<option value='' > hakuna taarifa</option></select>";
      }

      return response()->json(['data' => $res], 200);
    } elseif ($milk_type == "mgando") {

      $res = " <select class='form-control  bottle_capacity' name='bottle_capacity' id='bottle_types'>";
      $bottles = MgandoBottle::all();
      if (count($bottles) > 0) {
        $res .= "<option value=''>chagua</option>";
        foreach ($bottles as $bottle) {
          $res .= "<option value='" . $bottle->capacity . "'>$bottle->capacity</option> ";
        }
        $res .= "</select>";
      } else {

        $res .= "<option value='' > hakuna taarifa</option></select>";
      }

      return response()->json(['data' => $res], 200);
    
    } elseif($milk_type == "yogurt"){

      $res = " <select class='form-control  bottle_capacity' name='bottle_capacity' id='bottle_types'>";
      $bottles = Yogurt::all();
      if (count($bottles) > 0) {
        $res .= "<option value=''>chagua</option>";
        foreach ($bottles as $bottle) {
          $res .= "<option value='" . $bottle->capacity . "'>$bottle->capacity</option> ";
        }
        $res .= "</select>";
      } else {

        $res .= "<option value='' > hakuna taarifa</option></select>";
      }

      return response()->json(['data' => $res], 200);

    }
  }

}
