<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('expenses.index');
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
        $this->validate($request, [
            'lengo' => 'required_if:purpose,other|max:255',
            'amount' => 'required|max:11',
            'to_whom' => 'max:255',

        ]);
        $purpose = $request->purpose == "other" ? $request->lengo : $request->purpose;

        $new_expense = new Expense();
        $new_expense->purpose = $purpose;
        $new_expense->amount = $request->amount;
        $new_expense->to_whom = $request->to_whom;
        $new_expense->added_by = Auth::user()->name;
        $new_expense->save();
        session()->flash('expense_saved', 'taarifa zimehifadhika kikamilifu');
        return redirect()->back();
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
        $expense = Expense::findOrFail($id);
        return view('expenses.edit',compact('expense'));
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
        $expense = Expense::findOrFail($id);
        $this->validate($request, [
            'lengo' => 'required_if:purpose,other|max:255',
            'amount' => 'required|max:11',
            'to_whom' => 'max:255',

        ]);
        $purpose = $request->purpose == "other" ? $request->lengo : $request->purpose;
        $expense->purpose = $purpose;
        $expense->amount = $request->amount;
        $expense->to_whom = $request->to_whom;
        $expense->added_by = Auth::user()->name;
        $expense->save();
        session()->flash('expense_updated', 'taarifa zimehifadhika kikamilifu');
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();
        session()->flash('income_removed', 'taarifa zimeondolewa kikamilifu');
        return redirect()->route('dashboard');
    }
}
