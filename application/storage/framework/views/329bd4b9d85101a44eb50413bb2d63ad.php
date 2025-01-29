
<form class="w-100 ticket-compose" method="post" id="ticket-compose" data-user-type="<?php echo e(auth()->user()->type); ?>">
        <div class="form-header d-flex mb-4">
           <?php if(isset($orderStatus)): ?> 
            <?php $__currentLoopData = $orderStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span class="stepIndicator"><?php echo e($status['name']); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           <?php endif; ?>  
        </div>
          <div class="btn-group" role="group" aria-label="Basic example">
             <?php if(isset($transportChannels)): ?> 
              <?php $__currentLoopData = $transportChannels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tchannel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button type="button" class="btn btn-outline-success <?php echo e(($tchannel['id'] ==  $ticket['ticket_transport_channel_id']) ? 'active' : ''); ?>" onclick="selectChannel(<?php echo e($tchannel['id']); ?>)"><i class="ti-sea"></i><?php echo e($tchannel['name']); ?></button>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <input type="hidden" id="TransportChannelId" name="ticket_transport_channel_id">
          </div>
          <!-- form row one -->
            <div class="row mt-3">
                <div class="col-sm-6 col-lg-6 row_1">
                    <h5><i class="bi bi-exclamation-circle-fill"></i>General Information</h5>

                    <div class="row mt-3" >
                        <div class="col">
                            <label for="id" class="form-label fw-bold">Id</label>
                          <input type="text" class="form-control" placeholder="Id" aria-label="id" disabled value="<?php echo e($ticket['id']); ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="inputState " class="form-label fw-bold">Status</label>
                            <?php if(isset($orderStatus)): ?> 
                            <select id="ticket_status_id" class="form-control" name="ticket_status_id" onchange="changeStatus('ticket_status_id')">
                               <?php $__currentLoopData = $orderStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($status['id']); ?>" <?php echo e(runtimePreselected($status['id'] ?? '', $ticket['ticket_status_id'])); ?>><?php echo e($status['name']); ?></option>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php endif; ?>
                          </div>
                        <div class="col">
                            <label for="inputState" class="form-label fw-bold">Type</label>
                            <?php if(isset($carriageType)): ?> 
                            <select id="inputState" class="form-control" name="ticket_type_id">
                              <?php $__currentLoopData = $carriageType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $carriage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($carriage['id']); ?>" <?php echo e(runtimePreselected($carriage['id'] ?? '', $ticket['ticket_type_id'])); ?>><?php echo e($carriage['name']); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php endif; ?>
                          </div>
                      </div>
                      <div class="row mt-3" >
                        <div class="col-sm-6">
                            <label for="inputState " class="form-label fw-bold">Order Type</label>
                            <?php if(isset($orderTypes)): ?> 
                            <select id="inputState" class="form-control" name="ticket_order_type_id">
                              <?php $__currentLoopData = $orderTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($type['id']); ?>" <?php echo e(runtimePreselected($type['id'] ?? '', $ticket['ticket_order_type_id'])); ?>><?php echo e($type['name']); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php endif; ?>
                        </div>   
                        <div class="col-sm-6">
                            <label for="inputState" class="form-label fw-bold">Incoterms</label>
                              <?php if(isset($incoterms)): ?> 
                              <select id="inputState" class="form-control" name="ticket_incoterms_id">
                                <?php $__currentLoopData = $incoterms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($term['id']); ?>" <?php echo e(runtimePreselected($term['id'] ?? '', $ticket['ticket_incoterms_id'])); ?>><?php echo e($term['name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                              <?php endif; ?>
                         </div>
                      </div> 
                      <div class="row mt-3" >
                        <div class="col-6">
                            <label for="inputState " class="form-label fw-bold">Load Type</label>
                            <?php if(isset($loadType)): ?> 
                            <select id="inputState" class="form-control" name="ticket_loadtype_id">
                              <?php $__currentLoopData = $loadType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $load): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($load['id']); ?>" <?php echo e(runtimePreselected($load['id'] ?? '', $ticket['ticket_loadtype_id'])); ?>><?php echo e($load['name']); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php endif; ?>
                          </div>

                        <div class="col-6">
                            <label for="quantity" class="form-label fw-bold">Quantity</label>
                            <input type="text" class="form-control" name="quantity" placeholder="Quantity" aria-label="quantity" value="<?php echo e($ticket['quantity']); ?>">
                        </div>

                        <div class="col-6 mt-2">
                          <div class="form-group row">
                              <!-- Label for Assigned Users -->
                              <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">
                                  <?php echo e(cleanLang(__('lang.assigned'))); ?>

                              </label>
                              
                              <div class="col-sm-12 col-lg-9">
                                  <!-- Multi-select Dropdown for Assigning Users -->
                                  <select name="assigned[]" id="assigned"
                                      class="form-control form-control-sm select2-basic select2-multiple select2-tags select2-hidden-accessible"
                                      multiple="multiple" tabindex="-1" aria-hidden="true">
                      
                                      <!-- Pre-select Assigned Users (if editing) -->
                                      <?php if(isset($page['section']) && $page['section'] == 'edit' && isset($lead->assigned)): ?>
                                          <?php
                                              // Create an array of assigned user IDs
                                              $assigned = collect($lead->assigned)->pluck('id')->toArray();
                                          ?>
                                      <?php endif; ?>
                      
                                      <!-- Filtered Users List -->
                                      <?php $__currentLoopData = config('system.team_members'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <?php if($user->type === 'team' && $user->id !== Auth::user()->id): ?> <!-- Filter by type and exclude logged-in user -->
                                              <option value="<?php echo e($user->id); ?>" 
                                                  <?php echo e(runtimePreselectedInArray($user->id ?? '', $assigned ?? [])); ?>>
                                                  <?php echo e($user->full_name); ?>

                                              </option>
                                          <?php endif; ?>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <!-- End of Filtered Users List -->
                                  </select>
                              </div>
                          </div>
                      </div>
                      
                           
                      </div>
                  </div>
                  <div class="col-sm-12 col-lg-6 mt-4">
                    <div id="map" class="gmap_iframe">
                    </div>
                    <input type="hidden" id="pickupLocation"   name="origin"         value="<?php echo e(json_encode($ticket['origin'])); ?>">
                    <input type="hidden" id="deliveryLocation" name="destination"    value="<?php echo e(json_encode($ticket['destination'])); ?>">
                  </div>
            </div>
        <!-- form row two -->
            <div class="row mt-3 "  >

              <div class=" col-sm-12 col-lg-6">
                  <h5><i class="bi bi-backpack-fill"></i>Shipper</h5>

                  <div class="row mt-3" >
                    
                    <div class="col">
                      <label for="shipper_date"  class="form-label fw-bold">Date</label>
                      <input type="date" class="form-control" id="shipper_date" name="shipping_date" placeholder="Date" aria-label="date" value="<?php echo e($ticket['shipping_date']); ?>">
                  </div>
                  <div class="col">
                    <label for="id" class="form-label fw-bold">Time</label>
                    <input type="time" class="form-control" name="shipping_time" placeholder="Id" aria-label="time" value="<?php echo e($ticket['shipping_time']); ?>">
                </div>
                    </div>
                    <div class="row mt-3" >
                      <div class="col-12">
                          <label for="shipper" class="form-label fw-bold">Shipper</label>
                          <input type="text" class="form-control" placeholder="Add Shipper" name="shipper_name" aria-label="shipper" value="<?php echo e($ticket['shipper_name']); ?>">
                        </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col">
                        <label for="country" class="form-label fw-bold">Country </label>
                          <?php if(isset($countries) && count($countries) > 0): ?>
                               <select class="form-control" name="shipping_country_id">
                                  <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($country['id']); ?>" <?php echo e(runtimePreselected($country['id'] ?? '', $ticket['shipping_country_id'])); ?>><?php echo e($country['name']); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                            <?php endif; ?>                     
                      </div>
                    <div class="col">
                      <label for="City" class="form-label fw-bold">City</label>
                      <input type="text" class="form-control" placeholder="City" name="shipping_city" aria-label="City" value="<?php echo e($ticket['shipping_city']); ?>" onkeypress="initAutocomplete('pickup_city')" id="pickup_city">
                  </div>
                      <div class="col-sm-12 col-lg-6">
                        <label for="country" class="form-label fw-bold">Index </label>
                        <input type="number" class="form-control" placeholder="Add index" name="shipping_index" aria-label="country" value="<?php echo e($ticket['shipping_index']); ?>">
                        </div>

                          <div class="col-12 mt-3">
                            <label for="Address" class="form-label fw-bold">Address </label>
                            <input type="text" class="form-control" placeholder="Address" name="shipping_address" value="<?php echo e($ticket['shipping_address']); ?>" aria-label="Address" onkeypress="initAutocomplete('pickup_address')" id="pickup_address">
                            <input type="hidden" name="origin" id="origin">
                          </div>


                            <div id="pickup-container" class="col-12 mt-3 pickup">
                            <i class="mdi mdi-plus-circle-outline text-success font-28" onclick="addPickupField('pickupRemarks')"></i>
                            <br>
                            <label for="Pickup Remark" class="form-label fw-bold">Pickup Remark</label>
                            <div id="pickupRemarks">
                                <!-- Existing delivery field -->
                                 <?php if(isset($ticket['pickupRemarks']) && count($ticket['pickupRemarks']) > 0): ?>
                                    <?php $__currentLoopData = $ticket['pickupRemarks']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $remark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="pickupRemarks mt-3">
                                    <input type="text" class="form-control pickup" name="pickupRemarks[<?php echo e($key); ?>]" placeholder="pickupRemarks" value="<?php echo e($remark); ?>" aria-label="Pickup Remark">
                                    <i class="sl-icon-trash custom" onclick="removeField(this)"></i>
                                </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                    <div class="pickupRemarks">
                                    <input type="text" class="form-control pickup" name="pickupRemarks[0]" placeholder="pickupRemarks" aria-label="Pickup Remark">
                                    <i class="sl-icon-trash custom" onclick="removeField(this)"></i>
                                </div>
                                 <?php endif; ?>
                                <input type="hidden" id="pickupCount" value="<?php echo e(count($ticket['pickupRemarks'])); ?>">
                            </div>
                        </div>

                          <div class="col-12">
                            <div class="toggle-outer">
                              <div class="toggle-inner">
                                  <input type="checkbox" id="toggle" name="def_shipping" value="<?php echo e($ticket['def_shipping']); ?>">
                              </div>
                          </div>
                          <label id="toggleLabel toggleLabel1" for="toggle">
                              Different pickup
                          </label>
                          <div id="result">
                            <div class="row mt-3" >
                              <div class="col-12">
                                  <label for="alt_shipper" class="form-label fw-bold">Shipper</label>
                                  <input type="text" class="form-control" placeholder="Add Shipper" name="def_shipper_name" value="<?php echo e($ticket['def_shipper_name']); ?>" aria-label="alt_shipper">
                              </div>
                            </div>

                          <div class="row mt-3">
                            <div class="col">
                              <label for="country" class="form-label fw-bold">Country</label>
                                <?php if(isset($countries) && count($countries) > 0): ?>
                                  <select class="form-control" name="def_shipping_country_id">
                                      <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($country['id']); ?>" <?php echo e(runtimePreselected($country['id'] ?? '', $ticket['def_shipping_country_id'])); ?>><?php echo e($country['name']); ?></option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </select>
                                <?php endif; ?>  
                          </div>
                          <div class="col">
                            <label for="City" class="form-label fw-bold">City</label>
                            <input type="text" class="form-control" name="def_shipping_city" placeholder="City" value="<?php echo e($ticket['def_shipping_city']); ?>" aria-label="City" onkeypress="initAutocomplete('dif_pickup_city')" id="dif_pickup_city">
                        </div>
                            <div class="col-sm-12 col-lg-6">
                              <label for="index" class="form-label fw-bold">Index </label>
                              <input type="number" class="form-control" name="def_shipping_index" placeholder="Add index" value="<?php echo e($ticket['def_shipping_index']); ?>" aria-label="index">
                              </div>
                            </div>
                            <div class="mt-3">
                              <label for="Address" class="form-label fw-bold">Address </label>
                              <input type="text" class="form-control" name="def_shipping_address" placeholder="Address" value="<?php echo e($ticket['def_shipping_address']); ?>" aria-label="Address" onkeypress="initAutocomplete('dif_pickup_address')" id="dif_pickup_address">
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
                      <input type="date" class="form-control" id="consignee_date" name="delivery_date" value="<?php echo e($ticket['delivery_date']); ?>" placeholder="Date" aria-label="date">
                  </div>
                  <div class="col">
                    <label for="id" class="form-label fw-bold">Time</label>
                    <input type="time" class="form-control" placeholder="Id" name="delivery_time" aria-label="time" value="<?php echo e($ticket['delivery_time']); ?>">
                </div>
                </div>
                
                    <div class="row mt-3" >
                      <div class="col">
                        <label for="consignee" class="form-label fw-bold">Consignee</label>
                        <input type="text" class="form-control" placeholder="Add Consignee" name="consignee_name" value="<?php echo e($ticket['consignee_name']); ?>" aria-label="consignee">
                    </div>
                      
                    <div class="row mt-3">

                        <div class="col">
                          <label for="country" class="form-label fw-bold">Country</label>
                             <?php if(isset($countries) && count($countries) > 0): ?>
                                  <select class="form-control" name="delivery_country_id">
                                      <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($country['id']); ?>" <?php echo e(runtimePreselected($country['id'] ?? '', $ticket['delivery_country_id'])); ?>><?php echo e($country['name']); ?></option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </select>
                                <?php endif; ?>  
                        </div>

                        <div class="col">
                          <label for="City" class="form-label fw-bold">City</label>
                        <input type="text" class="form-control" placeholder="City" name="delivery_city" value="<?php echo e($ticket['delivery_city']); ?>" aria-label="City" onkeypress="initAutocomplete('delivery')" id="delivery">
                      </div>
                      
                        <div class="col-sm-12 col-lg-6">
                        <label for="country" class="form-label fw-bold">Index</label>
                        <input type="number" class="form-control" placeholder="Add index" name="delivery_index" value="<?php echo e($ticket['delivery_index']); ?>" aria-label="country">
                        </div>
                        
                          <div class="col-12 mt-3">
                            <label for="Address" class="form-label fw-bold">Address</label>
                            <input type="text" class="form-control" placeholder="Address" name="delivery_address" value="<?php echo e($ticket['delivery_address']); ?>" aria-label="Address" onkeypress="initAutocomplete('delivery_address')" id="delivery_address">
                            <input type="hidden" name="destination" id="destination">
                          </div>

                          <div id="delivery-container" class="col-12 mt-3 delivery">
                            <i class="mdi mdi-plus-circle-outline text-success font-28" onclick="addRemarksField('deliveryRemarks')"></i>
                            <br>
                            <label for="Delivery Remark" class="form-label fw-bold">Delivery Remark</label>
                            <div id="deliveryRemarks">
                                <!-- Existing delivery field -->

                                <?php if(isset($ticket['deliveryRemarks']) && count($ticket['deliveryRemarks']) > 0): ?>
                                    <?php $__currentLoopData = $ticket['deliveryRemarks']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $remark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="deliveryRemarks mt-3">
                                    <input type="text" class="form-control delivery" name="deliveryRemarks[<?php echo e($key); ?>]" placeholder="deliveryRemarks" value="<?php echo e($remark); ?>" aria-label="Delivery Remark">
                                    <i class="sl-icon-trash custom" onclick="removeField(this)"></i>
                                </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                    <div class="deliveryRemarks">
                                    <input type="text" class="form-control delivery" name="deliveryRemarks[0]" placeholder="deliveryRemarks" aria-label="Delivery Remark">
                                    <i class="sl-icon-trash custom" onclick="removeField(this)"></i>
                                </div>
                                 <?php endif; ?>
                                 <input type="hidden" id="deliveryCount" value="<?php echo e(count($ticket['deliveryRemarks'])); ?>">
                            </div>
                        </div>
                       
                          <div class="col-12">
                            <div class="toggle-outer2">
                              <div class="toggle-inner">
                                  <input type="checkbox" id="toggle2" name="def_delivery" value="<?php echo e($ticket['def_delivery']); ?>">
                              </div>
                          </div>
                          <label id="toggleLabel toggleLabel2" for="toggle">
                              Different Delivery
                          </label>
                          <div id="result2">
                            <div class="row mt-3" >
                              <div class="col-12">
                                  <label for="alt_delivery" class="form-label fw-bold">Delivery</label>
                                  <input type="text" class="form-control" placeholder="Add Delivery" name="def_delivery_name" value="<?php echo e($ticket['def_delivery_name']); ?>" aria-label="alt_delivery">
                              </div>
                            </div>

                            <div class="row mt-3" >
                            <div class="col">
                              <label for="country" class="form-label fw-bold">Country </label>
                                 <?php if(isset($countries) && count($countries) > 0): ?>
                                  <select class="form-control" name="def_delivery_country_id">
                                      <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($country['id']); ?>" <?php echo e(runtimePreselected($country['id'] ?? '', $ticket['def_delivery_country_id'])); ?>><?php echo e($country['name']); ?></option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </select>
                                <?php endif; ?> 
                            </div>
                          <div class="col">
                            <label for="City" class="form-label fw-bold">City</label>
           
                            <input type="text" class="form-control" placeholder="City" name="def_delivery_city" value="<?php echo e($ticket['def_delivery_city']); ?>" aria-label="City" onkeypress="initAutocomplete('dif_delivery')" id="dif_delivery">
                        </div>
                            <div class="col-sm-12 col-lg-6">
                              <label for="index" class="form-label fw-bold">Index </label>
                              <input type="number" class="form-control" placeholder="Add index" name="def_delivery_index" value="<?php echo e($ticket['def_delivery_index']); ?>" aria-label="index">
                              </div>
                            </div>
                            <div class="mt-3">
                              <label for="Address" class="form-label fw-bold">Address </label>
                              <input type="text" class="form-control" placeholder="Address" name="def_delivery_address" value="<?php echo e($ticket['def_delivery_address']); ?>" aria-label="Address">
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
                        <option value="yes" <?php echo e(isset($ticket['temp_sensitive']) && $ticket['temp_sensitive'] == 'yes' ? 'selected' : ''); ?>>Yes</option>
                        <option value="no" <?php echo e(isset($ticket['temp_sensitive']) && $ticket['temp_sensitive'] == 'no' ? 'selected' : ''); ?>>No</option>
                        </select>
                    
                      </div>
                    <div class="col-sm-4 col-lg-2">
                        <label for="range" class="form-label fw-bold">Temp Range</label>
                        <input type="text" class="form-control" name="temp_range" placeholder="Type Range here" value="<?php echo e($ticket['temp_range']); ?>" aria-label="range">
                    </div>
                    <div class="col-sm-4 col-lg-2">
                    <label for="adr" class="form-label fw-bold">ADR</label>
                    <select class="form-control" name="adr">
                        <option value="yes" <?php echo e(isset($ticket['adr']) && $ticket['adr'] == 'yes' ? 'selected' : ''); ?>>Yes</option>
                        <option value="no" <?php echo e(isset($ticket['adr']) && $ticket['adr'] == 'no' ? 'selected' : ''); ?>>No</option>
                    </select>
                </div>
                <div class="col-sm-4 col-lg-2">
                    <label for="code" class="form-label fw-bold">UN Code</label>
                    <input type="text" class="form-control" name="un_code" placeholder="Type UN code here" value="<?php echo e($ticket['un_code']); ?>" aria-label="code">
                </div>
                <div class="col-sm-4 col-lg-2">
                <label for="fragile" class="form-label fw-bold">Fragile</label>
                    <select class="form-control" name="fragile">
                        <option value="yes" <?php echo e(isset($ticket['fragile']) && $ticket['fragile'] == 'yes' ? 'selected' : ''); ?>>Yes</option>
                        <option value="no" <?php echo e(isset($ticket['fragile']) && $ticket['fragile'] == 'no' ? 'selected' : ''); ?>>No</option>
                    </select>
            </div>
            <div class="col-sm-4 col-lg-2">
                <label for="notes" class="form-label fw-bold">Notes</label>
            <input type="text" class="form-control" name="notes" placeholder="About Notes" value="<?php echo e($ticket['notes']); ?>"  aria-label="notes">
            </div>

             <?php echo $__env->make('pages.customticket.components.misc.edit-goods', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
          </div>
          
          <div class="row mt-3">
            <label for="notes" class="form-label fw-bold">Chargeable Weight Total</label>
          </div>
          <div class="row mt-2"> <!-- Optional mt-2 for margin -->
              <input type="number" class="form-control" name="chargeable_weight_total" placeholder="Chargeable Weight Total" value="<?php echo e($ticket['chargeable_weight_total']); ?>" aria-label="notes" id="ChargeableWeightTotal">
          </div>

         
                            <!-- <div class="form-group">
                                <textarea class="tinymce-textarea" name="ticket_message" id="ticket_message"
                                    rows="15"></textarea>
                            </div> -->
                            <!--fileupload-->
                            <!-- <div class="form-group row">
                                <div class="col-12">
                                    <div class="dropzone dz-clickable" id="fileupload_ticket">
                                        <div class="dz-default dz-message">
                                            <i class="icon-Upload-toCloud"></i>
                                            <span><?php echo e(cleanLang(__('lang.drag_drop_file'))); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!--fileupload-->
                            <div class="text-lg-right">
                                <button type="submit" class="btn btn-rounded-x btn-success m-t-20 ajax-request"
                                    id="ticket-compose-form-button" data-url="<?php echo e(url('/ctickets/'.$ticket['id'].'/update-details')); ?>" data-type="form"
                                    data-ajax-type="post" data-loading-overlay-target="wrapper-tickets"
                                    data-loading-overlay-classname="overlay"
                                    data-form-id="ticket-compose"><?php echo e(cleanLang(__('lang.update'))); ?></button>
                                    
                                    <?php if(isset($ticket['id'])): ?>
                                    <button type="submit" class="btn btn-rounded-x btn-success m-t-20 ajax-request" id="convart_to_lead"
                                          data-url="<?php echo e(url('/ctickets/'.$ticket['id'].'/convartToLead')); ?>" data-type="form" data-ajax-type="post"
                                          <?php echo e(isset($ticket['is_lead_convarted']) && $ticket['is_lead_convarted'] ? 'disabled' : ''); ?>>
                                      <?php echo e(cleanLang(__('lang.convart_to_lead'))); ?>

                                    </button>
                                    <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    var pickupdata   = JSON.parse(document.getElementById("pickupLocation").value);
    var deliverydata = JSON.parse(document.getElementById("deliveryLocation").value);
    const pickupLocation   = { lat: pickupdata.lat,   lng: pickupdata.lng }; 
    const deliveryLocation = { lat: deliverydata.lat, lng: deliverydata.lng };
    
    function initMap() {
            // Create a map centered at the midpoint between pickup and delivery locations
            const mapCenter = {
                lat: (pickupLocation.lat + deliveryLocation.lat) / 2,
                lng: (pickupLocation.lng + deliveryLocation.lng) / 2
            };

            const map = new google.maps.Map(document.getElementById('map'), {
                zoom: 5,
                center: mapCenter
            });

            // Add a marker for pickup location
            new google.maps.Marker({
                position: pickupLocation,
                map: map,
                title: 'Pickup Location'
            });

            // Add a marker for delivery location
            new google.maps.Marker({
                position: deliveryLocation,
                map: map,
                title: 'Delivery Location'
            });

            // Optional: Draw a line between pickup and delivery locations
            const flightPath = new google.maps.Polyline({
                path: [pickupLocation, deliveryLocation],
                geodesic: true,
                strokeColor: '#FF0000',
                strokeOpacity: 1.0,
                strokeWeight: 2
            });

            flightPath.setMap(map);
    }

  function setHiddenFields() {
    const updates = [
        { selectId: 'orderType', hiddenId: 'OrderType' },
        { selectId: 'incoterms', hiddenId: 'Incoterms' },
        { selectId: 'loadType', hiddenId: 'LoadType' },
        { selectId: 'shipperCountry', hiddenId: 'ShipperCountry' },
        { selectId: 'consigneeCountry', hiddenId: 'ConsigneeCountry' }
    ];

    updates.forEach(({ selectId, hiddenId }) => {
        const selectElement = document.getElementById(selectId);
        const hiddenInput = document.getElementById(hiddenId);
        hiddenInput.value = selectElement.options[selectElement.selectedIndex].text;
    });
}

  window.onload = setHiddenFields;

 

</script>
<?php /**PATH C:\xampp\htdocs\leadport\application\resources\views/pages/customticket/components/edit.blade.php ENDPATH**/ ?>