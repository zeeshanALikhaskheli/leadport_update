<div class="card count" id="tickets-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            @if (isset($tickets)  && count($tickets) > 0)
            <table id="tickets-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        @if(config('visibility.tickets_col_checkboxes'))
                        <th class="list-checkbox-wrapper hidden">
                            <!--list checkbox-->
                            <span class="list-checkboxes display-inline-block w-px-20">
                                <input type="checkbox" id="listcheckbox-tickets" name="listcheckbox-tickets"
                                    class="listcheckbox-all filled-in chk-col-light-blue"
                                    data-actions-container-class="tickets-checkbox-actions-container"
                                    data-children-checkbox-class="listcheckbox-tickets">
                                <label for="listcheckbox-tickets"></label>
                            </span>
                        </th>
                        @endif
                        <th class="tickets_col_id">{{ cleanLang(__('lang.id')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                        </th>
                        <th class="tickets_col_subject">{{ cleanLang(__('lang.shipper')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                        </th>
                        <th class="tickets_col_client">{{ cleanLang(__('lang.consignee')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                        </th>
                        <th class="tickets_col_department">{{ cleanLang(__('lang.load_type')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                        </th>
                        <th class="tickets_col_date">{{ cleanLang(__('lang.pickup_date')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                        </th>
                        <th class="tickets_col_date">{{ cleanLang(__('lang.assigned')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                        </th>
                     
                        <th class="tickets_col_date">{{ cleanLang(__('lang.delivery_date')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                        </th>
                     
                       
                        <th class="tickets_col_activity">{{ cleanLang(__('lang.status')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                        </th>
                        <!-- <th class="tickets_col_status"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_ticket_status" href="javascript:void(0)"
                                data-url="{{ urlResource('/tickets?action=sort&orderby=ticket_status&sortorder=asc') }}">{{ cleanLang(__('lang.status')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th> -->

                        <th class="tickets_col_action"><a href="javascript:void(0)">{{ cleanLang(__('lang.action')) }}</a></th>
                    </tr>
                </thead>
                <tbody id="tickets-td-container">
                    <!--ajax content here-->
                    @include('pages.customtickets.components.table.ajax')
                    <!--ajax content here-->
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="20">
                            <!--load more button-->
                            @include('misc.load-more-button')
                            <!--load more button-->
                        </td>
                    </tr>
                </tfoot>
            </table>
            @endif @if (isset($tickets) && count($tickets) == 0)
            <!--nothing found-->
            @include('notifications.no-results-found')
            <!--nothing found-->
            @endif
        </div>
    </div>
</div>