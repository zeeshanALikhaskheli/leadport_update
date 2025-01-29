



<div class="card count" id="emails-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            <?php if(isset($emails) && count($emails) > 0): ?>
            <table id="emails-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list" data-page-size="10">
                <thead>
                    <tr>
                        <th class="emails_col_id"><?php echo e(cleanLang(__('lang.id'))); ?></th>
                        <th class="emails_col_subject"><?php echo e(cleanLang(__('lang.subject'))); ?></th>
                        <th class="emails_col_from"><?php echo e(cleanLang(__('lang.from'))); ?></th>
                        <th class="emails_col_date"><?php echo e(cleanLang(__('lang.date'))); ?></th>
                        <th class="emails_col_status"><?php echo e(cleanLang(__('lang.status'))); ?></th>
                        <th class="emails_col_action"><?php echo e(cleanLang(__('lang.action'))); ?></th>
                    </tr>
                </thead>
                <tbody id="emails-td-container">
                    <?php $__currentLoopData = $emails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $email): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($email->uid); ?></td>
                        <td><?php echo e($email->subject); ?></td>
                        <td><?php echo e($email->from); ?></td>
                        <td><?php echo e($email->received_at->format('Y-m-d H:i')); ?></td>
                        <td>Unread</td>
                        <td>
                      
                         
                               <!-- View Email Button with Icon -->
                               <a class="btn btn-success btn-sm view-email-btn"
                               data-email-body="<?php echo e($email->body); ?>" 
                               data-email-subject="<?php echo e($email->subject); ?>" 
                               data-email-from="<?php echo e($email->from); ?>" 
                               data-email-date="<?php echo e($email->received_at->format('Y-m-d H:i')); ?>"
                               data-logistics="<?php echo e(json_encode($email->logistics_data)); ?>">
                               <i class="ti-email"></i> <!-- Email Icon -->
                            </a>

                            <a href="<?php echo e(route('emails.show', ['email' => $email->id])); ?>" class="btn btn-success btn-sm">
                                <i class="sl-icon-action-redo"></i> <!-- Ticket Generation Icon -->
                             </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <?php echo $__env->make('misc.load-more-button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <?php else: ?>
            <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal for displaying email body and logistics data -->
<div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="emailModalLabel"><?php echo e(cleanLang(__('lang.email_details'))); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6><?php echo e(cleanLang(__('lang.subject'))); ?>: <span id="email-subject"></span></h6>
                <p><strong><?php echo e(cleanLang(__('lang.from'))); ?>:</strong> <span id="email-from"></span></p>
                <p><strong><?php echo e(cleanLang(__('lang.date'))); ?>:</strong> <span id="email-date"></span></p>
                <hr>
                <h5><?php echo e(cleanLang(__('lang.email_body'))); ?>:</h5>
                <p id="email-body"></p>
                <hr>
                
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.view-email-btn').on('click', function() {
            const emailBody = $(this).data('email-body') || 'No content available';
            const emailSubject = $(this).data('email-subject') || 'No subject available';
            const emailFrom = $(this).data('email-from') || 'Unknown sender';
            const emailDate = $(this).data('email-date') || 'Unknown date';
            const logisticsData = $(this).data('logistics') ;

            // Populate modal fields
            $('#email-body').text(emailBody);
            $('#email-subject').text(emailSubject);
            $('#email-from').text(emailFrom);
            $('#email-date').text(emailDate);

            // Clean and format logistics data
            // let logisticsContent = 'No logistics data available';
            // if (logisticsData && Object.keys(logisticsData).length > 0) {
            //     // Clean up the data (remove \n and extra spaces)
            //     logisticsContent = JSON.stringify(logisticsData, null, 2);
            //     logisticsContent = logisticsContent.replace(/\n/g, ' ').replace(/\s+/g, ' ').trim(); // Clean newlines and excessive spaces
            // }

            // Display the cleaned logistics data
            $('#logistics-data').text(logisticsData);

            // Display the modal
            const emailModal = new bootstrap.Modal(document.getElementById('emailModal'));
            emailModal.show();
        });
    });
</script>

<?php /**PATH C:\xampp\htdocs\leadport\application\resources\views/pages/emails/components/table/table.blade.php ENDPATH**/ ?>