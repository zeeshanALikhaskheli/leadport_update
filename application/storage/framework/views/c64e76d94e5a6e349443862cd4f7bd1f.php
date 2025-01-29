<!-- action buttons -->
<?php echo $__env->make('pages.contracts.components.misc.list-page-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- action buttons -->

<!--stats panel-->
<?php if(auth()->user()->is_team): ?>
<div id="contracts-stats-wrapper" class="stats-wrapper card-embed-fix">
<?php if(@count($contracts ?? []) > 0): ?> <?php echo $__env->make('misc.list-pages-stats', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php endif; ?>
</div>
<?php endif; ?>
<!--stats panel-->

<!--contracts table-->
<div class="card-embed-fix">
<?php echo $__env->make('pages.contracts.components.table.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<!--contracts table--><?php /**PATH C:\xampp\htdocs\leadport\application\resources\views/pages/contracts/tabswrapper.blade.php ENDPATH**/ ?>