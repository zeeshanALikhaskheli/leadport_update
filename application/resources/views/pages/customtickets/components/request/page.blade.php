<!DOCTYPE html>
<html lang="en">

@include('frontend.layout.header')
<body>

    <!--page heading-->
    <div class="container page-wrapper pages-wrapper faq">

        @if($page['page_title'])
        <div class="pages-header text-center">
            <h4>{{ $page['page_title'] ?? '' }} -- ({{ env('APP_NAME') }})</h4>
        </div>
        @endif
        
        <!--faq container-->
        <div class="pages-container">
            @if(isset($ticket))
            @include('pages.customtickets.components.request.view')        
            @else
            @include('pages.customtickets.components.request.request')        
            @endif
       </div>
    </div>

    @include('frontend.layout.footerjs')
</body>

</html>