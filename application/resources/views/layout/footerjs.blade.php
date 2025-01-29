<!--ALL THIRD PART JAVASCRIPTS-->
<script src="{{ asset('public/vendor/js/vendor.footer.js?v=') }} {{ config('system.versioning') }}"></script>

<!--nextloop.core.js-->
<script src="{{ asset('public/js/core/ajax.js?v=') }}{{ config('system.versioning') }}"></script>

<!--MAIN JS - AT END-->
<script src="{{ asset('public/js/core/boot.js?v=') }} {{ config('system.versioning') }}"></script>


<!--EVENTS-->
<script src="{{ asset('public/js/core/events.js?v=') }}  {{ config('system.versioning') }}"></script>

<!--CORE-->
<script src="{{ asset('public/js/core/app.js?v=') }} {{ config('system.versioning') }}"></script>

<!--SEARCH-->
<script src="{{ asset('public/js/core/search.js?v=') }} {{ config('system.versioning') }}"></script>

<!--BILLING-->
<script src="{{ asset('public/js/core/billing.js?v=') }} {{ config('system.versioning') }}"></script>

<!--CUSTOM-->
<script src="{{ asset('public/js/core/custom.js?v=') }} {{ config('system.versioning') }}"></script>

<!--project page charts-->
@if(@config('visibility.projects_d3_vendor'))
<script src="{{ asset('public/vendor/js/d3/d3.min.js?v=') }} {{ config('system.versioning') }}"></script>
<script src="{{ asset('public/vendor/js/c3-master/c3.min.js?v=') }} {{ config('system.versioning') }}"></script>
@endif

<!--form builder-->
@if(@config('visibility.web_form_builder'))
<script src="{{ asset('public/vendor/js/formbuilder/form-builder.min.js?v=') }} {{ config('system.versioning') }}"></script>
<script src="{{ asset('public/js/webforms/webforms.js?v=') }} {{ config('system.versioning') }}"></script>
@endif

<!--export js (https://github.com/hhurz/tableExport.jquery.plugin)-->
<script src="{{ asset('public/js/core/export.js?v=') }} {{ config('system.versioning') }}"></script>
<script type="text/javascript"
    src="{{ asset('public/vendor/js/exportjs/libs/FileSaver/FileSaver.min.js?v=') }} {{ config('system.versioning') }}"></script>
<script type="text/javascript"
    src="{{ asset('public/vendor/js/exportjs/libs/js-xlsx/xlsx.core.min.js?v=') }} {{ config('system.versioning') }}"></script>
<script type="text/javascript" src="{{ asset('public/vendor/js/exportjs/tableExport.min.js?v=') }} {{ config('system.versioning') }}">
</script>

<!--printing-->
<script type="text/javascript" src="{{ asset('public/vendor/js/printthis/printthis.js?v=') }} {{ config('system.versioning') }}">
</script>

<!--table sorter-->
<script type="text/javascript"
    src="{{ asset('public/vendor/js/tablesorter/js/jquery.tablesorter.min.js?v=') }} {{ config('system.versioning') }}"></script>

<!--bootstrap-timepicker-->
<script type="text/javascript" src="{{ asset('public/vendor/js/bootstrap-timepicker/bootstrap-timepicker.js?v=') }} {{ config('system.versioning') }}">
</script>

<!--calendaerfull js [v6.1.13]-->
<script src="{{ asset('public/vendor/js/fullcalendar/index.global.min.js?v=') }} {{ config('system.versioning') }}"></script>
<!--IMPORTANT NOTES (June 2024) - any new JS libraries added here that are booted/initiated in boot.js should also be added to the landlord footerjs.blade.js, for saas-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDes7CeRfHDiNXKT1xhO2QqUB4bj3ZGD0k&libraries=places&callback=initMap"></script>

{{-- 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script> --}}
