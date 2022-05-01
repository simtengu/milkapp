                <div style="display: none" class="pt-5 my-2 my-md-5" id="chupa">
                    <h5 class="h4 py-3 text-app text-times">Mauzo kwa chupa</h5>
                    <form method="POST" action="{{ route('save_bottle_income') }}" class="form">
                        @csrf
                        <div class="form-group">
                            <label for="bottleMilkType">Aina ya maziwa</label>
                            <select style="width:110px" class="d-block p-1" name="milk_type" id="bottleMilkType">
                                <option selected value="mgando">mgando</option>
                                <option value="fresh">fresh</option>
                            </select>
                        </div>

                        <div id="bottle_capacity_container" class="form-group">
                            <label for="bottleCapacity">Aina ya chupa</label>
                            <select style="width:110px" class="d-block p-1" name="bottle_capacity" id="bottleCapacity">
                                @forelse ($mgando_bottles as $bottle)
                                    <option value={{ $bottle->price }}>{{ $bottle->capacity }}</option>
                                @empty
                                    <option value="">hakuna taarifa</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="my-2">
                            <label for="bottle_price">bei ya chupa</label><br>
                            <input style="border: 1px solid grey !important;border-radius: 4px; width: 110px;"
                                value={{ $mgando_bottles->count() > 0 ? $mgando_bottles[0]->price : 0 }} type="number"
                                id="bottle_price" name="price" class="p-1 bg-app text-center" required>
                        </div>

                        <div id="bottleQuantityContainer" class="form-group">
                            <label for="bottleQuantity">idadi ya chupa</label><br>
                            <input name="quantity" inputmode="numeric"
                                style="width: 110px;border: 1px solid grey !important" id="bottleQuantity" type="number"
                                min="0" class="bg-app btn" required>
                        </div>

                        <div id="bottleTotalAmountContainer" class="my-2">
                            <label for="bottleTotalAmount">Jumla ya malipo</label><br>
                            <input style="border: 1px solid grey !important;border-radius: 4px; width: 110px;" type="number"
                                min="0" id="bottleTotalAmount" name="amount" class="p-1 bg-app text-center" required>
                        </div>

                        <button style="width: 110px;" type="submit" class="btn text-center btn-app">Submit</button>
                    </form>
                </div>