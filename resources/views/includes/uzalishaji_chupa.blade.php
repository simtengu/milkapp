                <div class=" my-4 px-3">
                    <div class=" mt-5">
                        <h5 class=" text-dark mb-4">
                           Uzalishaji chupa
                        </h5>
                    </div>
                    <!-- The Modal -->
                    <div class="modal fade" id="chupa">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Uzalishaji Rejareja</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('production.produce_litre') }}" class="form">
                                        @csrf
                                        

                                            <div class="form-group">
                                                <label for="milk_type" class="text-muted text-arial font-18">Aina ya maziwa </label>
                                                <select class="form-control text-dark" name="milk_type" id="milk_type" required>
                                                    <option value="maziwa mgando" selected>mgando</option>
                                                    <option value="maziwa fresh" >fresh</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-muted text-arial font-18" for="litre">Idadi ya lita</label>
                                                <input type="number" min="0" name="litre" id="litre" class="form-control" placeholder="weka idadi" required>
                                            </div>
                                            <button type="submit" class="btn btn-app">Ongeza</button>
                                        
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="table-responsive card p-3">
                        <div class="d-flex justify-content-between align-items-center mb-3 px-2">
                            <p class="text-dark font-18 text-capitalize mt-2"></p>
                            <button type="button" data-toggle="modal" data-target="#chupa"
                                class="btn btn-sm btn-success">ongeza</button>
                        </div>

                        @if (Session()->has('litres_produced'))
                            <div class="alert alert-success my-2">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <p>{{ Session('litres_produced') }}</p>
                            </div>
                        @endif
                        @if (Session()->has('litres_updated'))
                            <div class="alert alert-success my-2">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <p>{{ Session('litres_updated') }}</p>
                            </div>
                        @endif

                        <table class="table table-striped">
                            <tbody>
                                @forelse ($produced_litres as $item)

                                <form method="POST"
                                    action="{{ route('production.update_litre_produced', $item->id) }}"
                                    class="form">
                                    @method('PATCH')
                                    @csrf
                                <tr>
                                        <td>
                                            @if ($item->milk_type == 'maziwa fresh')
                                            <select style="width: 150px !important" id="editFormInput" class="form-control text-dark" name="milk_type" id="milk_type" required>
                                                <option value="maziwa mgando" >maziwa mgando</option>
                                                <option value="maziwa fresh" selected>maziwa fresh</option>
                                            </select>
                                            @else 
                                            <select style="width: 150px !important" id="editFormInput" class="form-control text-dark" name="milk_type" id="milk_type" required>
                                                <option value="maziwa mgando" selected>maziwa mgando</option>
                                                <option value="maziwa fresh" >maziwa fresh</option>
                                            </select>
                                                
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-around align-items-center">
                                                <div>
                                                    <p class="text-muted text-lead">Lita:</p>
                                                </div>
                                                <div>
                                                        <div class=" form-group">
                                                            <div class="d-flex">

                                                                <input style="width: 50px !important" name="litre" id="editFormInput" class="text-dark"
                                                                    value={{ $item->litre }} type="number" required />
                                                                <button type="submit"
                                                                    class="btn btn-warning btn-sm">edit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </td>
                                    </tr>
                                            </form>

                                @empty
                                    <tr>
                                        <td>
                                            <p class="text-muted text-lead">Bado haujafanyika Uzalishaji wa maziwa ya rejareja</p>
                                        </td>
                                    </tr>

                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            <p class="text-muted font-16 text-capitalize px-2 font-weight-bold mt-2">Jumla: lita
                                total: 848</p>
                        </div>
                    </div>



                </div>