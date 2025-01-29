    <!--VENDORS-->
    <script src="{{ asset('public/js/landlord/frontend/vendor.js') }}"></script>

    <!-- Mobile Menu JS -->
    <script src="{{ asset('public/themes/frontend/assets/plugins/meanmenu/jquery.meanmenu.min.js') }}"></script>

    <!-- Main Script JS -->
    <script src="{{ asset('public/themes/frontend/assets/js/script.js') }}"></script>

    <!--nextloop.core.js-->
    <script src="{{ asset('public/js/landlord/frontend/ajax.js') }}"></script>

    <!--app.js-->
    <script src="{{ asset('public/js/landlord/frontend/app.js') }}"></script>

    <!--events.js-->
    <script src="{{ asset('public/js/landlord/frontend/events.js') }}"></script>

    <!--custom.js-->
    <script src="{{ asset('public/js/core/custom.js') }}"></script>
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDes7CeRfHDiNXKT1xhO2QqUB4bj3ZGD0k&libraries=places&callback=initMap"></script>

    <!--customer body code-->
    {!! _clean(config('system.settings_code_body')) !!}
