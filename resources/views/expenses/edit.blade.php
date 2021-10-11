@extends('layouts.admin')
@section('content')
 <div class="container py-4 px-2 mt-2">
     <div class="row justify-content-center">
         <div class="col-md-5 px-4">
                    <div class="d-flex justify-content-between">
                        <div> <h5 class="h4 py-3 text-app text-times">Badili taarifa</h5></div>
                        <div>
                            <form id="expense_delete_form" method="POST" action="{{ route('expense.destroy',$expense->id) }}" class="form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Futa taarifa</button>
                            </form>
                        </div>
                    </div>

             @if (Session()->has('expense_updated'))
             <div class="alert alert-success my-3">
                 <button type="button" class="close" data-dismiss="alert">×</button>
                  <p>{{ Session('expense_updated') }}</p>
             </div>
             @endif  
    
            <form method="POST" action="{{ route('expense.update',$expense->id) }}" class="form">
                @method('PATCH')
                @csrf
                <div class="form-group pl-1">
                    <label for="purpose" class="text-times font-17">kwaajili ya</label>
                    <select name="purpose" id="purpose" class="form-control">
                        <option value="Malipo ya umeme">Malipo ya umeme</option>
                        <option value="mishahara ya wafanyakazi">mishahara ya wafanyakazi</option>
                        <option value="Manunuzi ya kuni">Manunuzi ya kuni</option>
                        <option value="Manunuzi ya maji">Manunuzi ya maji</option>
                        <option value="Malipo TRA">Malipo TRA</option>
                        <option value="Malipo Manispaa">Malipo Manispaa</option>
                        <option value="Malipo ya Wafugaji">Malipo ya Wafugaji</option>
                        <option value="Manunuzi ya chupa">Manunuzi ya chupa</option>
                        <option value="Manunuzi ya stika">Manunuzi ya stika</option>
                        <option value="Kutuma mzigo">Kutuma mzigo</option>
                        <option value="Manunuzi ya maji">Manunuzi ya maji</option>
                        <option value="mishahara ya wafanyakazi">mishahara ya wafanyakazi</option>
                        <option value="other">sababu nyingine</option>
                    </select>
                </div>
                <div class="form-group pl-1">
                <input style="display: none" name="lengo" type="text" id="lengo" class="form-control " value="{{ $expense->purpose }}" placeholder="andika sababu hapa">
                </div>
                 @error('lengo')
                <div class="alert alert-danger my-3">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <p>Tafadhari hakikisha umejaza fomu yote</p>
                </div> 
                 @enderror 
                <div class="form-group pl-1">
                     <label for="kiasi" class="text-times font-17">wahusika (hiari)</label>
                    <input type="text" name="to_whom" value="{{ $expense->to_whom }}" id="wahusika" class="form-control" placeholder="jina au majina ya wahusika">
                </div>
                <div class="form-group pl-1">
                     <label for="kiasi" class="text-times font-17">kiasi</label>
                    <input type="number" name="amount" id="kiasi" value="{{ $expense->amount }}" class="form-control" placeholder="andika kiasi hapa" required>
                </div>
            <button style="width: 110px;" type="submit" class="btn text-center btn-app">Submit</button>
            </form>

         </div>

     </div>
 </div>
 @stop

 @section('scripts')
 <script>
     $(document).ready(function() {
          $("#purpose").change(function () {
              if($(this).val() === "other"){
                 $("#lengo").show();
              }else{
                $("#lengo").hide();  
              }
          });

                //income deleting form .......................
            $("#expense_delete_form").submit(function(e) {
                if(!confirm('unathibitisha kuondoa taarifa hii?')){
                  e.preventDefault();
                }
            })
     })
 </script>
 @stop