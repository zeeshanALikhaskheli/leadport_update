
<div class="x-heading p-t-10"><i class="mdi mdi-file-document-box"></i>{{ cleanLang(__('lang.request_details')) }} <strong style='color:#00b388'> {{$task->send_to_docport  ? '(Convarted to Docport)' : ' '}}</strong></div>
<!--Form Data-->
<div class="card-show-form-data" id="card-task-organisation">
@if($task) 
<div class="form-row">
  <div class="form-group col-sm12">
  <span class="custom-text">Transport Type :
  <div class="vYiyP7">
<button type="button"  disabled id="air" class=" {{ ($task->task_custom_field_1 == 'air') ? 'active-transport' : ''}}"><i class='fas fa-plane-departure'></i> <span id="transport">Air</span></button>
<button type="button"  disabled  id="sea" class="{{ ($task->task_custom_field_1 == 'sea') ? 'active-transport' : ''}}">
<svg width="13" height="11" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#ship_svg__clip0_2179_41532)" fill="#08F">
<path d="M10.078 1.97v2.873l-1.26-.422V2.626h-5.04V4.42l-1.26.422V1.97a.67.67 0 01.185-.464.617.617 0 01.446-.193h1.26v-.82c0-.13.05-.256.138-.348A.463.463 0 014.88.001h2.835c.125 0 .245.052.334.144a.503.503 0 01.138.348v.82h1.26c.167 0 .328.07.446.193a.67.67 0 01.184.464z"></path><path d="M12.6 9.68v.328c0 .13-.05.256-.139.348a.463.463 0 01-.334.145c-1.2 0-2.116-.423-2.82-1.219-.143.36-.385.669-.696.885a1.84 1.84 0 01-1.051.334H5.04a1.84 1.84 0 01-1.05-.334 1.956 1.956 0 01-.697-.885c-.704.796-1.62 1.219-2.82 1.219a.463.463 0 01-.335-.145.503.503 0 01-.138-.348V9.68c0-.13.05-.255.138-.348a.463.463 0 01.334-.144c1.213 0 2.005-.65 2.35-1.545L1.446 6.207a.683.683 0 01-.016-.91.627.627 0 01.268-.179l4.41-1.476a.605.605 0 01.386 0l4.41 1.476a.627.627 0 01.268.179.683.683 0 01-.016.91L9.777 7.643c.351.91 1.153 1.545 2.35 1.545.125 0 .246.052.334.144a.503.503 0 01.139.348z"></path>
</g><defs>
<clipPath id="ship_svg__clip0_2179_41532">
<path fill="#fff" transform="translate(0 .001)" d="M0 0h12.6v10.5H0z">
</path>
</clipPath>
</defs>
</svg> 
<span id="transport">Sea</span>
</button>
<button type="button" disabled  id="road" class="{{ ($task->task_custom_field_1 == 'road') ? 'active-transport' : ''}}">
<svg width="12" height="10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.658 8.107L9.164 1.123a.953.953 0 00-.896-.632H6.635V2.08a.317.317 0 01-.318.317h-.635a.317.317 0 01-.317-.317V.49H3.734a.952.952 0 00-.897.632L.343 8.107a.95.95 0 00.896 1.272h4.126V7.792c0-.175.143-.317.317-.317h.635c.176 0 .318.142.318.317v1.587h4.109a.955.955 0 00.914-1.272zm-5.023-2.22a.317.317 0 01-.318.318h-.635a.318.318 0 01-.317-.318V3.982c0-.174.143-.317.317-.317h.635c.175 0 .318.143.318.317v1.905z" fill="#02BCB1"></path></svg>
 <span id="transport">Road</span></button>
<button type="button" disabled id="cargo" class="{{ ($task->task_custom_field_1 == 'rail') ? 'active-transport' : ''}}">
<span id="transport"><i class='fas fa-train'></i>Rail</span></button>
</div>
    </span>
  </div>
  <input type="hidden" name="task_custom_field_1" value="{{ $task->task_custom_field_1 }}">
</div>
<div class="form-row">
    <div class="form-group col-md-4">
    <span class="custom-text">Equipment : <strong>{{ $task->task_custom_field_2 }}</strong></span>
    </div>
    <div class="form-group col-md-4">
    <span class="custom-text">&nbsp;&nbsp;&nbsp;Load Type : <strong>{{ $task->task_custom_field_3 }}</strong></span>   
     </div>
     <div class="form-group col-md-4">
    <span class="custom-text">Quantity : <strong>{{ $task->task_custom_field_4 }}</strong></span>
     </div>
  </div>
  
  <div class="d-flex">
    <div class="form-row">
    <div class="form-group col-sm-12">
    <span class="custom-text">Pickup : <strong>{{ $task->task_custom_field_5 }}</strong></span> 
    <hr>
    <span class="custom-text">Country : <strong> {{ $task->task_custom_field_6 }}</strong></span> 
    <span class="custom-text">&nbsp;&nbsp;City : <strong> {{ $task->task_custom_field_7 }}</strong></span>  
    <br />
    <br />
    <span class="custom-text">index : <strong>{{ $task->task_custom_field_8 }}</strong></span> 
    <span class="custom-text">Address : <strong>{{ $task->task_custom_field_9 }}</strong></span> 
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-sm-12">
    <span class="custom-text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Delivery : <strong>{{ $task->task_custom_field_10 }}</strong></span> 
    <hr>
    <span class="custom-text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Country : <strong>{{ $task->task_custom_field_11 }}</strong></span>  
    <span class="custom-text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;City : <strong> {{ $task->task_custom_field_12 }}</strong>
  </span>   
    <br />
    <br />
    <span class="custom-text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;index : <strong>{{ $task->task_custom_field_13 }}</strong>
    <span class="custom-text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Address : <strong>{{ $task->task_custom_field_14 }}</strong></span>  
    </span> 
    </div>
  </div>
  </div>
  <br />
  <div class="form-row">
    <div class="form-group col-sm-12">
    <span class="custom-text">Addional Information</span> 
    <hr>
    <span class="custom-text">Incoterms location : <strong>{{ $task->task_custom_field_15 }}</strong></span>
    <span class="custom-text">ADR : <strong>{{ $task->task_custom_field_16 }}</strong>
    </span>   
    <span class="custom-text">&nbsp;&nbsp;UN code : <strong>{{ $task->task_custom_field_17 }}</strong>
    </span>   
    <span class="custom-text">Temp Sensitive : <strong>{{ $task->task_custom_field_18  }}</strong>
   </span>   
    </div>
    <div class="form-group col-sm-12">
    <span class="custom-text">Fragile Carriage : <strong>{{ $task->task_custom_field_19  }}</strong>
    </span> 
    
    <span class="custom-text">Remarks : <strong>{{ $task->task_custom_field_20 }}</strong>
     </span>
     
     <span class="custom-text">Transport Price : <strong>{{ $task->task_custom_field_21  }}</strong>
    </span> 
    
    <span class="custom-text">Transit Time : <strong>{{ $task->task_custom_field_22 }}</strong>
  </span> 
    
    </div>

  </div>
@if($task->goods)
<div class="goods">
<span><strong>Goods :</strong></span>  
<br/>
@include('misc.goods')
</div>
@endif

<div class="row">
    <div class="col-sm-6">
           <p class="custom-text">Chargeable Weight Total : <strong>{{ $task->task_custom_field_23 }}</strong></p>
    </div>
    <div class="col-sm-6"></div>
</div>

@if(config('app.application_demo_mode'))
<!--DEMO INFO-->
<div class="alert alert-info">
    <h5 class="text-info"><i class="sl-icon-info"></i> Demo Info</h5> 
    These are custom fields. You can change them or <a href="{{ url('app/settings/customfields/projects') }}">create your own.</a>
</div>
@endif


<!--edit button-->
@if(config('visibility.task_editing_buttons'))
<input type="hidden" name="title" value="{{ $task->task_title }}">
<input type="hidden" name="task_status" value="{{ $task->task_status }}">
<input type="hidden" name="task_clientid" value="{{ $task->task_clientid }}">
<input type="hidden" name="task_projectid" value="{{ $task->task_projectid }}">
<input type="hidden" name="task_creatorid" value="{{ $task->task_creatorid }}">
<input type="hidden" name="task_active_state" value="{{ $task->task_active_state }}">
<input type="hidden" name="task_visibility" value="{{ $task->task_visibility }}">

<div class="form-data-row-buttons">
    <button type="button" class="btn waves-effect waves-light btn-xs btn-success ajax-request float-left"
        data-url="{{ url('tasks/content/'.$task->task_id.'/edit-customfields') }}"
        data-loading-class="loading-before-centre"
        data-loading-target="card-tasks-left-panel">@lang('lang.edit')</button>
        <button type="button" <?php if ($task->send_to_docport == 1){ ?> disabled <?php   } ?> class="btn btn-success btn-xs ajax-request float-right"
            data-loading-target="card-tasks-left-panel"
            data-loading-class="loading-before-centre"
            data-url="{{ url('/tasks/content/'.$task->task_id.'/sendToDocport') }}" data-type="form" data-ajax-type="post"
            data-form-id="card-task-organisation">
            {{ cleanLang(__('lang.send_to_docport')) }}
        </button>
</div>
@endif

@else

<div class="x-no-result">
    <img src="{{ url('/') }}/public/images/no-download-avialble.png" alt="404 - Not found" /> 
    <div class="p-t-20"><h4>{{ cleanLang(__('lang.you_do_not_have_custom_fields')) }}</h4></div>
    @if(auth()->user()->is_admin)
    <div class="p-t-10">
        <a href="{{ url('app/settings/customfields/tasks') }}" class="btn btn-info btn-sm">@lang('lang.create_custom_fields')</a>
    </div>
    @endif
</div>
@endif
</div>
<br /><br />