<table class="table" id="goodsTable">
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
    </tr>
    @foreach($task->goods as $good) 
    <tr>
                <td>{{ $good->qty}}</td>
                <td>{{ $good->unitid}}</td>
                <td>{{ $good->description}}</td>
                <td>{{ $good->weight}}</td>
                <td>{{ $good->ldm}}</td>
                <td>{{ $good->volumem3}}</td>
                <td>{{ $good->lengthcm}}</td>
                <td>{{ $good->widthcm}}</td>
                <td>{{ $good->heightcm}}</td>
    </tr>  
    @endforeach

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
