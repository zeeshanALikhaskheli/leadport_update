@extends('layout.wrapper') @section('content')
<!-- main content -->
<div class="container-fluid" id="wrapper-tickets">

    <!--page heading-->
    <div class="row page-titles">

        <!-- Page Title & Bread Crumbs -->
        @include('misc.heading-crumbs')
        <!--Page Title & Bread Crumbs -->

    </div>
    <!--page heading-->
    
    <!-- page content -->
    <div class="row">
        <div class="col-12" id="tickets-table-wrapper">
            @if(isset($ticket['viewmode']) && $ticket['viewmode'] == true)
            @include('pages.customticket.components.view')         
            @else
            <!--tickets table-->
            @include('pages.customticket.components.edit')
            <!--tickets table-->
            @endif
        </div>
    </div>
    <!--page content -->
</div>
<!--main content -->
@endsection