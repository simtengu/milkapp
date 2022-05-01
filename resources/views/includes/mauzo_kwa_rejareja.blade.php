                <div style="display: none" class="pt-5 my-2 my-md-5" id="rejareja">
                    <h5 class="h4 py-3 text-app text-times">Mauzo ya rejareja</h5>
                    <form method="POST" action="{{ route('save_litre_income') }}" class="form">
                        @csrf
                        <div class="form-group">
                            <label for="bottleMilkType">Aina ya maziwa</label>
                            <select style="width:110px" class="d-block p-1" name="milk_type" id="volumeMilkType">
                                <option selected value="mgando">mgando</option>
                                <option value="fresh">fresh</option>
                            </select>
                        </div>

                        <div id="volume_container" class="form-group">
                            <label for="volume">Aina ya kipimo</label>
                            <select style="width:110px" class="d-block p-1" name="volume" id="volume">
                                @forelse ($mgando_volumes as $volume)
                                    <option value={{ $volume->price }}>{{ $volume->volume }}</option>
                                @empty
                                    <option value="">hakuna taarifa</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="my-2">
                            <label for="volume_price">bei</label><br>
                            <input style="border: 1px solid grey !important;border-radius: 4px; width: 110px;"
                                value={{ $mgando_volumes->count() > 0 ? $mgando_volumes[0]->price : 0 }} type="number"
                                id="volume_price" name="price" class="p-1 bg-app text-center" required>
                        </div>

                        <div id="volumeQuantityContainer" class="form-group">
                            <label for="volumeQuantity">idadi</label><br>
                            <input name="quantity" inputmode="numeric"
                                style="width: 110px;border: 1px solid grey !important" id="volumeQuantity" type="number"
                                min="0" class="bg-app btn" required>
                        </div>

                        <div id="volumeTotalAmountContainer" class="my-2">
                            <label for="volumeTotalAmount">Jumla ya malipo</label><br>
                            <input style="border: 1px solid grey !important;border-radius: 4px; width: 110px;" type="number"
                                min="0" id="volumeTotalAmount" name="amount" class="p-1 bg-app text-center" required>
                        </div>

                        <button style="width: 110px;" type="submit" class="btn text-center btn-app">Submit</button>
                    </form>
                </div>