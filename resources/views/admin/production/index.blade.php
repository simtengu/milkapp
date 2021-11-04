@extends('layouts.admin')
@section('content')
    <div class="container-fluid">


        <div class="card my-4">
            <div class="card-header">
                <h3 class="text-times text-app">Achievements</h3>
                <div class="d-flex flex-wrap">
                    <div>
                        <a href="{{ route('production.index') }}" class="btn btn-sm btn-outline-secondary mx-1">Today</a>
                    </div>
                    <div style="position: relative">
                        <button id="date_btn" class="btn btn-sm btn-outline-secondary mx-1">Date</button>
                        <div style="display:none; position: absolute;left:0px;top:31px;z-index:100;"
                            class="border rounded shadow bg-light" id="date_div">
                            <div style="border-radius: 5px 5px 0px 0px; background: linear-gradient(rgb(147, 56, 212),indigo) "
                                class="d-flex justify-content-center align-items-center p-1">
                                <p class="text-light text-times font-17 text-capitalize mt-1">pick date</p>
                            </div>

                            <div class="p-2">
                                <form method="POST" action="{{ route('production.date_filter') }}" class="form">
                                    @csrf
                                    <div class="form-group">
                                        <input name="date" class="form-control" type="date" required>
                                        <button class="btn btn-app-outline mt-2 btn-sm btn-block">submit</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div style="position: relative">
                        <button id="date_range_btn" class="btn btn-sm btn-outline-secondary mx-1">Date range</button>
                        <div style="display:none; position: absolute;left:0px;top:31px;z-index:100;"
                            class="border rounded shadow bg-light" id="date_range_div">
                            <div style="border-radius: 5px 5px 0px 0px; background: linear-gradient(rgb(147, 56, 212),indigo) "
                                class="d-flex justify-content-center align-items-center p-1">
                                <p class="text-light text-times font-17 text-capitalize mt-1">select range</p>
                            </div>

                            <div class="p-2">
                                <form method="POST" action="{{ route('production.date_range_filter') }}" class="form">
                                    @csrf
                                    <div class="form-group">
                                        <label for="from_date">From</label>
                                        <input name="from_date" class="form-control" id="from_date" type="date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="to_date">To</label>
                                        <input name="to_date" class="form-control" id="to_date" type="date" required>
                                    </div>

                                    <button class="btn btn-app-outline btn-sm btn-block">submit</button>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('production.all_filter') }}" class="btn btn-sm btn-outline-secondary mx-1">All</a>
                    </div>

                </div>
            </div>
            <div class="card-body">
                @isset($today_filter)
                    <h5 class="text-dark text-times">{{ $today_filter }}</h5>
                @endisset

                @isset($all_filter)
                    <h5 class="text-dark text-times">{{ $all_filter }}</h5>
                @endisset

                @isset($date_filter)
                    <h5 class="text-dark text-times">{{ $date_filter }}</h5>
                @endisset

                @isset($date_range_filter)
                    <h5 class="text-dark text-times">{{ $date_range_filter }}</h5>
                @endisset
                <div class="row justify-content-start mb-2">
                    <div class="mx-3 my-1">
                        <button id="chupa_btn" class="btn btn-app text-times font-18">Chupa</button>
                    </div>

                    <div class="mx-3 my-1">
                        <button id="lita_btn" class="btn btn-app text-times font-18">Rejareja</button>
                    </div>

                </div>
                <hr>

                {{-- chupa section.............................................................................. --}}
                <div class="py-2 chupa-section">
                    <h5 class="text-times text-app font-weight-bold">Chupa</h5>
                    <div class="my-2 row">
                        <div class="col-md-4 px-1 my-2">
                            <p class="text-muted text-lead font-18 text-times">Maziwa Mgando</p>
                            <div class="card bg-light px-2">
                                @foreach ($mgando_bottles as $bottle)
                                    <div class="d-flex justify-content-between">
                                        <p class="card-text mb-1">{{ $bottle->capacity }}: chupa {{ $bottle->count }} </p>
                                        <p class="card-text mb-1">Jumla:
                                            {{  number_format($bottle->amount)  }} Tsh</p>
                                    </div>
                                @endforeach

                            </div>

                        </div>

                        <div class="col-md-4 px-1 my-2">
                            <p class="text-muted text-lead font-18 text-times">Maziwa Fresh</p>
                            <div class="card bg-light px-2">
                                @foreach ($fresh_bottles as $bottle)
                                    <div class="d-flex justify-content-between">
                                        <p class="card-text mb-1">{{ $bottle->capacity }}: chupa {{ $bottle->count }} </p>
                                        <p class="card-text mb-1">Jumla:
                                            {{  number_format($bottle->amount)  }} Tsh</p>
                                    </div>
                                @endforeach

                            </div>

                        </div>

                        <div class="col-md-4 px-1 my-2">
                            <p class="text-muted text-lead font-18 text-times">Yogurt</p>
                            <div class="card px-2 bg-light">
                                @foreach ($yogurt_bottles as $bottle)
                                    <div class="d-flex justify-content-between">
                                        <p class="card-text mb-1">{{ $bottle->capacity }}: chupa {{ $bottle->count }} </p>
                                        <p class="card-text mb-1">Jumla:
                                            {{ number_format($bottle->amount)  }} Tsh</p>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                    </div>
                </div>

                {{-- lita section................................................................... --}}
                <div style="display: none" class="py-2 lita-section">
                    <h5 class="text-times text-app font-weight-bold">Rejareja</h5>
                    <div class="my-2 row">
                        <div class="col-md-4 px-1 my-2">
                            <p class="text-muted text-lead font-18 text-times">Maziwa Mgando</p>
                            <div class="card px-2 bg-light">
                                @foreach ($mgando_volumes as $volume)
                                    <div class="d-flex justify-content-between">
                                        <p class="card-text mb-1">{{ $volume->volume }}: x {{ $volume->count }} </p>
                                        <p class="card-text mb-1">Jumla:
                                            {{ number_format($volume->amount)  }} Tsh</p>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                        <div class="col-md-4 px-1 my-2">
                            <p class="text-muted text-lead font-18 text-times">Maziwa Fresh</p>
                            <div class="card px-2 bg-light">
                                @foreach ($fresh_volumes as $volume)
                                    <div class="d-flex justify-content-between">
                                        <p class="card-text mb-1">{{ $volume->volume }}: x {{ $volume->count }} </p>
                                        <p class="card-text mb-1">Jumla:
                                            {{ number_format($volume->amount)  }} Tsh</p>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                    </div>
                </div>

                {{-- end of lita sectionnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn --}}

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
