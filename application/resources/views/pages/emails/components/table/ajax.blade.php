@foreach($tickets as $ticket)
<!--each row-->
<tr id="ticket_{{ $ticket['id'] }}">
    @if(config('visibility.tickets_col_checkboxes'))
    <td class="tickets_col_checkbox checkitem hidden" id="tickets_col_checkbox_{{ $ticket['id'] }}">
        <!--list checkbox-->
        <span class="list-checkboxes display-inline-block w-px-20">
            <input type="checkbox" id="listcheckbox-tickets-{{ $ticket['id'] }}"
                name="ids[{{ $ticket['id'] }}]"
                class="listcheckbox listcheckbox-tickets filled-in chk-col-light-blue"
                data-actions-container-class="tickets-checkbox-actions-container">
            <label for="listcheckbox-tickets-{{ $ticket['id'] }}"></label>
        </span>
    </td>
    @endif
    <td class="tickets_col_id"><a href="{{ urlResource('/ctickets/'.$ticket['id'].'/view') }}">{{ $ticket['id'] }}</a></td>
    <td class="tickets_col_subject">
        {{ $ticket['shipper_name'] ?? '---' }}
    </td>
    <td class="tickets_col_client">
        {{ $ticket['consignee_name'] ?? '---' }}
    </td>
    <td class="tickets_col_department">
        {{ $ticket['loadType']['name'] ?? '---' }}
    </td>
    <td class="tickets_col_priority">
        {{ $ticket['shipping_date'] ?? '---' }}
    </td>
    <td class="tickets_col_priority">
        <span style="background-color: #31D575; color: white; padding: 12px; border-radius: 25px">
            @if(isset($users[$ticket['id']]) && count($users[$ticket['id']]) > 0)
                {{ implode(', ', $users[$ticket['id']]) }}
            @else
               ---
            @endif
        </span>
    </td>
    <td class="tickets_col_activity">
        {{ $ticket['delivery_date'] ?? '---' }}
    </td>
    <td class="tickets_col_status">
       {{ $ticket['status']['name'] ?? '---' }}
    </td>
    <td class="tickets_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">

            <!--delete-->
            <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}" data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                data-ajax-type="POST" data-url="{{ url('/ctickets/'.$ticket['id'].'/delete-ticket') }}"
                @if(!isset($users[$ticket['id']]) || !in_array(Auth::user()->name, $users[$ticket['id']])) disabled @endif>
                <i class="sl-icon-trash"></i>
            </button>
            <!--edit-->
           
            <a href="{{ urlResource('/ctickets/'.$ticket['id'].'/edit') }}"
               class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm"
            ><i class="sl-icon-note"></i></a>

            <a href="{{ urlResource('/ctickets/'.$ticket['id'].'/view') }}" title="{{ cleanLang(__('lang.view')) }}"
                class="data-toggle-action-tooltip btn btn-outline-info btn-circle btn-sm">
                <i class="ti-new-window"></i>
            </a>
        </span>
        <!--action button-->
    </td>
</tr>
@endforeach
<!--each row-->

