@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-around mt-2 mt-md-4 p-3">
            <div style="box-shadow: 1px 1px 2px grey" class="col-md-5 card p-2 bg-app ">
                <h3 class="text-dark text-times first-level-title font-weight-bold text-capitalize">Taarifa kuhusu maziwa
                    fresh</h3>
                {{-- mauzo ya chupa maziwa fresh section.......................................................... --}}
                {{-- modal.................................................... --}}
                <div class="modal fade" id="chupaFreshMilkForm">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-arial cl-primary">Ongeza Chupa</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('save_fresh_bottle_details') }}" class="form">
                                    @csrf
                                    <div>
                                        <div class="form-group">
                                            <label for="bottle_capacity">jina</label>
                                            <input name="capacity" id="bottle_capacity" type="text" class="form-control"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label for="bottle_capacity">Bei husika</label>
                                            <input name="price" id="bottle_capacity" type="number" class="form-control"
                                                required>
                                        </div>
                                        <button type="submit" class="btn btn-app">submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="py-3">
                    <h5 class="text-times">Chupa na bei husika</h5>
                    @if (Session()->has('fresh_bottle_saved'))
                        <div class="alert alert-success my-2">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <p>{{ Session('fresh_bottle_saved') }}</p>
                        </div>
                    @endif

                    @if (Session()->has('fresh_bottle_removed'))
                        <div class="alert alert-success my-2">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <p>{{ Session('fresh_bottle_removed') }}</p>
                        </div>
                    @endif

                    @if (Session()->has('fresh_bottle_edited'))
                        <div class="alert alert-success my-2">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <p>{{ Session('fresh_bottle_edited') }}</p>
                        </div>
                    @endif
                    <div class="table-responsive">
                    <table class="table table-dark table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Aina ya chupa</th>
                                <th>Bei husika</th>
                                <th>
                                    <div class="text-right">
                                        <button type="button" data-toggle="modal" data-target="#chupaFreshMilkForm"
                                            class="btn btn-success btn-sm pull-right"><i class="fas fa-plus"></i>add</button>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- iterating through fresh milk bottles available.................... --}}
                            @forelse ($fresh_bottles as $bottle)
                                <tr>
                                    <form method="POST" action="{{ route('edit_fresh_bottle_details', $bottle->id) }}"
                                        class="form">
                                        @method('PATCH')
                                        @csrf
                                        <td><input name="capacity" id="editFormInput" value="{{ $bottle->capacity }}"
                                                type="text" required /></td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center">
                                            <div>                                             
                                            <input name="price" id="editFormInput" value={{ $bottle->price }}
                                                type="number" required /> 
                                            </div>
                                            <div>
                                             
                                            <button type="submit" class="btn btn-warning btn-sm"><i
                                                        class="fas fa-edit"></i>edit</button>                                                
                                            </div>
                                            </div>
                                    </form>
                                        </td>
                                        <td>
                                 
                                    <form id="delete_fresh_bottle_form" method="POST"
                                        action="{{ route('delete_fresh_bottle', $bottle->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick=" if( !confirm('unathibitisha kufuta taarifa hii')){
                                event.preventDefault(); }" type="submit" class="btn btn-danger btn-sm"><i
                                                class="fas fa-trash"></i>delete</button>
                                    </form>
                              
                </td>
                </tr>
            @empty
                <h5 class="text-arial cl-primary">Hakuna taarifa kwa sasa</h5>
                @endforelse

                </tbody>
                </table>
                </div>
            </div>
            {{-- mauzo kwa ujazo maziwa fresh section.......................................................... --}}
            {{-- modal......................................... --}}

            <div class="modal fade" id="litaFreshMilkForm">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-arial cl-primary">Ongeza Ujazo</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('save_fresh_volume_details') }}" class="form">
                                @csrf
                                <div>

                                    <div class="form-group">
                                        <label for="bottle_volume">kiwango cha ujazo</label>
                                        <input name="volume" id="bottle_volume" type="text" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="bottle_price">Bei husika</label>
                                        <input name="price" id="bottle_price" type="number" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-app">submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="">
                <h5 class="text-times">Ujazo na bei husika</h5>
                @if (Session()->has('fresh_volume_saved'))
                    <div class="alert alert-success my-2">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p>{{ Session('fresh_volume_saved') }}</p>
                    </div>
                @endif

                @if (Session()->has('fresh_volume_removed'))
                    <div class="alert alert-success my-2">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p>{{ Session('fresh_volume_removed') }}</p>
                    </div>
                @endif

                @if (Session()->has('fresh_volume_edited'))
                    <div class="alert alert-success my-2">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p>{{ Session('fresh_volume_edited') }}</p>
                    </div>
                @endif
                <div class="table-responsive">
                <table class="table table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Ujazo</th>
                            <th>Bei husika</th>
                            <th>
                                <div class="text-right">
                                    <button type="button" data-toggle="modal" data-target="#litaFreshMilkForm"
                                        class="btn btn-success btn-sm pull-right"><i class="fas fa-plus"></i>add</button>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- iterating through fresh milk volumes available.................... --}}
                        @forelse ($fresh_volumes as $volume)
                            <tr>
                                <form method="POST" action="{{ route('edit_fresh_volume_details', $volume->id) }}"
                                    class="form">
                                    @method('PATCH')
                                    @csrf
                                    <td><input name="volume" id="editFormInput" value="{{ $volume->volume }}" type="text"
                                            required /></td>
                                    <td>
                                        <div class="d-flex justify-content-between align-items-center">
                                        
                                        <div>
                                        <input name="price" id="editFormInput" value={{ $volume->price }} type="number"
                                            required />                                            
                                        </div>
                                        <div>
                                             <button type="submit" class="btn btn-warning btn-sm"><i
                                                    class="fas fa-edit"></i>edit</button>                                           
                                        </div>

                                        </div> 

                                </form>                                    
                                    </td>
                                    <td>
                                     

                                <form id="delete_fresh_volume_form" method="POST"
                                    action="{{ route('delete_fresh_volume', $volume->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick=" if( !confirm('unathibitisha kufuta taarifa hii')){
                                event.preventDefault(); }" type="submit" class="btn btn-danger btn-sm"><i
                                            class="fas fa-trash"></i>edit</button>
                                </form>
            
            </td>
            </tr>
        @empty
            <h5 class="text-arial cl-primary">Hakuna taarifa kwa sasa</h5>
            @endforelse

            </tbody>
            </table>
            </div>
        </div>
    </div>
    {{-- taarifa juu ya maziwa mgando section............................................... --}}
    <div style="box-shadow: 1px 1px 2px grey" class="col-md-5 card bg-app ">
        <h3 class="text-dark text-times first-level-title font-weight-bold text-capitalize">Taarifa kuhusu maziwa mgando
        </h3>
        {{-- mauzo kwa chupa maziwa mgando section.............................................. --}}

        {{-- modal...................................................... --}}

        <div class="modal fade" id="chupaMgandoMilkForm">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-arial cl-primary">Ongeza Chupa</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('save_mgando_bottle_details') }}" class="form">
                            @csrf
                            <div>
                                <div class="form-group">
                                    <label for="mgando_bottle_capacity">jina</label>
                                    <input name="capacity" id="mgando_bottle_capacity" type="text" class="form-control"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="bottle_capacity">Bei husika</label>
                                    <input name="price" id="mgando_bottle_capacity" type="number" class="form-control"
                                        required>
                                </div>
                                <button type="submit" class="btn btn-app">submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-3">
            <h5 class="text-times">Chupa na bei husika</h5>

            @if (Session()->has('mgando_bottle_saved'))
                <div class="alert alert-success my-2">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <p>{{ Session('mgando_bottle_saved') }}</p>
                </div>
            @endif

            @if (Session()->has('mgando_bottle_removed'))
                <div class="alert alert-success my-2">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <p>{{ Session('mgando_bottle_removed') }}</p>
                </div>
            @endif

            @if (Session()->has('mgando_bottle_edited'))
                <div class="alert alert-success my-2">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <p>{{ Session('mgando_bottle_edited') }}</p>
                </div>
            @endif
             <div class="table-responsive">
            <table class="table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th>Aina ya chupa</th>
                        <th>Bei husika</th>
                        <th>
                            <div class="text-right">
                                <button type="button" data-toggle="modal" data-target="#chupaMgandoMilkForm"
                                    class="btn btn-success btn-sm pull-right"><i class="fas fa-plus"></i>add</button>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {{-- iterating through mgando milk bottles available.................... --}}
                    @forelse ($mgando_bottles as $bottle)
                        <tr>
                            <form method="POST" action="{{ route('edit_mgando_bottle_details', $bottle->id) }}"
                                class="form">
                                @method('PATCH')
                                @csrf
                                <td><input name="capacity" id="editFormInput" value="{{ $bottle->capacity }}" type="text"
                                        required /></td>
                                <td>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                    <input name="price" id="editFormInput" value={{ $bottle->price }} type="number"
                                        required />                                            
                                        </div>
                                        <div>
                                        <button type="submit" class="btn btn-warning btn-sm"><i
                                                class="fas fa-edit"></i>edit</button>                                            
                                            
                                        </div>
                                    </div>
                                        
                                </td>

                            </form>                                
                                <td>
                                    

                            <form id="delete_fresh_bottle_form" method="POST"
                                action="{{ route('delete_mgando_bottle', $bottle->id) }}">
                                @csrf
                                @method('DELETE')
                                <button onclick=" if( !confirm('unathibitisha kufuta taarifa hii')){
                                event.preventDefault(); }" type="submit" class="btn btn-danger btn-sm"><i
                                        class="fas fa-trash"></i>delete</button>
                            </form>
        
        </td>
        </tr>
    @empty
        <h5 class="text-arial cl-primary">Hakuna taarifa kwa sasa</h5>
        @endforelse

        </tbody>
        </table>
        </div>
    </div>
    {{-- mauzo kwa ujazo maziwa mgando section................................................. --}}

    <div class="modal fade" id="litaMgandoMilkForm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-arial cl-primary">Ongeza Ujazo</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('save_mgando_volume_details') }}" class="form">
                        @csrf
                        <div>

                            <div class="form-group">
                                <label for="mgando_volume">kiwango cha ujazo</label>
                                <input name="volume" id="mgando_volume" type="text" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="mgando_price">Bei husika</label>
                                <input name="price" id="mgando_price" type="number" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-app">submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="">
        <h5 class="text-times">Ujazo na bei husika</h5>
        @if (Session()->has('mgando_volume_saved'))
            <div class="alert alert-success my-2">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <p>{{ Session('mgando_volume_saved') }}</p>
            </div>
        @endif

        @if (Session()->has('mgando_volume_removed'))
            <div class="alert alert-success my-2">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <p>{{ Session('mgando_volume_removed') }}</p>
            </div>
        @endif

        @if (Session()->has('mgando_volume_edited'))
            <div class="alert alert-success my-2">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <p>{{ Session('mgando_volume_edited') }}</p>
            </div>
        @endif
        <div class="table-responsive">
        <table class="table table-dark table-striped table-hover">
            <thead>
                <tr>
                    <th>Ujazo</th>
                    <th>Bei husika</th>
                    <th>
                        <div class="text-right">
                            <button type="button" data-toggle="modal" data-target="#litaMgandoMilkForm"
                                class="btn btn-success btn-sm pull-right"><i class="fas fa-plus"></i>add</button>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                {{-- iterating through mgando milk volumes available.................... --}}
                @forelse ($mgando_volumes as $volume)
                    <tr>
                        <form method="POST" action="{{ route('edit_mgando_volume_details', $volume->id) }}" class="form">
                            @method('PATCH')
                            @csrf
                            <td><input name="volume" id="editFormInput" value="{{ $volume->volume }}" type="text"
                                    required /></td>


                            <td>
<div class="d-flex justify-content-between align-items-center">
                                        <div>
                                <input name="price" id="editFormInput" value={{ $volume->price }} type="number"
                                    required />                                           
                                        </div>
                                        <div>
                                      <button type="submit" class="btn btn-warning btn-sm"><i
                                            class="fas fa-edit"></i>edit</button>                                            
                                            
                                        </div>

</div>

                    
                            </td>

                        </form>                            
                            <td>

                        <form id="delete_mgando_volume_form" method="POST"
                            action="{{ route('delete_mgando_volume', $volume->id) }}">
                            @csrf
                            @method('DELETE')
                            <button onclick=" if( !confirm('unathibitisha kufuta taarifa hii')){
                                event.preventDefault(); }" type="submit" class="btn btn-danger btn-sm"><i
                                    class="fas fa-trash"></i>delete</button>
                        </form>
    
    </td>
    </tr>
@empty
    <h5 class="text-arial cl-primary">Hakuna taarifa kwa sasa</h5>
    @endforelse

    </tbody>
    </table>
    </div>
    </div>
    </div>
    </div>

  <div class="row ml-lg-5 mt-2 mt-md-4 p-3">
            <div style="box-shadow: 1px 1px 2px grey" class="col-md-5 card p-2 bg-app ">
                <h3 class="text-dark text-times first-level-title font-weight-bold text-capitalize">Taarifa kuhusu Yogurt
                    </h3>
                {{-- mauzo ya chupa za yogurt section.......................................................... --}}
                {{-- modal.................................................... --}}
                <div class="modal fade" id="yogurtForm">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-arial cl-primary">Ongeza Chupa</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('save_yogurt_bottle_details') }}" class="form">
                                    @csrf
                                    <div>
                                        <div class="form-group">
                                            <label for="bottle_capacity">jina/ujazo wa chupa</label>
                                            <input name="capacity" id="yogurt_bottle_capacity" type="text" class="form-control"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label for="bottle_capacity">Bei husika</label>
                                            <input name="price" id="bottle_capacity" type="number" class="form-control"
                                                required>
                                        </div>
                                        <button type="submit" class="btn btn-app">submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="py-3">
                    {{-- <h5 class="text-times">Chupa na bei husika</h5> --}}
                    @if (Session()->has('yogurt_bottle_saved'))
                        <div class="alert alert-success my-2">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <p>{{ Session('yogurt_bottle_saved') }}</p>
                        </div>
                    @endif

                    @if (Session()->has('yogurt_bottle_removed'))
                        <div class="alert alert-success my-2">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <p>{{ Session('yogurt_bottle_removed') }}</p>
                        </div>
                    @endif

                    @if (Session()->has('yogurt_bottle_edited'))
                        <div class="alert alert-success my-2">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <p>{{ Session('yogurt_bottle_edited') }}</p>
                        </div>
                    @endif
                    <div class="table-responsive">
                    <table class="table table-dark table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Aina/ujazo wa chupa</th>
                                <th>Bei husika</th>
                                <th>
                                    <div class="text-right">
                                        <button type="button" data-toggle="modal" data-target="#yogurtForm"
                                            class="btn btn-success btn-sm pull-right"><i class="fas fa-plus"></i>add</button>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- iterating through fresh milk bottles available.................... --}}
                            @forelse ($yogurt_bottles as $bottle)
                                <tr>
                                    <form method="POST" action="{{ route('edit_yogurt_bottle_details', $bottle->id) }}"
                                        class="form">
                                        @method('PATCH')
                                        @csrf
                                        <td><input name="capacity" id="editFormInput" value="{{ $bottle->capacity }}"
                                                type="text" required /></td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    
                                            <input name="price" id="editFormInput" value={{ $bottle->price }} type="number"
                                                required />                                                    
                                                </div>
                                                <div>
                                                    
                                                 <button type="submit" class="btn btn-warning btn-sm"> <span class="d-flex align-items-center"><i
                                                        class="fas fa-edit"></i>edit</span> </button>                                                    
                                                </div>
                                            </div>

                                                
                                        </td>

                                    </form>                                       
                                        <td>
                                           

                                    <form id="delete_yogurt_bottle_form" method="POST"
                                        action="{{ route('delete_yogurt_bottle', $bottle->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick=" if( !confirm('unathibitisha kufuta taarifa hii')){
                        event.preventDefault(); }" type="submit" class="btn btn-danger btn-sm"> <span class="d-flex align-items-center"><i
                                                class="fas fa-trash"></i>delete</span></button>
                                    </form>
               
                </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-warning">Hakuna taarifa kwa sasa</td></tr>
                @endforelse

                </tbody>
                </table>
                </div>
            </div>
            {{-- mauzo kwa ujazo maziwa fresh section.......................................................... --}}
            {{-- modal......................................... --}}
  </div>

    </div>
@stop

@section('scripts')
    <script>
        $(document).ready(function() {
            //  $("#delete_fresh_bottle_form").submit(function(e){
            //   if( !confirm('unathibitisha kufuta taarifa hii')){
            //       e.preventDefault();
            //   }

            //  });
        });

    </script>
@stop
