<?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<!--each row-->
<tr id="ticket_<?php echo e($ticket['id']); ?>">
    <?php if(config('visibility.tickets_col_checkboxes')): ?>
    <td class="tickets_col_checkbox checkitem hidden" id="tickets_col_checkbox_<?php echo e($ticket['id']); ?>">
        <!--list checkbox-->
        <span class="list-checkboxes display-inline-block w-px-20">
            <input type="checkbox" id="listcheckbox-tickets-<?php echo e($ticket['id']); ?>"
                name="ids[<?php echo e($ticket['id']); ?>]"
                class="listcheckbox listcheckbox-tickets filled-in chk-col-light-blue"
                data-actions-container-class="tickets-checkbox-actions-container">
            <label for="listcheckbox-tickets-<?php echo e($ticket['id']); ?>"></label>
        </span>
    </td>
    <?php endif; ?>
    <td class="tickets_col_id"><a href="<?php echo e(urlResource('/ctickets/'.$ticket['id'].'/view')); ?>"><?php echo e($ticket['id']); ?></a></td>
    <td class="tickets_col_subject">
        <?php echo e($ticket['shipper_name'] ?? '---'); ?>

    </td>
    <td class="tickets_col_client">
        <?php echo e($ticket['consignee_name'] ?? '---'); ?>

    </td>
    <td class="tickets_col_department">
        <?php echo e($ticket['loadType']['name'] ?? '---'); ?>

    </td>
    <td class="tickets_col_priority">
        <?php echo e($ticket['shipping_date'] ?? '---'); ?>

    </td>
    <td class="tickets_col_priority">
        <span style="background-color: #31D575; color: white; padding: 12px; border-radius: 25px">
            <?php if(isset($users[$ticket['id']]) && count($users[$ticket['id']]) > 0): ?>
                <?php echo e(implode(', ', $users[$ticket['id']])); ?>

            <?php else: ?>
               ---
            <?php endif; ?>
        </span>
    </td>
    <td class="tickets_col_activity">
        <?php echo e($ticket['delivery_date'] ?? '---'); ?>

    </td>
    <td class="tickets_col_status">
       <?php echo e($ticket['status']['name'] ?? '---'); ?>

    </td>
    <td class="tickets_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">

            <!--delete-->
            <button type="button" title="<?php echo e(cleanLang(__('lang.delete'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="<?php echo e(cleanLang(__('lang.delete_item'))); ?>" data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>"
                data-ajax-type="POST" data-url="<?php echo e(url('/ctickets/'.$ticket['id'].'/delete-ticket')); ?>"
                <?php if(!isset($users[$ticket['id']]) || !in_array(Auth::user()->name, $users[$ticket['id']])): ?> disabled <?php endif; ?>>
                <i class="sl-icon-trash"></i>
            </button>
            <!--edit-->
           
            <a href="<?php echo e(urlResource('/ctickets/'.$ticket['id'].'/edit')); ?>"
               class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm"
            ><i class="sl-icon-note"></i></a>

            <a href="<?php echo e(urlResource('/ctickets/'.$ticket['id'].'/view')); ?>" title="<?php echo e(cleanLang(__('lang.view'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-info btn-circle btn-sm">
                <i class="ti-new-window"></i>
            </a>
        </span>
        <!--action button-->
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--each row-->

<?php /**PATH C:\xampp\htdocs\leadport\application\resources\views/pages/customtickets/components/table/ajax.blade.php ENDPATH**/ ?>