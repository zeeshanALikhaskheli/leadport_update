<!--ALL THIRD PART JAVASCRIPTS-->
<script src="<?php echo e(asset('public/vendor/js/vendor.footer.js?v=')); ?> <?php echo e(config('system.versioning')); ?>"></script>

<!--nextloop.core.js-->
<script src="<?php echo e(asset('public/js/core/ajax.js?v=')); ?><?php echo e(config('system.versioning')); ?>"></script>

<!--MAIN JS - AT END-->
<script src="<?php echo e(asset('public/js/core/boot.js?v=')); ?> <?php echo e(config('system.versioning')); ?>"></script>


<!--EVENTS-->
<script src="<?php echo e(asset('public/js/core/events.js?v=')); ?>  <?php echo e(config('system.versioning')); ?>"></script>

<!--CORE-->
<script src="<?php echo e(asset('public/js/core/app.js?v=')); ?> <?php echo e(config('system.versioning')); ?>"></script>

<!--SEARCH-->
<script src="<?php echo e(asset('public/js/core/search.js?v=')); ?> <?php echo e(config('system.versioning')); ?>"></script>

<!--BILLING-->
<script src="<?php echo e(asset('public/js/core/billing.js?v=')); ?> <?php echo e(config('system.versioning')); ?>"></script>

<!--CUSTOM-->
<script src="<?php echo e(asset('public/js/core/custom.js?v=')); ?> <?php echo e(config('system.versioning')); ?>"></script>

<!--project page charts-->
<?php if(@config('visibility.projects_d3_vendor')): ?>
<script src="<?php echo e(asset('public/vendor/js/d3/d3.min.js?v=')); ?> <?php echo e(config('system.versioning')); ?>"></script>
<script src="<?php echo e(asset('public/vendor/js/c3-master/c3.min.js?v=')); ?> <?php echo e(config('system.versioning')); ?>"></script>
<?php endif; ?>

<!--form builder-->
<?php if(@config('visibility.web_form_builder')): ?>
<script src="<?php echo e(asset('public/vendor/js/formbuilder/form-builder.min.js?v=')); ?> <?php echo e(config('system.versioning')); ?>"></script>
<script src="<?php echo e(asset('public/js/webforms/webforms.js?v=')); ?> <?php echo e(config('system.versioning')); ?>"></script>
<?php endif; ?>

<!--export js (https://github.com/hhurz/tableExport.jquery.plugin)-->
<script src="<?php echo e(asset('public/js/core/export.js?v=')); ?> <?php echo e(config('system.versioning')); ?>"></script>
<script type="text/javascript"
    src="<?php echo e(asset('public/vendor/js/exportjs/libs/FileSaver/FileSaver.min.js?v=')); ?> <?php echo e(config('system.versioning')); ?>"></script>
<script type="text/javascript"
    src="<?php echo e(asset('public/vendor/js/exportjs/libs/js-xlsx/xlsx.core.min.js?v=')); ?> <?php echo e(config('system.versioning')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/vendor/js/exportjs/tableExport.min.js?v=')); ?> <?php echo e(config('system.versioning')); ?>">
</script>

<!--printing-->
<script type="text/javascript" src="<?php echo e(asset('public/vendor/js/printthis/printthis.js?v=')); ?> <?php echo e(config('system.versioning')); ?>">
</script>

<!--table sorter-->
<script type="text/javascript"
    src="<?php echo e(asset('public/vendor/js/tablesorter/js/jquery.tablesorter.min.js?v=')); ?> <?php echo e(config('system.versioning')); ?>"></script>

<!--bootstrap-timepicker-->
<script type="text/javascript" src="<?php echo e(asset('public/vendor/js/bootstrap-timepicker/bootstrap-timepicker.js?v=')); ?> <?php echo e(config('system.versioning')); ?>">
</script>

<!--calendaerfull js [v6.1.13]-->
<script src="<?php echo e(asset('public/vendor/js/fullcalendar/index.global.min.js?v=')); ?> <?php echo e(config('system.versioning')); ?>"></script>
<!--IMPORTANT NOTES (June 2024) - any new JS libraries added here that are booted/initiated in boot.js should also be added to the landlord footerjs.blade.js, for saas-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDes7CeRfHDiNXKT1xhO2QqUB4bj3ZGD0k&libraries=places&callback=initMap"></script>


<?php /**PATH C:\xampp\htdocs\leadport\application\resources\views/layout/footerjs.blade.php ENDPATH**/ ?>