<!--ALL THIRD PART JAVASCRIPTS-->
<script src="{{ asset('public/vendor/js/vendor.footer.js?v=') }}  {{ config('system.versioning') }}"></script>

<!--nextloop.core.js-->
<script src="{{ asset('public/js/core/ajax.js?v=') }} {{ config('system.versioning') }}"></script>

<!--MAIN JS - AT END-->
<script src="{{ asset('public/js/core/boot.js?v=') }}  {{ config('system.versioning') }}"></script>

<!--EVENTS-->
<script src="{{ asset('public/js/core/events.js?v=') }}  {{ config('system.versioning') }}"></script>

<!--CORE-->
<script src="{{ asset('public/js/core/app.js?v=') }} {{ config('system.versioning') }}"></script>

<!--SAAS EVENTS-->
<script src="{{ asset('public/js/landlord/events.js?v=') }}  {{ config('system.versioning') }}"></script>
<script src="{{ asset('public/js/landlord/app.js?v=') }}  {{ config('system.versioning') }}"></script>


<!--bootstrap-timepicker-->
<script type="text/javascript" src="{{ asset('public/vendor/js/bootstrap-timepicker/bootstrap-timepicker.js?v=') }} {{ config('system.versioning') }}">
</script>

<!--calendaerfull js [v6.1.13]-->
<script src="{{ asset('public/vendor/js/fullcalendar/index.global.min.js?v=') }}  {{ config('system.versioning') }}"></script>

<!--flash messages-->
@if (Session::has('success-notification'))
<span id="js-trigger-session-message" data-type="success"
    data-message="{{ Session::get('success-notification') }}"></span>
@endif
@if (Session::has('error-notification'))
<span id="js-trigger-session-message" data-type="warning"
    data-message="{{ Session::get('error-notification') }}"></span>
@endif