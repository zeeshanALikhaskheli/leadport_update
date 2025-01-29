    @php 
    $totalQty = 0;
    $totalKgcalc = 0;
    $totalLdm = 0;
    $totalVolumeM3 = 0;
    @endphp  
    <i class="mdi mdi-plus-circle-outline text-success font-28 addgoods"></i>
    <table class="table" id="table">
        <thead>
        <tr>
		<th>Quantity</th>
        <th width="10%">Units Type</th>
        <th>Description</th>
        <th>Weight (Br)</th>
		<th>LDM</th>
		<th>Volume (m3)</th>
		<th>Length (cm)</th>
		<th>Width (cm)</th>
		<th>Height (cm)</th>
		</tr>
        </thead>
        <tbody id="goodsTable">
        @foreach($ticket['goods'] as $key => $good) 
            @php 
            $totalQty += $good['quantity'];
            $totalKgcalc += $good['weight'];
            $totalLdm += $good['ldm'];
            $totalVolumeM3 += $good['volume'];
            @endphp
            <tr id="{{$key}}">
                <td><input type="number" class="form-control"  id="{{$key}}"   name="goods[{{$key}}][quantity]"          value="{{  $good['quantity']}}"></td>

                <td>
                    <select class="form-control" name="goods[{{ $key }}][unit_type]" id="unit_type_{{ $key }}">
                        <option value="roll" {{ $good['unit_type'] == 'roll' ? 'selected' : '' }}>Roll</option>
                        <option value="pieces" {{ $good['unit_type'] == 'pieces' ? 'selected' : '' }}>Pieces</option>
                        <option value="eur" {{ $good['unit_type'] == 'eur' ? 'selected' : '' }}>EUR</option>
                        <option value="pallet" {{ $good['unit_type'] == 'pallet' ? 'selected' : '' }}>Pallet</option>
                    </select>
                </td>

                <td><input type="text"   class="form-control"  id="{{$key}}"   name="goods[{{$key}}][description]"       value="{{  $good['description'] }}"></td>
                <td><input type="number" class="form-control"  id="{{$key}}"   name="goods[{{$key}}][weight]"            value="{{  $good['weight'] }}"></td>
                <td><input type="number" class="form-control"  id="{{$key}}"   name="goods[{{$key}}][ldm]"               value="{{  $good['ldm'] }}"></td>
                <td><input type="number" class="form-control"  id="{{$key}}"   name="goods[{{$key}}][volume]"            value="{{  $good['volume'] }}"></td>
                <td><input type="number" class="form-control"  id="{{$key}}"   name="goods[{{$key}}][length]"            value="{{  $good['length'] }}"></td>
                <td><input type="number" class="form-control"  id="{{$key}}"   name="goods[{{$key}}][width]"             value="{{  $good['width'] }}"></td>
                <td><input type="number" class="form-control"  id="{{$key}}"   name="goods[{{$key}}][height]"            value="{{  $good['height'] }}"></td>
                <td><i class="sl-icon-trash custom" onclick="removeIndex(this)"></i></td>
            </tr>
            @endforeach
         </tbody>
         <tr>
		        <td><input type="number" class="form-control" name="totalQuantity" value="{{ $totalQty }}" disabled></td>
				<td></td>
				<td></td>
	            <td><input type="number" class="form-control" name="totalWeight" value="{{ $totalKgcalc }}" disabled></td>
				<td><input type="number" class="form-control" name="totalLDM"    value="{{ $totalLdm }}" disabled></td>
				<td><input type="number" class="form-control" name="totalVolume" value="{{ $totalVolumeM3 }}" disabled></td>
				<td></td>
				<td></td>
                <td></td>
			    <td></td>
		</tr>
    </table> 