<div class="card count" id="tickets-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            <?php if(isset($tickets)  && count($tickets) > 0): ?>
            <table id="tickets-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        <?php if(config('visibility.tickets_col_checkboxes')): ?>
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
                        <?php endif; ?>
                        <th class="tickets_col_id"><?php echo e(cleanLang(__('lang.id'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                        </th>
                        <th class="tickets_col_subject"><?php echo e(cleanLang(__('lang.shipper'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                        </th>
                        <th class="tickets_col_client"><?php echo e(cleanLang(__('lang.consignee'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                        </th>
                        <th class="tickets_col_department"><?php echo e(cleanLang(__('lang.load_type'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                        </th>
                        <th class="tickets_col_date"><?php echo e(cleanLang(__('lang.pickup_date'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                        </th>
                        <th class="tickets_col_date"><?php echo e(cleanLang(__('lang.assigned'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                        </th>
                     
                        <th class="tickets_col_date"><?php echo e(cleanLang(__('lang.delivery_date'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                        </th>
                     
                       
                        <th class="tickets_col_activity"><?php echo e(cleanLang(__('lang.status'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                        </th>
                        <!-- <th class="tickets_col_status"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_ticket_status" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/tickets?action=sort&orderby=ticket_status&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.status'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th> -->

                        <th class="tickets_col_action"><a href="javascript:void(0)"><?php echo e(cleanLang(__('lang.action'))); ?></a></th>
                    </tr>
                </thead>
                <tbody id="tickets-td-container">
                    <!--ajax content here-->
                    <?php echo $__env->make('pages.customtickets.components.table.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!--ajax content here-->
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="20">
                            <!--load more button-->
                            <?php echo $__env->make('misc.load-more-button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <!--load more button-->
                        </td>
                    </tr>
                </tfoot>
            </table>
            <?php endif; ?> <?php if(isset($tickets) && count($tickets) == 0): ?>
            <!--nothing found-->
            <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--nothing found-->
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\leadport\application\resources\views/pages/customtickets/components/table/table.blade.php ENDPATH**/ ?>