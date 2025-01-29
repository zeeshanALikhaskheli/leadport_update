<table class="table" id="table">
        <thead>
                <tr>
                <th>Qty</th>
                <th>Unit Type</th>
                <th>Description</th>
                <th>Weight (Br)</th>
                <th>LDM</th>
                <th>Vol(m3)</th>
                <th>L(cm)</th>
                <th>W(cm)</th>
                <th>H(cm)</th>
                <th>Action</th>
                </tr>
        </thead>
        @if($task->goods)
        <tbody id="goodsTable">
        @foreach($task->goods as $good) 
            <tr id="{{$good->id}}">
                <td><input type="text" class="form-control"  id="{{$good->id}}" name="goods[{{$good->id}}][qty]" value="{{ $good->qty}}"></td>
                <td><input type="text" class="form-control"  id="{{$good->id}}" name="goods[{{$good->id}}][unitid]" value="{{ $good->unitid }}"></td>
                <td><input type="text" class="form-control"  id="{{$good->id}}" name="goods[{{$good->id}}][description]" value="{{ $good->description}}"></td>
                <td><input type="text" class="form-control"  id="{{$good->id}}" name="goods[{{$good->id}}][weight]" value="{{ $good->weight}}"></td>
                <td><input type="text" class="form-control"  id="{{$good->id}}" name="goods[{{$good->id}}][ldm]" value="{{ $good->ldm}}"></td>
                <td><input type="text" class="form-control"  id="{{$good->id}}" name="goods[{{$good->id}}][volumem3]" value="{{ $good->volumem3}}"></td>
                <td><input type="text" class="form-control"  id="{{$good->id}}" name="goods[{{$good->id}}][lengthcm]" value="{{ $good->lengthcm }}"></td>
                <td><input type="text" class="form-control"  id="{{$good->id}}" name="goods[{{$good->id}}][widthcm]" value="{{ $good->widthcm}}"></td>
                <td><input type="text" class="form-control"  id="{{$good->id}}" name="goods[{{$good->id}}][heightcm]" value="{{ $good->heightcm }}"></td>
                <td><button type="button" class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm"  onclick="removeIndex(this)"><i class="sl-icon-trash"></i></button></td>
            </tr>
            @endforeach
         </tbody>
        @endif
    </table> 
    @if(isset($task->goods) && count($task->goods) > 0)
    <table class="table">
    <tr id="default-row">
                    <td><input type="text" class="form-control"  value="{{ $task->totalQty }}"  disabled></td>
                    <td><input type="text" class="form-control"  disabled></td>
                    <td><input type="text" class="form-control"  disabled></td>
                    <td><input type="text" class="form-control"  value="{{ $task->totalWeight }}" disabled></td>
                    <td><input type="text" class="form-control"  value="{{ $task->totalLdm }}" disabled></td>
                    <td><input type="text" class="form-control"  value="{{ $task->totalVolumem3 }}" disabled></td>
                    <td><input type="text" class="form-control"  disabled></td>
                    <td><input type="text" class="form-control"  disabled></td>
                    <td><input type="text" class="form-control"  disabled></td>

    </tr>
    </table>
    @endif