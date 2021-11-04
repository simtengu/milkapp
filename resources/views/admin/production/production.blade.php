@extends('layouts.admin')
@section('content')
    <div class="container">

        <div class="row justify-content-center p-2">
            <div class="col-md-8 col-lg-7 my-2">
                <h2 class="text-times font-22 text-app font-weight-bold">Today's Production</h2>
{{-- mapokezi ya maziwa.......................................................... --}}
       @include('includes.pokea_maziwa')
{{-- uzalishaji rejareja............................................................................... --}}
       @include('includes.uzalishaji_rejareja')
       {{-- uzalishaji chupa.................................................................   --}}
       @include('includes.uzalishaji_chupa')

            </div>
        </div>
    </div>
@stop()
@section('scripts')
<script>
    $(document).ready(function() {

            //fetching system bottles available according to type of  milk

            $("#bottleMilkType").change(function() {
                let milkType = $(this).val();
                let url = "{{ url('fetch_bottles') }}" + "/" + milkType;

                $.ajax({
                    url: url,
                    method: 'GET',
                    beforeSend: function() {
                        $("#loader_container").fadeIn();
                    },
                    complete: function() {
                        $("#loader_container").fadeOut();
                    },
                    success: function(res) {

                        if (res.data == "error") {
                            alert(
                                "something went wrong..probably it's because of your unappropriate way of request sending");
                        } else {
                            $("#bottleCapacity").replaceWith(res.data);
                            $("#bottle_price").val(res.initial_price);
                            $("#bottleTotalAmount").val(0);
                            $("#bottleQuantity").val(0);
                        }
                    },
                    error: function() {
                        alert('something went wrong please try again later');
                    }
                });
            });




        



    });

</script>
@stop
