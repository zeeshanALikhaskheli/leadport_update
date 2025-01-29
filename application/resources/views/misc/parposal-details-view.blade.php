<div class="doc-dates-wrapper p-10">
<h3 class="p-3">Detailed Information:</h3>
<table class="table table-striped p-3" id="proposalTable">
    <tr class="proposal-headings">
        <th></th>
        <th>Date</th>
        <th>Valid Till</th>
        <th>Start Station</th>
        <th>End Station</th>
        <th>Tariff Wagon</th>
        <th>Tariff Count</th>
        <th>Tariff (ton)</th>
        <th>Weight (ton)</th>
        <th>Price Total</th>
    </tr>
    
    @if($document->proposal_details)
    @foreach($document->proposal_details as  $key => $detail) 
    <tr data-id="{{ $key }}">
        <td>{{  ++$key }}</td>
        <td>{{ $detail->proposal_date }}</td>
        <td>{{ $detail->valid }}</td>
        <td>{{ $detail->start_station }}</td>
        <td>{{ $detail->end_station }}</td>
        <td>{{ $detail->tariff_wagon }}</td>
        <td>{{ $detail->tariff_container }}</td>
        <td>{{ $detail->tariff_ton }}</td>
        <td>{{ $detail->weight }}</td>
        <td>{{ $detail->total_price }}</td>
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
        <td align="right">{{ $document->total_weight }}</td>
        <td align="right">{{ $document->total_price }}</td>
    </tr>
    @endif
</table>
</div>

