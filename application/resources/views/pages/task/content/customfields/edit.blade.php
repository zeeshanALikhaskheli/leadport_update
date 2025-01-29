
<div class="x-heading p-t-10"><i class="mdi mdi-file-document-box"></i>{{ cleanLang(__('lang.request_details')) }} <strong style='color:#00b388'> {{$task->send_to_docport  ? '(Convarted to Docport)' : ' '}} </strong></div>
<!--Form Data-->
<div class="card-show-form-data" id="card-task-organisation">

<div class="form-row">

@if($task) 
<table class="table">

    <tr>
      <th colspan="4">Transport Type</th>
    </tr>
    <tr class="vYiyP7">
      <td><button type="button"  onclick="getTrasport('air')" id="air"  class=" {{ ($task->task_custom_field_1 == 'air') ? 'active-transport' : ''}}"><i class='fas fa-plane-departure'></i>
      <span id="transport">Air</span></button></td>
      <td><button type="button"  onclick="getTrasport('sea')" id="sea"  class="{{ ($task->task_custom_field_1 == 'sea') ? 'active-transport' : ''}}">
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
      </button></td>
      <td><button type="button" onclick="getTrasport('road')"   id="road" class="{{ ($task->task_custom_field_1 == 'road') ? 'active-transport' : ''}}">
      <svg width="12" height="10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.658 8.107L9.164 1.123a.953.953 0 00-.896-.632H6.635V2.08a.317.317 0 01-.318.317h-.635a.317.317 0 01-.317-.317V.49H3.734a.952.952 0 00-.897.632L.343 8.107a.95.95 0 00.896 1.272h4.126V7.792c0-.175.143-.317.317-.317h.635c.176 0 .318.142.318.317v1.587h4.109a.955.955 0 00.914-1.272zm-5.023-2.22a.317.317 0 01-.318.318h-.635a.318.318 0 01-.317-.318V3.982c0-.174.143-.317.317-.317h.635c.175 0 .318.143.318.317v1.905z" fill="#02BCB1"></path></svg>
      <span id="transport">Road</span></button></td>
      <td><button type="button" onclick="getTrasport('rail')" id="rail"  class="{{ ($task->task_custom_field_1 == 'rail') ? 'active-transport' : ''}}">
      <span id="transport"><i class='fas fa-train'></i>Rail</span></button></td>
      <input type="hidden" id="transport_type" name="task_custom_field_1" value="{{ $task->task_custom_field_1 ? $task->task_custom_field_1 :  '' }}">
    </tr>
<tr>
  <table class="table">
    
      <tr>
        <th>Equipment</th>
        <th>Load Type</th>
        <th>Quantity</th>
      </tr>

      <tr>
        <td>
              <select name=" task_custom_field_2" id="task_custom_field_2" class="form-control">
              <option  value="Container 20" {{ runtimePreselected($task->task_custom_field_2 ?? '', 'Container 20') }}>Container 20</option>
              <option value="Container 40"  {{ runtimePreselected($task->task_custom_field_2 ?? '', 'Container 40') }}>Container 40</option>
               <option value="Trailer"  {{ runtimePreselected($task->task_custom_field_2 ?? '', 'Trailer') }}>Trailer</option>
             </select></td>
            
        <td>
            <select name="task_custom_field_3" id="task_custom_field_3" class="form-control" value="{{$task->task_custom_field_3}}">
            <option value="Partial Load" {{ runtimePreselected($task->task_custom_field_3 ?? '', 'Partial Load') }}>Partial Load</option>
            </select>
        <td><input type="text" class="form-control" id="task_custom_field_4" name="task_custom_field_4" value="{{ $task->task_custom_field_4 }}"></td>
      </tr>

  </table>
</tr>

<tr>
  <table class="table">
    
      <tr>
        <th class="seprate">Pickup</th>
        <th>Delivery</th>
      </tr>

      <tr>
        <td class="seprate"><input type="text"  class="form-control pickadate" id="task_custom_field_5" name="task_custom_field_5" value="{{ $task->task_custom_field_5 }}"></td>
        <td><input type="text" class="form-control pickadate" id="task_custom_field_10" name="task_custom_field_10" value="{{ $task->task_custom_field_10 }}"></td>
      </tr>

  </table>
</tr>

<tr>
  <table class="table w-50">

      <tr>
        <th>Country</th>
        <th>City</th>
        <th>Index</th>
        <th class="seprate">Address</th>
      </tr>

      <tr>
        <td><select name="task_custom_field_6" id="task_custom_field_6" value="{{ $task->task_custom_field_6 }}" class="form-control" >
            <option value=""></option>
            @include('misc.pickup-country-list')
        </select></td>
        <td><input type="text" class="form-control" id="task_custom_field_7" name="task_custom_field_7" value="{{ $task->task_custom_field_7 }}"></td>
        <td><input type="text" class="form-control" id="task_custom_field_8" name="task_custom_field_8" value="{{ $task->task_custom_field_8 }}"></td>
        <td class="seprate"><input type="text" class="form-control" id="task_custom_field_9" name="task_custom_field_9" value="{{ $task->task_custom_field_9 }}"></td>
      </tr>

  </table>
</tr>

<tr>
  <table class="table w-50">

      <tr>
        <th>Country</th>
        <th>City</th>
        <th>Index</th>
        <th>Address</th>
      </tr>

      <tr>
        <td>
          <select name="task_custom_field_11" id="task_custom_field_11" class="form-control"  value="{{ $task->task_custom_field_11 }}">
            <option value=""></option>
            @include('misc.delivery-country-list')
        </select>
        </td>
        <td><input type="text" class="form-control" id="task_custom_field_12" name="task_custom_field_12" value="{{ $task->task_custom_field_12 }}"></td>
        <td><input type="text" class="form-control" id="task_custom_field_13" name="task_custom_field_13" value="{{ $task->task_custom_field_13 }}"></td>
        <td><input type="text" class="form-control" id="task_custom_field_14" name="task_custom_field_14" value="{{ $task->task_custom_field_14 }}"></td>
      </tr>

  </table>
</tr>

<tr>
  <table class="table w-100">
      <tr>
        <th colspan="5">Additional Information</th>
      </tr>
      <tr>
        <th>Incoterms location</th>
        <th>ADR</th>
        <th>UN Code</th>
        <th>Temp Sensitive</th>
        <th>Fragile Carriage</th>
      </tr>

      <tr>
        <td><input type="text" class="form-control" id="task_custom_field_15" name="task_custom_field_15" value="{{ $task->task_custom_field_15 }}"></td>
        <td><input type="text" class="form-control" id="task_custom_field_16" name="task_custom_field_16" value="{{ $task->task_custom_field_16 }}"></td>
        <td><input type="text" class="form-control" id="task_custom_field_17" name="task_custom_field_17" value="{{ $task->task_custom_field_17 }}"></td>
        <td><input type="text" class="form-control" id="task_custom_field_18" name="task_custom_field_18" value="{{ $task->task_custom_field_18 }}"></td>
        <td><input type="text" class="form-control" id="task_custom_field_19" name="task_custom_field_19" value="{{ $task->task_custom_field_19 }}"></td>
      </tr>

  </table>
</tr>

<tr>
  <table class="table w-100">
      <tr>
        <th>Remarks</th>
        <th>Transport Price</th>
        <th>Transit Time</th>
      </tr>

      <tr>
        <td><input type="text" class="form-control" id="task_custom_field_20" name="task_custom_field_20" value="{{ $task->task_custom_field_20 }}"></td>
        <td><input type="text" class="form-control" id="task_custom_field_21" name="task_custom_field_21" value="{{ $task->task_custom_field_21 }}"></td>
        <td><input type="text" class="form-control" id="task_custom_field_22" name="task_custom_field_22" value="{{ $task->task_custom_field_22 }}"></td>
      </tr>

  </table>
</tr>
</table>
@endif

    <div class="form-group">
    <div>
     <span><strong>Goods</strong></span>
     <button type="button" class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm addgoods">
        <i class="mdi mdi-plus"></i>
    </button>
    </div>  
         @include('misc.edit-goods')
         <div class="row">
        <div class="col-sm-6">
            <p class="custom-text">Chargeable Weight Total : <input type="text" class="form-control" id="task_custom_field_23" name="task_custom_field_23" value="{{ $task->task_custom_field_23 }}"></p>
            </div>
            <div class="col-sm-6"></div>
        </div>
        <button type="button" class="btn waves-effect waves-light btn-xs btn-default ajax-request"
        data-url="{{ url('tasks/content/'.$task->task_id.'/show-customfields') }}"
        data-loading-class="loading-before-centre" data-loading-target="card-tasks-left-panel">@lang('lang.cancel')</button>
        <button type="button" class="btn btn-success btn-xs ajax-request"
            data-loading-target="card-tasks-left-panel"
            data-loading-class="loading-before-centre"
            data-url="{{ url('/tasks/content/'.$task->task_id.'/edit-customfields') }}" data-type="form" data-ajax-type="post"
            data-form-id="card-task-organisation">
            {{ cleanLang(__('lang.update')) }}
        </button>

    </div>
</div>



<script>
function getTrasport(value){
document.getElementById('transport_type').value = value;
var types = ['air','sea','road','rail'];
for(var i =0; i<=types.length; i++){
  $("#"+types[i]).removeClass('active-transport')
}
  $("#"+value).toggleClass('active-transport')
}
</script>

