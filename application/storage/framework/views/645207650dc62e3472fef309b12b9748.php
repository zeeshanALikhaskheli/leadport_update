
<?php $__env->startSection('settings_content'); ?>

<!--form-->
<div class="card">
    <div class="card-body" id="landlord-settings-form">


        <!--company-->
        <div class="form-group row">
            <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.company_name'))); ?></label>
            <div class="col-12">
                <input type="text" class="form-control form-control-sm" id="settings_company_name"
                    name="settings_company_name" value="<?php echo e($settings->settings_company_name ?? ''); ?>">
            </div>
        </div>

        <!--address 1-->
        <div class="form-group row">
            <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.address'))); ?></label>
            <div class="col-12">
                <input type="text" class="form-control form-control-sm" id="settings_company_address_line_1"
                    name="settings_company_address_line_1"
                    value="<?php echo e($settings->settings_company_address_line_1 ?? ''); ?>">
            </div>
        </div>

        <!--city-->
        <div class="form-group row">
            <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.city'))); ?></label>
            <div class="col-12">
                <input type="text" class="form-control form-control-sm" id="settings_company_city"
                    name="settings_company_city" value="<?php echo e($settings->settings_company_city ?? ''); ?>">
            </div>
        </div>

        <!--state-->
        <div class="form-group row">
            <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.state'))); ?></label>
            <div class="col-12">
                <input type="text" class="form-control form-control-sm" id="settings_company_state"
                    name="settings_company_state" value="<?php echo e($settings->settings_company_state ?? ''); ?>">
            </div>
        </div>

        <!--form text tem-->
        <div class="form-group row">
            <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.zipcode'))); ?></label>
            <div class="col-12">
                <input type="text" class="form-control form-control-sm" id="settings_company_zipcode"
                    name="settings_company_zipcode" value="<?php echo e($settings->settings_company_zipcode ?? ''); ?>">
            </div>
        </div>


        <!--form text tem-->
        <div class="form-group row">
            <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.country'))); ?></label>
            <div class="col-12">
                <input type="text" class="form-control form-control-sm" id="settings_company_country"
                    name="settings_company_country" value="<?php echo e($settings->settings_company_country ?? ''); ?>">
            </div>
        </div>


        <!--form text tem-->
        <div class="form-group row">
            <label class="col-12 control-label col-form-label"><?php echo e(cleanLang(__('lang.telephone'))); ?></label>
            <div class="col-12">
                <input type="text" class="form-control form-control-sm" id="settings_company_telephone"
                    name="settings_company_telephone" value="<?php echo e($settings->settings_company_telephone ?? ''); ?>">
            </div>
        </div>

        <!--submit-->
        <div class="text-right">
            <button type="submit" id="commonModalSubmitButton"
                class="btn btn-rounded-x btn-success waves-effect text-left ajax-request"
                data-url="<?php echo e(url('app-admin/settings/company')); ?>" data-form-id="landlord-settings-form"
                data-loading-target="" data-ajax-type="post" data-type="form"
                data-on-start-submit-button="disable"><?php echo e(cleanLang(__('lang.save_changes'))); ?></button>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('landlord.settings.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\leadport\application\resources\views/landlord/settings/sections/company/page.blade.php ENDPATH**/ ?>