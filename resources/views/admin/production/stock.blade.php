@extends('layouts.admin')
@section('content')
    <div class="container-fluid">


        <div class=" my-4">
            <div class="">
                <h5 class="card-heading text-app">
                    Our Stock
                </h5>
                <p class="text-lead text-muted text-arial text-capitalize">mapokezi ya maziwa</p>
            </div>
         <div class="table-responsive">
             <table class="table table-striped">
             <thead>
                 <tr>
                     <th></th>
                 </tr>
             </thead>
             <tbody>
                 <tr>
                     <td></td>
                 </tr>
             </tbody>
             </table>
         </div> 

        </div>
    </div>
@stop()
@section('scripts')
    <script>
        $(document).ready(function() {

            $("#date_btn").click(function(e) {
                $("#date_div").toggle();
                e.stopPropagation();
            })

            $("#date_range_btn").click(function(e) {
                $("#date_range_div").toggle();
                e.stopPropagation();
            })

            $(document).click(function() {
                $("#date_div").hide();
                $("#date_range_div").hide();
            });

            $("#date_div").click(function(e) {
                e.stopPropagation();
            })
            $("#date_range_div").click(function(e) {
                e.stopPropagation();
            })

            $("#chupa_btn").click(function() {
                $(".chupa-section").show();
                $(".lita-section").hide();
            })

            $("#lita_btn").click(function() {
                $(".chupa-section").hide();
                $(".lita-section").show();
            })

        });

    </script>
@stop
