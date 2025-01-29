<!--google calendar-->
<li class="sidenav-menu-item <?php echo e($page['mainmenu_calendar'] ?? ''); ?> menu-tooltip menu-with-tooltip"
    title="<?php echo e(cleanLang(__('lang.calendar'))); ?>">
    <a class="waves-effect waves-dark" href="<?php echo e(url('eventss')); ?>" aria-expanded="false" target="_self">
         <i class="ti-calendar"></i>
        <span class="hide-menu"><?php echo e(cleanLang(__('lang.calendar'))); ?>

        </span>
    </a>
</li>
<!--google calendar-->
<li class="sidenav-menu-item } menu-tooltip menu-with-tooltip"
    title="<?php echo e(cleanLang(__('Emails'))); ?>">
    <a class="waves-effect waves-dark" href="<?php echo e(route('emails.index')); ?>" aria-expanded="false" target="_self">
         <i class="ti-email"></i>
        <span class="hide-menu">Emails
        </span>
    </a>
</li>

<!--custom tickets-->
<li class="sidenav-menu-item <?php echo e($page['mainmenu_ctickets'] ?? ''); ?> menu-tooltip menu-with-tooltip"
    title="<?php echo e(cleanLang(__('lang.tickets'))); ?>">
    <a class="waves-effect waves-dark" href="<?php echo e(url('ctickets/index')); ?>" aria-expanded="false" target="_self">
          <i class="ti-comments"></i>
        <span class="hide-menu"><?php echo e(cleanLang(__('lang.tickets'))); ?>

        </span>
    </a>
</li>
<?php /**PATH C:\xampp\htdocs\leadport\application\resources\views/nav/custom-menu.blade.php ENDPATH**/ ?>