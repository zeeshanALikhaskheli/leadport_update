<!--CRUMBS CONTAINER (RIGHT)-->
<div class="col-md-12  col-lg-7 p-b-9 align-self-center text-right {{ $page['list_page_actions_size'] ?? '' }} {{ $page['list_page_container_class'] ?? '' }}"
    id="list-page-actions-container">
    <div id="list-page-actions">
        <!--SEARCH BOX-->
       
        <div class="header-search" id="header-search">
            <i class="sl-icon-magnifier"></i>
            <input type="text" class="form-control search-records list-actions-search"
                data-url="{{ $page['dynamic_search_url'] ?? '' }}" data-type="form" data-ajax-type="post"
                data-form-id="header-search" id="search_query" name="search_query"
                placeholder="{{ cleanLang(__('lang.search')) }}">
        </div>
        

        <!--TOGGLE STATS-->
        
        <!-- <button type="button" data-toggle="tooltip" title="{{ cleanLang(__('lang.quick_stats')) }}"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark js-toggle-stats-widget update-user-ux-preferences"
            data-type="statspanel" data-progress-bar="hidden"
            data-url-temp="{{ url('/') }}/{{ auth()->user()->team_or_contact }}/updatepreferences" data-url=""
            data-target="list-pages-stats-widget">
            <i class="ti-stats-up"></i>
        </button>
        -->

        <!--FILTERING-->
        @if(config('visibility.list_page_actions_filter_button'))
        <button type="button" data-toggle="tooltip" title="{{ cleanLang(__('lang.filter')) }}"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark js-toggle-side-panel"
            data-target="{{ $page['sidepanel_id'] ?? '' }}">
            <i class="mdi mdi-filter-outline"></i>
        </button>
        @endif


        <!--EXPORT-->
        @if(config('visibility.list_page_actions_exporting'))
        <button type="button" data-toggle="tooltip" title="@lang('lang.export_ticket')"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark js-toggle-side-panel"
            data-target="sidepanel-export-tickets">
            <i class="ti-export"></i>
        </button>
        @endif



        <!--ADD NEW ITEM-->
  
        <!-- <button type="button"
            class="btn btn-success btn-add-circle edit-add-modal-button reset-target-modal-form">
            <i class="ti-plus"></i>
        </button> -->

        
        <button type="button" class="btn btn-success btn-add-circle edit-add-modal-button reset-target-modal-form"
           onclick="openSharePopup()">
            <i class="ti-share"></i>
        </button>

        <a type="button" class="btn btn-success btn-add-circle edit-add-modal-button reset-target-modal-form"
            href="{{ url('ctickets/create') }}">
            <i class="ti-plus"></i>
        </a>
        

        <!--add new button (link)-->
        @if( config('visibility.list_page_actions_add_button_link'))
        <a id="fx-page-actions-add-button" type="button" class="btn btn-success btn-add-circle edit-add-modal-button"
            href="{{ $page['add_button_link_url'] ?? '' }}">
            <i class="ti-plus"></i>
        </a>
        @endif
    </div>
</div>


<!-- Popup Modal -->
<div id="shareModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:#fff; padding:20px; border:1px solid #ccc; z-index:1000;">
    <h2>Share with</h2>
    <div class="socail-platform">
    <a href="#" target="_blank" id="whatsapp">
     <img src="{{ asset('/public/images/whatsapp.png') }}" alt="" class="socailicons">
    </a>
    <a href="#" target="_blank" id="email" class="socailicons">
    <i class="ti-email" id="emailicon"></i>
    </a>
    </div>
    <input type="text" id="formLink" class="form-control" readonly style="width:100%;">
    <button class="btn btn-success btn-sm waves-effect text-left mt-2" onclick="copyLink()">Copy Link</button>
    <button class="btn btn-secondary btn-sm waves-effect text-left mt-2" onclick="closeSharePopup()">Close</button>
</div>

<!-- Overlay -->
<div id="overlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:500;"></div>

<script>

function openSharePopup() {
    // Make an AJAX request to generate and get the link
    fetch("{{ url('ctickets/generate-link') }}", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for security
        },
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('formLink').value = data.link; // Set the generated link
        document.getElementById('whatsapp').href  = "https://api.whatsapp.com/send?text="+data.link; // Set the generated link
        document.getElementById('email').href     = "mailto:?body="+data.link; // Set the generated link
        // Display the modal
        document.getElementById('shareModal').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while generating the link.');
    });
}

function closeSharePopup() {
    document.getElementById('shareModal').style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
}

function copyLink() {
    const linkInput = document.getElementById('formLink');
    linkInput.select();
    document.execCommand('copy');
    alert('Link copied to clipboard!');
}
</script>
