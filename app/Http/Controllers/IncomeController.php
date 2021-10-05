<?php

namespace App\Http\Controllers;

use App\Models\FreshBottle;
use App\Models\FreshVolume;
use App\Models\Income;
use App\Models\LitreIncome;
use App\Models\MgandoBottle;
use App\Models\MgandoVolume;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */

     public function __construct()
     {
         $this->middleware('auth');
     }
    public function index()
    {
        $mgando_bottles = MgandoBottle::all();
        $mgando_volumes = MgandoVolume::all();
     return view('sells.index',compact('mgando_bottles','mgando_volumes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

                    //    <select style="width:110px" class="d-block p-1" name="bottle_capacity" id="bottleCapacity">
                    //        @forelse ($mgando_bottles as $bottle)
                    //        <option value={{ $bottle->price }}>{{ $bottle->capacity }}</option>        
                    //        @empty
                    //         <option value="">hakuna taarifa</option>   
                    //        @endforelse
                    //    </select>
//fetch bottles availabe for bottle income operation.........................................
    public function fetch_bottles($milk_type){
        if ($milk_type == "fresh") {
             $res = "<select style='width:110px' class='d-block p-1' name='bottle_capacity' id='bottleCapacity'>";
            $bottles = FreshBottle::all();
            if (count($bottles) > 0) {
                foreach ($bottles as $bottle) {
                    $res .= "<option value=".$bottle->price.">$bottle->capacity</option> ";
                }
                $res .= "</select>";
                $price = $bottles[0]->price;
            }else{
                $price = "";
              $res .= "<option value='' > hakuna taarifa</option></select>";
            }

         return response()->json(['data'=>$res,'initial_price'=>$price], 200);

        }elseif ($milk_type == "mgando") {

             $res = "<select style='width:110px' class='d-block p-1' name='bottle_capacity' id='bottleCapacity'>";
            $bottles = MgandoBottle::all();
            if (count($bottles) > 0) {
                foreach ($bottles as $bottle) {
                    $res .= "<option value=".$bottle->price.">$bottle->capacity</option> ";
                }
                $res .= "</select>";
                 $price = $bottles[0]->price;
            }else{
              $price = "";
              $res .= "<option value='' > hakuna taarifa</option></select>";
            }
           return response()->json(['data'=>$res,'initial_price'=>$price], 200);
            
        }else {
             return response()->json(['data'=>'error'], 200);
        }

    }

//fetch bottles availabe for bottle income operation.........................................
    public function fetch_volumes($milk_type){
        if ($milk_type == "fresh") {
             $res = "<select style='width:110px' class='d-block p-1' name='volume' id='volume'>";
            $volumes = FreshVolume::all();
            if (count($volumes) > 0) {
                foreach ($volumes as $volume) {
                    $res .= "<option value=".$volume->price.">$volume->volume</option> ";
                }
                $res .= "</select>";
                $price = $volumes[0]->price;
            }else{
                $price = "";
              $res .= "<option value='' > hakuna taarifa</option></select>";
            }

         return response()->json(['data'=>$res,'initial_price'=>$price], 200);

        }elseif ($milk_type == "mgando") {

             $res = "<select style='width:110px' class='d-block p-1' name='volume' id='volume'>";
            $volumes = MgandoVolume::all();
            if (count($volumes) > 0) {
                foreach ($volumes as $volume) {
                    $res .= "<option value=".$volume->price.">$volume->volume</option> ";
                }
                $res .= "</select>";
                 $price = $volumes[0]->price;
            }else{
              $price = "";
              $res .= "<option value='' > hakuna taarifa</option></select>";
            }
           return response()->json(['data'=>$res,'initial_price'=>$price], 200);
            
        }else {
             return response()->json(['data'=>'error'], 200);
        }

    }

    public function save_bottle_income(Request $request){
      $this->validate($request,[
        'price'=>'max:255',
        'quantity'=>'max:255',
        'amount'=>'max:255',
      ]);

      $milk_type = $request->milk_type;

      if ($milk_type == "mgando") {
          $data = MgandoBottle::where('price',$request->bottle_capacity)->first();
          $bottle_capacity = $data->capacity;
      }else{
          $data = FreshBottle::where('price',$request->bottle_capacity)->first();
          $bottle_capacity = $data->capacity; 
      }

      $income = new Income();
      $income->milk_type  = $milk_type;
      $income->bottle_capacity  = $bottle_capacity;
      $income->price  = $request->price;
      $income->quantity  = $request->quantity;
      $income->amount  = $request->amount;
      $income->save();
      session()->flash('income_saved', 'taarifa zimehifadhika kikamilifu');
     return redirect()->back();
    }

    public function save_litre_income(Request $request){
      $this->validate($request,[
        'price'=>'max:255',
        'quantity'=>'max:255',
        'amount'=>'max:255',
      ]);

      $milk_type = $request->milk_type;

      if ($milk_type == "mgando") {
          $data = MgandoVolume::where('price',$request->volume)->first();
          $volume = $data->volume;
      }else{
          $data = FreshVolume::where('price',$request->volume)->first();
          $volume = $data->volume; 
      }

      $income = new LitreIncome();
      $income->milk_type  = $milk_type;
      $income->volume  = $volume;
      $income->price  = $request->price;
      $income->quantity  = $request->quantity;
      $income->amount  = $request->amount;
      $income->save();
      session()->flash('income_saved', 'taarifa zimehifadhika kikamilifu');
     return redirect()->back();
    }

}
