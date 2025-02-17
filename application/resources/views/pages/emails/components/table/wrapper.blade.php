@extends('layout.wrapper') @section('content')
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles">

        <!-- Page Title & Bread Crumbs -->
        @include('misc.heading-crumbs')
        <!--Page Title & Bread Crumbs -->


        <!-- action buttons -->
        {{-- @include('pages.emails.components.misc.list-page-actions') --}}
        <!-- action buttons -->

    </div>
    <!--page heading-->

    <!--stats panel-->
    @if(auth()->user()->is_team)
    <div id="tickets-stats-wrapper" class="stats-wrapper">
    {{-- @include('misc.list-pages-stats') --}}
    </div>
    @endif
    <!--stats panel-->


    <!-- page content -->
    <div class="row">
        <div class="col-12">
            <!--tickets table-->

        @if (auth()->user()->app_password)
            @include('pages.emails.components.table.table')
            <!--tickets table-->
        @else
        @include('pages.emails.components.table.form')
        
        @endif
        </div>
    </div>
    <!--page content -->

</div>
<!--main content -->


@endsection
