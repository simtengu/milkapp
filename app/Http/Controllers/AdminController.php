<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin')->except('index');
    }

    public function index()
    {
        $bottle_incomes = Income::whereDate('created_at','=',Carbon::today())->latest()->simplePaginate(60);
        $yogurt_incomes = YogurtIncome::whereDate('created_at', '=', Carbon::today())->latest()->simplePaginate(60);
        $litre_incomes = LitreIncome::whereDate('created_at','=',Carbon::today())->latest()->simplePaginate(60);
        $expenses = Expense::whereDate('created_at','=',Carbon::today())->latest()->simplePaginate(60);
        return view('admin.index', compact('litre_incomes','yogurt_incomes', 'bottle_incomes', 'expenses'));
    }

    public function edit_information()
    {
        $fresh_bottles = FreshBottle::all();
        $yogurt_bottles = Yogurt::all();
        $mgando_bottles = MgandoBottle::all();
        $fresh_volumes = FreshVolume::all();
        $mgando_volumes = MgandoVolume::all();
        return view('admin.edit_info', [
            'fresh_bottles' => $fresh_bottles,
            'yogurt_bottles' => $yogurt_bottles,
            'mgando_bottles' => $mgando_bottles,
            'fresh_volumes' => $fresh_volumes,
            'mgando_volumes' => $mgando_volumes
        ]);
    }

    //fresh milk bottles crud operations.......................................................
    public function save_fresh_bottle_details(Request $request)
    {
        $this->validate($request, [
            'capacity' => 'max:244',
            'price' => 'max:244'
        ]);
        FreshBottle::create($request->all());
        session()->flash('fresh_bottle_saved', 'taarifa zimehifadhika kikamilifu');
        return redirect()->back();
    }

    public function edit_fresh_bottle_details(Request $request, $id)
    {
        $this->validate($request, [
            'capacity' => 'max:244',
            'price' => 'max:244'
        ]);
        $data = FreshBottle::findOrFail($id);
        $data->capacity = $request->capacity;
        $data->price = $request->price;

        $data->save();
        session()->flash('fresh_bottle_edited', 'taarifa zimebadilishwa kikamilifu');
        return redirect()->back();
    }

    public function remove_fresh_bottle($id)
    {
        $bottle = FreshBottle::findOrFail($id);
        $bottle->delete();
        session()->flash('fresh_bottle_removed', 'Taarifa zimeondolewa kikamilifu');
        return redirect()->back();
    }

    //end of fresh milk bottle crud operations...........................................
    //mgando milk bottle crud operations...................................................
    public function save_mgando_bottle_details(Request $request)
    {
        $this->validate($request, [
            'capacity' => 'max:244',
            'price' => 'max:244'
        ]);
        MgandoBottle::create($request->all());
        session()->flash('mgando_bottle_saved', 'taarifa zimehifadhika kikamilifu');
        return redirect()->back();
    }

    public function edit_mgando_bottle_details(Request $request, $id)
    {
        $this->validate($request, [
            'capacity' => 'max:244',
            'price' => 'max:244'
        ]);
        $data = MgandoBottle::findOrFail($id);
        $data->capacity = $request->capacity;
        $data->price = $request->price;

        $data->save();
        session()->flash('mgando_bottle_edited', 'taarifa zimebadilishwa kikamilifu');
        return redirect()->back();
    }

    public function remove_mgando_bottle($id)
    {
        $bottle = MgandoBottle::findOrFail($id);
        $bottle->delete();
        session()->flash('mgando_bottle_removed', 'Taarifa zimeondolewa kikamilifu');
        return redirect()->back();
    }
    //end of mgando milk bottle crud operations...................................................
    //fresh milk volumes crud operations.......................................................
    public function save_fresh_volume_details(Request $request)
    {
        $this->validate($request, [
            'volume' => 'max:244',
            'price' => 'max:244'
        ]);
        FreshVolume::create($request->all());
        session()->flash('fresh_volume_saved', 'taarifa zimehifadhika kikamilifu');
        return redirect()->back();
    }

    public function edit_fresh_volume_details(Request $request, $id)
    {
        $this->validate($request, [
            'volume' => 'max:244',
            'price' => 'max:244'
        ]);
        $data = FreshVolume::findOrFail($id);
        $data->volume = $request->volume;
        $data->price = $request->price;

        $data->save();
        session()->flash('fresh_volume_edited', 'taarifa zimebadilishwa kikamilifu');
        return redirect()->back();
    }

    public function remove_fresh_volume($id)
    {
        $bottle = FreshVolume::findOrFail($id);
        $bottle->delete();
        session()->flash('fresh_volume_removed', 'Taarifa zimeondolewa kikamilifu');
        return redirect()->back();
    }
    //end of fresh milk volumes crud operations...........................................

    //mgando milk volumes crud operations.......................................................
    public function save_mgando_volume_details(Request $request)
    {
        $this->validate($request, [
            'volume' => 'max:244',
            'price' => 'max:244'
        ]);
        MgandoVolume::create($request->all());
        session()->flash('mgando_volume_saved', 'taarifa zimehifadhika kikamilifu');
        return redirect()->back();
    }

    public function edit_mgando_volume_details(Request $request, $id)
    {
        $this->validate($request, [
            'volume' => 'max:244',
            'price' => 'max:244'
        ]);
        $data = MgandoVolume::findOrFail($id);
        $data->volume = $request->volume;
        $data->price = $request->price;

        $data->save();
        session()->flash('mgando_volume_edited', 'taarifa zimebadilishwa kikamilifu');
        return redirect()->back();
    }

    public function remove_mgando_volume($id)
    {
        $bottle = MgandoVolume::findOrFail($id);
        $bottle->delete();
        session()->flash('mgando_volume_removed', 'Taarifa zimeondolewa kikamilifu');
        return redirect()->back();
    }
    //end of mgando milk volumes crud operations...........................................

    // yogurt bottle crud operations............................................ ...... 

    public function save_yogurt_bottle_details(Request $request)
    {
        $this->validate($request, [
            'capacity' => 'max:244',
            'price' => 'max:244'
        ]);
        Yogurt::create($request->all());
        session()->flash('yogurt_bottle_saved', 'taarifa zimehifadhika kikamilifu');
        return redirect()->back();
    }

    public function edit_yogurt_bottle_details(Request $request, $id)
    {
        $this->validate($request, [
            'capacity' => 'max:244',
            'price' => 'max:244'
        ]);
        $data = Yogurt::findOrFail($id);
        $data->capacity = $request->capacity;
        $data->price = $request->price;

        $data->save();
        session()->flash('yogurt_bottle_edited', 'taarifa zimebadilishwa kikamilifu');
        return redirect()->back();
    }

    public function remove_yogurt_bottle($id)
    {
        $bottle = Yogurt::findOrFail($id);
        $bottle->delete();
        session()->flash('yogurt_bottle_removed', 'Taarifa zimeondolewa kikamilifu');
        return redirect()->back();
    }
    //end of  yogurt bottle crud operations............................................ 

//update details.............................. 
public function edit_details(){
    $users  = User::where('role_id',1)->get();
    return view('admin.update_details',compact('users'));
}

public function update_details(Request $request){
        $hashed = Auth::user()->password;
        if (Hash::check($request->current_pwd, $hashed)) {
            $user = User::findOrFail(Auth::user()->id);
            $user->password = Hash::make($request->new_password);
            $user->email = $request->email;
            $user->name = $request->name;
            $user->save();
        }
        session()->flash('details_updated', 'Umebadili taarifa kikamilifu');
         return redirect()->back();
}

public function remove_system_user($id){
    $user = User::findOrFail($id);
    $user->delete();
    session()->flash('user_removed','Umeondoa mtumiaji mmoja kikamilifu');
    return redirect()->back();
}



}
