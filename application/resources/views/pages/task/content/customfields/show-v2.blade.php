<div class="card-show-form-data " id="card-task-organisation">
<div class="row form-row">
  <div class="col-sm-6">
  <table class="w-100">
  <tr>
    <td width="20%">
      <label for="">ID</label>
      <input type="text" class="form-control"  disabled value="{{$task->task_id}}">
    </td>
    <td  width="25%">
      <label for="">Type</label>
      <select class="form-control" readonly name="task_custom_field_1">
        <option value="inbound" {{ $task->task_custom_field_1 == 'inbound' ? 'selected' : '' }}>Inbound</option>
        <option value="outbound" {{ $task->task_custom_field_1 == 'outbound' ? 'selected' : '' }}>Outbound</option>
    </select>
    </td>
    <td width="50%">
      <label for="">Reference</label>
      <input type="text" class="form-control" readonly name="task_custom_field_2" value="{{$task->task_custom_field_2}}">
    </td>
  </tr>

  <tr>
     <td colspan="2">
      <label for="">Pickup Date</label>
      <input type="text" class="form-control pickadate" disabled id="task_custom_field_7" name="task_custom_field_3" value="{{ $task->task_custom_field_3 }}">  
    </td>
    <td width="50%">
      <label for="">Type</label>
      <div class="d-flex">
      <span><select name="task_custom_field_4" class="form-control" readonly style="background-color:lightgray;" value="{{ $task->task_custom_field_4 }}">
        <option value="regular" {{ $task->task_custom_field_4 == 'regular' ? 'selected' : '' }}>Regular</option>
        <option value="loading_slot" {{ $task->task_custom_field_4 == 'loading_slot' ? 'selected' : '' }}>Loading Slot</option>
      </select></span>
      <span><input type="text" name="task_custom_field_5" class="form-control" readonly value="{{ $task->task_custom_field_5 }}" size="7"></span>
      </div>
    </td>
  </tr>
  <tr>
    <td>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
    </td>
</tr>
  <tr>  
  <td width="30%">
      <label for="">Country/City</label>
      <div class="d-flex">
      <span>
       <select name="task_custom_field_6" id="task_custom_field_6" value="{{ $task->task_custom_field_6 }}" class="form-control" readonly style="background-color:lightgray;">
            <option value=""></option>
            @include('misc.pickup-country-list')
        </select>
      </span>
      <span><input type="text"  name="task_custom_field_7" value="{{ $task->task_custom_field_7 }}" class="form-control" readonly size="30"></span>
      </div>
    </td>
    <td width="20%">
      <label for="">Index</label>
      <input type="text" name="task_custom_field_8" class="form-control" readonly value="{{ $task->task_custom_field_8 }}">
    </td>
    <td width="40%">
      <label for="">Address</label>
      <input type="text" name="task_custom_field_9" class="form-control" readonly value="{{ $task->task_custom_field_9 }}">
    </td>
  </tr>
  <tr>
  <td colspan="3">
      <label for="">Shipper</label>
      <input type="text" name="task_custom_field_10" class="form-control" readonly value="{{ $task->task_custom_field_10 }}">
    </td>
  </tr>
  <tr>
    <td colspan="3">

    <input type="checkbox" id="listcheckbox-different_pickup" name="task_custom_field_43" value="on" class="listcheckbox filled-in chk-col-light-blue"
    {{ ($task->task_custom_field_43 == 'on') ? 'checked' : '' }}>

    <label for="listcheckbox-different_pickup"><b>Different Pickup</b></label>
    </td>
  </tr>
  <tr class="different_pickup">  
  <td width="30%">
      <label for="">Country/City</label>
      <div class="d-flex">
      <span>
       <select name="task_custom_field_11" id="task_custom_field_11" class="form-control" readonly style="background-color:lightgray;" value="{{ $task->task_custom_field_11 }}">
            <option value=""></option>
            @include('misc.pickup-country-list')
        </select>
      </span>
      <span><input type="text" name="task_custom_field_12" class="form-control" readonly size="30" value="{{ $task->task_custom_field_12 }}"></span>
      </div>
    </td>
    <td width="20%">
      <label for="">Index</label>
      <input type="text" name="task_custom_field_13" class="form-control" readonly value="{{ $task->task_custom_field_13 }}">
    </td>
    <td width="40%">
      <label for="">Address</label>
      <input type="text" name="task_custom_field_14" class="form-control" readonly value="{{ $task->task_custom_field_14 }}">
    </td>
  </tr> 
  <tr class="different_pickup d-none">
  <td colspan="3">
      <label for="">Company <i class="fa fa-angle-down"></i></label>
      <input type="text" name="task_custom_field_15" class="form-control" readonly value="{{ $task->task_custom_field_15 }}">
    </td>
  </tr>

  <td colspan="3">
      <div id="loadingRemarks">
        <label for="">Loading Remarks</label>
        @if(isset($task->task_custom_field_16) && count($task->task_custom_field_16) > 0)
        @foreach($task->task_custom_field_16 as $key => $pickup)
        <span><input type="text" id="task_custom_field_16" name="task_custom_field_16[{{$key}}]" class="form-control" readonly value="{{ $pickup }}" style="width:90%"></span>
        <span id="loadingRemark_{{$key}}"><br><br></span>
        @endforeach
        @else
        <span><input type="text" id="task_custom_field_16" name="task_custom_field_16[]" class="form-control" readonly style="width:90%"></span>
        <span id="loadingRemark_0"><br><br></span>
        @endif
      </div>  
    </td>
  </tr>
</table>
  </div>



  <div class="col-sm-6">
  <table class="w-100">
  <tr>  
    <td width="25%">
      <label for="">TS Type</label>
      <select  class="form-control" readonly name="task_custom_field_17">

        <option value="air" {{ $task->task_custom_field_17 == 'air' ? 'selected' : '' }}>Air</option>
        <option value="sea" {{ $task->task_custom_field_17 == 'sea' ? 'selected' : '' }}>Sea</option>
        <option value="road" {{ $task->task_custom_field_17 == 'road' ? 'selected' : '' }}>Road</option>
        <option value="rail" {{ $task->task_custom_field_17 == 'rail' ? 'selected' : '' }}>Rail</option>
        
      </select>
    </td>
    <td width="25%">
      <label for="">CG Type</label>
      <input type="text" class="form-control" readonly name="task_custom_field_18" value="{{ $task->task_custom_field_18 }}">
    </td>
    <td width="20%">
      <label for="">Quantity <i class="fa fa-angle-down"></i></label>
      <input type="text" class="form-control" readonly name="task_custom_field_19" value="{{ $task->task_custom_field_19 }}">
    </td>
  </tr>

  <tr>
  <td colspan="2">
      <label for="">Delivery Date</label>
      <input type="text" class="form-control pickadate" disabled id="task_custom_field_20" name="task_custom_field_20" value="{{ $task->task_custom_field_20 }}">  
    </td>
    <td width="50%">
      <label for="">Type</label>
      <div class="d-flex">
      <span><select  class="form-control" readonly name="task_custom_field_21" style="background-color:lightgray;" value="{{ $task->task_custom_field_21 }}">
        <option value="regular" {{ $task->task_custom_field_21 == 'regular' ? 'selected' : '' }}>Regular</option>
        <option value="time_promise" {{ $task->task_custom_field_21 == 'time_promise' ? 'selected' : '' }}>Time Promise</option>
      </select></span>
      <span><input type="text" class="form-control" readonly name="task_custom_field_22" size="7" value="{{ $task->task_custom_field_22 }}"></span>
      </div>
    </td>
  </tr>
  <tr>
    <td>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
    </td>
</tr>
<tr>  
  <td width="30%">
      <label for="">Country/City</label>
      <div class="d-flex">
      <span>
       <select name="task_custom_field_23" id="task_custom_field_23" class="form-control" readonly style="background-color:lightgray;" value="{{ $task->task_custom_field_23 }}">
            <option value=""></option>
            @include('misc.delivery-country-list')
        </select>
      </span>
      <span><input type="text" name="task_custom_field_24" class="form-control" readonly size="30" value="{{ $task->task_custom_field_24 }}"></span>
      </div>
    </td>
    <td width="20%">
      <label for="">Index</label>
      <input type="text" name="task_custom_field_25" class="form-control" readonly value="{{ $task->task_custom_field_25 }}">
    </td>
    <td width="40%">
      <label for="">Address</label>
      <input type="text" name="task_custom_field_26" class="form-control" readonly value="{{ $task->task_custom_field_26 }}">
    </td>
  </tr>
  <td colspan="3">
      <label for="">Consignee <i class="fa fa-angle-down"></i></label>
      <input type="text" name="task_custom_field_27" class="form-control" readonly value="{{ $task->task_custom_field_27 }}">
    </td>
  </tr>

  <tr>
    <td colspan="3">
    <input type="checkbox" id="listcheckbox-different_delivery" name="task_custom_field_28"  class="listcheckbox filled-in chk-col-light-blue" value="{{ $task->task_custom_field_28 }}"
    {{ ($task->task_custom_field_28 == 'on') ? 'checked' : '' }}>
    <label for="listcheckbox-different_delivery"><b>Different Delivery</b></label>
    </td>
  </tr>

  <tr class="different_delivery">  
  <td width="30%">
      <label for="">Country/City</label>
      <div class="d-flex">
      <span>
       <select name="task_custom_field_29" id="task_custom_field_29" class="form-control" readonly style="background-color:lightgray;" value="{{ $task->task_custom_field_29 }}">
            <option value=""></option>
            @include('misc.delivery-country-list')
        </select>
      </span>
      <span><input type="text" name="task_custom_field_30" class="form-control" readonly size="30" value="{{ $task->task_custom_field_30 }}"></span>
      </div>
    </td>
    <td width="20%">
      <label for="">Index</label>
      <input type="text" class="form-control" readonly name="task_custom_field_31" value="{{ $task->task_custom_field_31 }}">
    </td>
    <td width="40%">
      <label for="">Address</label>
      <input type="text" class="form-control" readonly name="task_custom_field_32" value="{{ $task->task_custom_field_32 }}">
    </td>
  </tr>
  <tr class="different_delivery d-none">
  <td colspan="3">
      <label for="">Company <i class="fa fa-angle-down"></i></label>
      <input type="text" class="form-control" readonly name="task_custom_field_33" value="{{ $task->task_custom_field_33 }}"> 
    </td>
  </tr>
  <td colspan="3">
      <div id="deliveryRemarks">
        <label for="">Delivery Remarks</label>
        @if(isset($task->task_custom_field_34) && count($task->task_custom_field_34) > 0)
         @foreach($task->task_custom_field_34 as $key2 => $delivery)
         <span><input type="text" id="task_custom_field_34" name="task_custom_field_34[{{$key2}}]" class="form-control" readonly value="{{ $delivery }}" style="width:90%"></span>
         <span id="deliveryRemark_{{ $key2 }}"><br><br></span>
         @endforeach
        @else
        <span><input type="text" id="task_custom_field_34" name="task_custom_field_34[0]" class="form-control" readonly style="width:90%"></span>
        <span id="deliveryRemark_0"><br><br></span>
         @endif  
      </div>  
    </td>
  </tr>
</table>
  </div>
</div>
<div class="row mt-5">
  <div class="col-sm-12">
    <span><strong>Goods</strong></span>
     <button type="button" class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm addgoods">
        <i class="mdi mdi-plus"></i>
    </button>
    @include('misc.goods')
    <table class="w-50"> 
<tr>  
    <td>
      Chargable Weight Total : <input type="text" name="task_custom_field_35" class="form-control" readonly value="{{ $task->task_custom_field_35 }}">
    </td>
  </tr>
</table>
  </div>
</div>
<br/>
<p><strong>Commence</strong></p>
<table class="w-75"> 
<tr>  
  <td width="25%">
      <label for="">ADR</label>
      <div class="d-flex">
      <span><select name="task_custom_field_36"  class="form-control" readonly style="background-color:lightgray;" value="{{ $task->task_custom_field_36 }}">
        <option value="yes" {{ $task->task_custom_field_36 == 'yes' ? 'selected' : '' }}>Yes</option>
        <option value="no" {{ $task->task_custom_field_36 == 'no' ? 'selected' : '' }}>No</option> 
      </select></span>
      <span><input type="text" name="task_custom_field_37" class="form-control" readonly size="7" value="{{ $task->task_custom_field_37 }}"></span>
      </div>
    </td>
    <td width="25%">
      <label for="">T Sensitive</label>
      <div class="d-flex">
      <span><select name="task_custom_field_38" class="form-control" readonly style="background-color:lightgray;" value="{{ $task->task_custom_field_38 }}">
      <option value="yes" {{ $task->task_custom_field_38 == 'yes' ? 'selected' : '' }}>Yes</option>
        <option value="no" {{ $task->task_custom_field_38 == 'no' ? 'selected' : '' }}>No</option>
      </select></span>
      <span><input type="text" name="task_custom_field_39" class="form-control" readonly size="7" value="{{ $task->task_custom_field_39 }}"></span>
      </div>
    </td>
    <td width="25%">
      <label for="">Fragile</label>
      <div class="d-flex">
      <span><select name="task_custom_field_40" class="form-control" readonly style="background-color:lightgray;" value="{{ $task->task_custom_field_40 }}">
      <option value="yes" {{ $task->task_custom_field_40 == 'yes' ? 'selected' : '' }}>Yes</option>
        <option value="no" {{ $task->task_custom_field_40 == 'no' ? 'selected' : '' }}>No</option>
      </select></span>
      <span><input type="text" name="task_custom_field_41" class="form-control" readonly size="7" value="{{ $task->task_custom_field_41 }}"></span>
      </div>
    </td>
    <td width="25%">
      <label for="">Incoterns<i class="fa fa-angle-down"></i></label>
      <select name="task_custom_field_42" class="form-control" readonly name="task_custom_field_43"  value="{{ $task->task_custom_field_43 }}">
      <option value="yes" {{ $task->task_custom_field_42 == 'yes' ? 'selected' : '' }}>Yes</option>
        <option value="no" {{ $task->task_custom_field_42 == 'no' ? 'selected' : '' }}>No</option>
    </select>
    </td>
  </tr>
</table>


@if(config('visibility.task_editing_buttons'))
<div class="form-data-row-buttons">
    <button type="button" class="btn waves-effect waves-light btn-xs btn-success ajax-request"
        data-url="{{ url('tasks/content/'.$task->task_id.'/edit-customfields') }}"
        data-loading-class="loading-before-centre"
        data-loading-target="card-tasks-left-panel">@lang('lang.edit')</button>
</div>
@endif
</div>


