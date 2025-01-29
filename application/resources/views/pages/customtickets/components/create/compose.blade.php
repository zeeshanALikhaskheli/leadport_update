

<form class="w-100 ticket-compose" method="post" id="ticket-compose" data-user-type="{{ auth()->user()->type }}">

        <div class="form-header d-flex mb-4">
           @if(isset($orderStatus)) 
            @foreach($orderStatus as $status)
            <span class="stepIndicator">{{ $status['Name'] }}</span>
            @endforeach
           @endif  

        </div>
       
          <div class="btn-group" role="group" aria-label="Basic example">
             @if(isset($transportChannels)) 
              @foreach($transportChannels as $tchannel)
                <button type="button" class="btn btn-outline-success" onclick="selectChannel({{ $tchannel['id'] }})"><i class="ti-sea"></i>{{ $tchannel['name'] }}</button>
              @endforeach
            @endif
            <input type="hidden" id="TransportChannelId" name="ticket_transport_channel_id">
          </div>
          <!-- form row one -->
            <div class="row mt-3">
                <div class="col-sm-6 col-lg-6 row_1">
                    <h5><i class="bi bi-exclamation-circle-fill"></i>General Information</h5>

                    <div class="row mt-3" >
                        <div class="col">
                            <label for="id" class="form-label fw-bold">Id</label>
                            <input type="text" class="form-control" placeholder="Id" aria-label="id" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="inputState " class="form-label fw-bold">Status</label>
                            @if(isset($orderStatus)) 
                            <select id="ShipmentOrderStatusId" class="form-control" name="ticket_status_id" onchange="changeStatus('ShipmentOrderStatusId')">
                               @foreach($orderStatus as $status)
                              <option value="{{ $status['id'] }}">{{ $status['name'] }}</option>
                               @endforeach
                            </select>
                            @endif
                          </div>
                        <div class="col">
                            <label for="inputState" class="form-label fw-bold">Type</label>
                            @if(isset($carriageType)) 
                            <select id="inputState" class="form-control" name="ticket_type_id">
                              @foreach($carriageType as $carriage)
                              <option value="{{ $carriage['id'] }}">{{ $carriage['name'] }}</option>
                              @endforeach
                            </select>
                            @endif
                          </div>
                      </div>
                      <div class="row mt-3" >
                        <div class="col-sm-6">
                            <label for="inputState " class="form-label fw-bold">Order Type</label>
                            @if(isset($orderTypes)) 
                            <select id="inputState" class="form-control" name="ticket_order_type_id">
                              @foreach($orderTypes as $type)
                              <option value="{{ $type['id'] }}">{{ $type['name'] }}</option>
                              @endforeach
                            </select>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <label for="inputState" class="form-label fw-bold">Incoterms</label>
                              @if(isset($incoterms)) 
                              <select id="inputState" class="form-control" name="ticket_incoterms_id">
                                @foreach($incoterms as $term)
                                <option value="{{ $term['id'] }}">{{ $term['name'] }}</option>
                                @endforeach
                              </select>
                              @endif
                          </div>
                      </div>
                      <div class="row mt-3" >
                        <div class="col-6">
                            <label for="inputState " class="form-label fw-bold">Load Type</label>
                            @if(isset($loadType)) 
                            <select id="inputState" class="form-control" name="ticket_loadtype_id">
                              @foreach($loadType as $load)
                              <option value="{{ $load['id'] }}">{{ $load['name'] }}</option>
                              @endforeach
                            </select>
                            @endif
                        </div>

                        <div class="col-6">
                            <label for="quantity" class="form-label fw-bold">Quantity</label>
                            <input type="text" class="form-control" name="quantity" placeholder="Quantity" aria-label="quantity">
                        </div>

                        <div class="col-6 mt-2">
                          <div class="form-group row">
                              <!-- Label for Assigned Users -->
                              <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">
                                  {{ cleanLang(__('lang.assigned')) }}
                              </label>
                              
                              <div class="col-sm-12 col-lg-9">
                                  <!-- Multi-select Dropdown for Assigning Users -->
                                  <select name="assigned[]" id="assigned"
                                      class="form-control form-control-sm select2-basic select2-multiple select2-tags select2-hidden-accessible"
                                      multiple="multiple" tabindex="-1" aria-hidden="true">
                      
                                      <!-- Pre-select Assigned Users (if editing) -->
                                      @if(isset($page['section']) && $page['section'] == 'edit' && isset($lead->assigned))
                                          @php
                                              // Create an array of assigned user IDs
                                              $assigned = collect($lead->assigned)->pluck('id')->toArray();
                                          @endphp
                                      @endif
                      
                                      <!-- Filtered Users List -->
                                      @foreach(config('system.team_members') as $user)
                                          @if($user->type === 'team' && $user->id !== Auth::user()->id) <!-- Filter by type and exclude logged-in user -->
                                              <option value="{{ $user->id }}" 
                                                  {{ runtimePreselectedInArray($user->id ?? '', $assigned ?? []) }}>
                                                  {{ $user->full_name }}
                                              </option>
                                          @endif
                                      @endforeach
                                      <!-- End of Filtered Users List -->
                                  </select>
                              </div>
                          </div>
                      </div>
                      
                      
                        
                     
                      </div>
                  </div>
                  <div class="col-sm-12 col-lg-6 mt-4 " >
                    <div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" frameborder="0" scrolling="off" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100vw&height=500&hl=en&q=nawabshah&t=&z=13&ie=UTF8&iwloc=B&output=embed"></iframe></div>
                    </div>
                  </div>
            </div>
        <!-- form row two -->
            <div class="row mt-3 "  >

              <div class=" col-sm-12 col-lg-6 " >
                  <h5><i class="bi bi-backpack-fill"></i>Shipper</h5>

                  <div class="row mt-3" >
                    
                    <div class="col">
                      <label for="shipper_date"  class="form-label fw-bold">Date</label>
                      <input type="date" class="form-control" id="shipper_date" name="shipping_date" placeholder="Date" aria-label="date">
                  </div>
                  <div class="col">
                    <label for="id" class="form-label fw-bold">Time</label>
                    <input type="time" class="form-control" name="shipping_time" placeholder="Id" aria-label="time">
                </div>
                    </div>
                    <div class="row mt-3" >
                      <div class="col-12">
                          <label for="shipper" class="form-label fw-bold">Shipper</label>
                          <input type="text" class="form-control" placeholder="Add Shipper" name="shipper_name" aria-label="shipper">
                        </div>
                    </div>
                    <div class="row mt-3" >
                      <div class="col">
                        <label for="country" class="form-label fw-bold">Country </label>
                          @if(isset($countries) && count($countries) > 0)
                               <select class="form-control" name="shipping_country_id">
                                  @foreach($countries as $country)
                                    <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                                  @endforeach
                              </select>
                            @endif                     
                      </div>
                    <div class="col">
                      <label for="City" class="form-label fw-bold">City</label>
                      <input type="text" class="form-control" placeholder="City" name="shipping_city" aria-label="City" onkeypress="initAutocomplete('pickup_city')" id="pickup_city">
                  </div>
                      <div class="col-sm-12 col-lg-6">
                        <label for="country" class="form-label fw-bold">Index </label>
                        <input type="number" class="form-control" placeholder="Add index" name="shipping_index" aria-label="country">
                        </div>

                          <div class="col-12 mt-3">
                            <label for="Address" class="form-label fw-bold">Address </label>
                            <input type="text" class="form-control" placeholder="Address" name="shipping_address" aria-label="Address" onkeypress="initAutocomplete('pickup_address')" id="pickup_address">
                            <input type="hidden" name="origin" id="origin">
                          </div>


                            <div id="pickup-container" class="col-12 mt-3 pickup">
                            <i class="mdi mdi-plus-circle-outline text-success font-28" onclick="addPickupField('pickupRemarks')"></i>
                            <br>
                            <label for="Pickup Remark" class="form-label fw-bold">Pickup Remark</label>
                            <div id="pickupRemarks">
                                <!-- Existing delivery field -->
                                <div class="pickupRemarks">
                                    <input type="text" class="form-control pickup" name="pickupRemarks[0]" placeholder="pickupRemarks" aria-label="Pickup Remark">
                                    <i class="sl-icon-trash custom" onclick="removeField(this)"></i>
                                </div>
                            </div>
                        </div>

                          <div class="col-12">
                            <div class="toggle-outer">
                              <div class="toggle-inner">
                                  <input type="checkbox" id="toggle" name="def_shipping">
                              </div>
                          </div>
                          <label id="toggleLabel toggleLabel1" for="toggle">
                              Different pickup
                          </label>
                          <div id="result">
                            <div class="row mt-3" >
                              <div class="col-12">
                                  <label for="alt_shipper" class="form-label fw-bold">Shipper</label>
                                  <input type="text" class="form-control" placeholder="Add Shipper" name="def_shipper_name" aria-label="alt_shipper">
                              </div>
                            </div>

                          <div class="row mt-3">
                            <div class="col">
                              <label for="country" class="form-label fw-bold">Country</label>
                                @if(isset($countries) && count($countries) > 0)
                                  <select class="form-control" name="def_shipping_country_id">
                                      @foreach($countries as $country)
                                        <option value="{{ $country['name'] }}">{{ $country['name'] }}</option>
                                      @endforeach
                                  </select>
                                @endif  
                          </div>
                          <div class="col">
                            <label for="City" class="form-label fw-bold">City</label>
                            <input type="text" class="form-control" name="def_shipping_city" placeholder="City" aria-label="City" onkeypress="initAutocomplete('dif_pickup_city')" id="dif_pickup_city">
                        </div>
                            <div class="col-sm-12 col-lg-6">
                              <label for="index" class="form-label fw-bold">Index </label>
                              <input type="text" class="form-control" name="def_shipping_index" placeholder="Add index" aria-label="index">
                              </div>
                            </div>
                            <div class="mt-3">
                              <label for="Address" class="form-label fw-bold">Address </label>
                              <input type="text" class="form-control" name="def_shipping_address" placeholder="Address" aria-label="Address" onkeypress="initAutocomplete('dif_pickup_address')" id="dif_pickup_address">
                            </div>
                          </div>
                        </div>   
                          
                    
                    </div>
                </div>

<!-- form row three -->


                <div class="col-sm-12 col-lg-6">

                  <h5><i class="bi bi-geo-alt-fill"></i> Consignee </h5>

                  <div class="row mt-3" >
                    <div class="col">
                      <label for="consignee_date" class="form-label fw-bold">Date</label>
                      <input type="date" class="form-control" id="consignee_date" name="delivery_date" placeholder="Date" aria-label="date">
                  </div>
                  <div class="col">
                    <label for="id" class="form-label fw-bold">Time</label>
                    <input type="time" class="form-control" placeholder="Id" name="delivery_time" aria-label="time">
                </div>
                </div>
                
                    <div class="row mt-3" >
                      <div class="col">
                        <label for="consignee" class="form-label fw-bold">Consignee</label>
                        <input type="text" class="form-control" placeholder="Add Consignee" name="consignee_name" aria-label="consignee">
                    </div>
                      
                    <div class="row mt-3">

                        <div class="col">
                          <label for="country" class="form-label fw-bold">Country</label>
                             @if(isset($countries) && count($countries) > 0)
                                  <select class="form-control" name="delivery_country_id">
                                      @foreach($countries as $country)
                                        <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                                      @endforeach
                                  </select>
                                @endif               
                        </div>

                        <div class="col">
                          <label for="City" class="form-label fw-bold">City</label>
                        <input type="text" class="form-control" placeholder="City" name="delivery_city" aria-label="City" onkeypress="initAutocomplete('delivery')" id="delivery">
                      </div>
                      
                        <div class="col-sm-12 col-lg-6">
                        <label for="country" class="form-label fw-bold">Index</label>
                        <input type="number" class="form-control" placeholder="Add index" name="delivery_index" aria-label="country">
                        </div>
                        
                          <div class="col-12 mt-3">
                            <label for="Address" class="form-label fw-bold">Address</label>
                            <input type="text" class="form-control" placeholder="Address" name="delivery_address" aria-label="Address" onkeypress="initAutocomplete('delivery_address')" id="delivery_address">
                            <input type="hidden" name="destination" id="destination">
                          </div>

                          <div id="delivery-container" class="col-12 mt-3 delivery">
                            <i class="mdi mdi-plus-circle-outline text-success font-28" onclick="addRemarksField('deliveryRemarks')"></i>
                            <br>
                            <label for="Delivery Remark" class="form-label fw-bold">Delivery Remark</label>
                            <div id="deliveryRemarks">
                                <!-- Existing delivery field -->
                                <div class="deliveryRemarks">
                                    <input type="text" class="form-control delivery" name="deliveryRemarks[0]" placeholder="deliveryRemarks" aria-label="Delivery Remark">
                                    <i class="sl-icon-trash custom" onclick="removeField(this)"></i>
                                </div>
                            </div>
                        </div>
                       
                          <div class="col-12">
                            <div class="toggle-outer2">
                              <div class="toggle-inner">
                                  <input type="checkbox" id="toggle2" name="def_delivery">
                              </div>
                          </div>
                          <label id="toggleLabel toggleLabel2" for="toggle">
                              Different Delivery
                          </label>
                          <div id="result2">
                            <div class="row mt-3" >
                              <div class="col-12">
                                  <label for="alt_delivery" class="form-label fw-bold">Delivery</label>
                                  <input type="text" class="form-control" placeholder="Add Delivery" name="def_delivery_name" aria-label="alt_delivery">
                              </div>
                            </div>

                            <div class="row mt-3" >
                            <div class="col">
                              <label for="country" class="form-label fw-bold">Country </label>
                                 @if(isset($countries) && count($countries) > 0)
                                  <select class="form-control" name="def_delivery_country_id">
                                      @foreach($countries as $country)
                                        <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                                      @endforeach
                                  </select>
                                @endif 
                            </div>
                          <div class="col">
                            <label for="City" class="form-label fw-bold">City</label>
           
                            <input type="text" class="form-control" placeholder="City" name="def_delivery_city" aria-label="City" onkeypress="initAutocomplete('dif_delivery')" id="dif_delivery">
                        </div>
                            <div class="col-sm-12 col-lg-6">
                              <label for="index" class="form-label fw-bold">Index </label>
                              <input type="text" class="form-control" placeholder="Add index" name="def_delivery_index" aria-label="index">
                              </div>
                            </div>
                            <div class="mt-3">
                              <label for="Address" class="form-label fw-bold">Address </label>
                              <input type="text" class="form-control" placeholder="Address" name="def_delivery_address" aria-label="Address">
                            </div>

                          </div>
                        </div>  
                    
                    </div>
                  
                </div>
            </div>
          </div>

      <!-- form row four -->
            <div class="row mt-3">
                        <div class="col-sm-4 col-lg-2">
                        <label for="temp" class="form-label fw-bold">Temp Sensitive</label>
                        <select class="form-control" name="temp_sensitive">
                              <option value="yes">Yes</option>
                              <option value="no">No</option>
                        </select>
                    </div>
                    <div class="col-sm-4 col-lg-2">
                        <label for="range" class="form-label fw-bold">Temp Range</label>
                        <input type="text" class="form-control" name="temp_range" placeholder="Type Range here" aria-label="range">
                    </div>
                    <div class="col-sm-4 col-lg-2">
                    <label for="adr" class="form-label fw-bold">ADR</label>
                    <select class="form-control" name="adr">
                          <option value="yes">Yes</option>
                          <option value="no">No</option>
                      </select>
                </div>
                <div class="col-sm-4 col-lg-2">
                    <label for="code" class="form-label fw-bold">UN Code</label>
                    <input type="text" class="form-control" name="un_code" placeholder="Type UN code here" aria-label="code">
                </div>
                <div class="col-sm-4 col-lg-2">
                <label for="fragile" class="form-label fw-bold">Fragile</label>
                <select class="form-control" name="fragile">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
            <div class="col-sm-4 col-lg-2">
                <label for="notes" class="form-label fw-bold">Notes</label>
            <input type="text" class="form-control" name="notes" placeholder="About Notes" aria-label="notes">
            </div>
             @include('pages.customticket.components.misc.goods')
          </div>
          
          <div class="row mt-3">
            <label for="notes" class="form-label fw-bold">Chargeable Weight Total</label>
          </div>
          <div class="row mt-2"> <!-- Optional mt-2 for margin -->
              <input type="number" class="form-control" name="chargeable_weight_total" placeholder="Chargeable Weight Total" id="ChargeableWeightTotal">
          </div>
                      
          <div class="text-lg-right">
              <button type="submit" class="btn btn-rounded-x btn-success m-t-20 ajax-request"
              id="ticket-compose-form-button" data-url="{{ url('ctickets/store') }}" data-type="form"
              data-ajax-type="post" data-loading-overlay-target="wrapper-tickets"
              data-loading-overlay-classname="overlay"
              data-form-id="ticket-compose">{{ cleanLang(__('lang.submit_ticket')) }}</button>
          </div>
          
</form>
