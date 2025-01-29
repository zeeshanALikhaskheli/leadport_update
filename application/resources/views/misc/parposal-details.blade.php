<div class="doc-dates-wrapper p-10">
<h3 class="p-3">Detailed Information:</h3>
<table class="table table-striped p-3" id="proposalTable">
    <tr class="proposal-headings">
        <th>Date</th>
        <th>Valid Till</th>
        <th>Start Station</th>
        <th>End Station</th>
        <th>Tariff Wagon</th>
        <th>Tariff Count</th>
        <th>Tariff (ton)</th>
        <th>Weight (ton)</th>
        <th>Price Total</th>
        <th></th>
    </tr>
    
    @if($document->proposal_details)
    @foreach($document->proposal_details as  $key => $detail) 
    <tr data-id="{{ $key }}">
        <td><input type="text" class="form-control" id="proposal_date" name="proposal_details[{{$detail->id}}][proposal_date]" value="{{ $detail->proposal_date }}"></td>
        <td><input type="text" class="form-control" id="valid" name="proposal_details[{{$detail->id}}][valid]" value="{{ $detail->valid }}"></td>
        <td><input type="text" class="form-control" id="start_station" name="proposal_details[{{$detail->id}}][start_station]" value="{{ $detail->start_station }}"></td>
        <td><input type="text" class="form-control" id="end_station" name="proposal_details[{{$detail->id}}][end_station]" value="{{ $detail->end_station }}"></td>
        <td><input type="text" class="form-control" id="tariff_wagon" name="proposal_details[{{$detail->id}}][tariff_wagon]" value="{{ $detail->tariff_wagon  }}"></td>
        <td><input type="text" class="form-control" id="tariff_container" name="proposal_details[{{$detail->id}}][tariff_container]" value="{{ $detail->tariff_container }}"></td>
        <td><input type="text" class="form-control" id="tariff_ton" name="proposal_details[{{$detail->id}}][tariff_ton]" value="{{ $detail->tariff_ton  }}"></td>
        <td><input type="text" class="form-control" id="weight" name="proposal_details[{{$detail->id}}][weight]" value="{{ $detail->weight  }}"></td>
        <td><input type="text" class="form-control" id="total_price" name="proposal_details[{{$detail->id}}][total_price]" value="{{ $detail->total_price }}">
        <input type="hidden" id="proposal_id" name="proposal_details[{{$detail->id}}][proposal_id]" value="{{ $detail->proposal_id }}">
        <input type="hidden" id="username" name="proposal_details[{{$detail->id}}][username]" value="{{ $detail->username }}">
        <input type="hidden" id="client" name="proposal_details[{{$detail->id}}][client]" value="{{ $detail->client }}">
        <input type="hidden" id="client_contact_person" name="proposal_details[{{$detail->id}}][client_contact_person]" value="{{ $detail->client_contact_person }}">
        <input type="hidden" id="title" name="proposal_details[{{$detail->id}}][title]" value="{{ $detail->title }}">
        <input type="hidden" id="type"  name="proposal_details[{{$detail->id}}][type]" value="{{ $detail->type }}">
        </td>
        <td><button type="button" class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm"  onclick="removeTableRow(this)"><i class="sl-icon-trash"></i></button></td>
    </tr>
    @endforeach
    @endif

    </table>
    @if($document->total_weight > 0 || $document->total_price > 0)
    <table class="table table-striped p-3">
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td align="right">{{ $document->total_weight }}</td>
        <td align="right">{{ $document->total_price }}</td>
    </tr>
    @endif
</table>
</div>

<script>

var totalRecords =  @json($document->proposal_details);
var rowIndex = (totalRecords.length+1);
var j = 0;

var proposal_id = document.getElementById('proposal_id').value;
var username = document.getElementById('username').value;
var client = document.getElementById('client').value;
var client_contact_person = document.getElementById('client_contact_person').value;
var title = document.getElementById('title').value;
var type = document.getElementById('type').value;
  
	$(document).on('click', '.addDetails', function (e) {	
		var proposal_details = ['proposal_date','valid','start_station','end_station','tariff_wagon','tariff_container','tariff_ton','weight','total_price']

  $("#proposalTable").append('<tr id="row-'+rowIndex+j+'"></tr>');
       
       for(var i=0; i<proposal_details.length; i++){
        $("tr#row-"+rowIndex+j+"").append('<td><input type="text" class="form-control" name="proposal_details['+rowIndex+']['+proposal_details[i]+']" id="'+rowIndex+'"></td>');
       }
	    	$("tr#row-"+rowIndex+j+"").append('<td><button type="button" class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm"  onclick="removeTableRow(this)"><i class="sl-icon-trash"></i></button></td>');
        rowIndex++;
        j++;
	});

   function removeTableRow(index){
    rowIndex --;
	  var i = index.parentNode.parentNode.rowIndex;
	  document.getElementById("proposalTable").deleteRow(i);
}



// var proposalDetailsArray = @json($document->proposal_details);

// var proposal_id = document.getElementById('proposal_id').value;
// var username = document.getElementById('username').value;
// var client = document.getElementById('client').value;
// var client_contact_person = document.getElementById('client_contact_person').value;
// var title = document.getElementById('title').value;
// var type = document.getElementById('type').value;

// var rowIndex = 1;
// var j = 0;
// var newRowId = 0;
// $(document).on('click', '.addDetails', function (e) {
//   newRowId++; // Increment the row ID
//   var newRow = `
//     <tr data-id="${newRowId}">
//       <td><input type="text" disabled class="form-control"></td>
//       <td><input type="text" class="form-control" name="proposal_date"></td>
//       <td><input type="text" class="form-control" name="valid"></td>
//       <td><input type="text" class="form-control" name="start_station"></td>
//       <td><input type="text" class="form-control" name="end_station"></td>
//       <td><input type="text" class="form-control" name="tariff_wagon"></td>
//       <td><input type="text" class="form-control" name="tariff_container"></td>
//       <td><input type="text" class="form-control" name="tariff_ton"></td>
//       <td><input type="text" class="form-control" name="weight"></td>
//       <td><input type="text" class="form-control" name="total_price"></td>
//       <td><button type="button" class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm"  onclick="removeTableRow(this)"><i class="sl-icon-trash"></i></button></td>
//     </tr>
//   `;
//   $("#proposalTable").append(newRow);

//   $("tr[data-id=" + newRowId + "] input").on("input", function () {
//     var rowIndex = $(this).closest("tr").data("id");
//     var columnName = $(this).attr("name");
//     var columnValue = $(this).val();

//     if (!proposalDetailsArray[rowIndex]) {
//       proposalDetailsArray[rowIndex] = {
//         proposal_id:proposal_id,
//         username:username,
//         client:client,
//         client_contact_person:client_contact_person,
//         title:title,
//         type:type,
//       };
//     }
//     proposalDetailsArray[rowIndex][columnName] = columnValue;
//     document.getElementById('proposal_details').value = JSON.stringify(proposalDetailsArray);
//   });

//   });

//  function removeTableRow(index){
//      proposalDetailsArray.splice(index,1)   
// 	var i = index.parentNode.parentNode.rowIndex;
// 	 document.getElementById("proposalTable").deleteRow(i);
//      document.getElementById('proposal_details').value = JSON.stringify(proposalDetailsArray);
// }

</script>

