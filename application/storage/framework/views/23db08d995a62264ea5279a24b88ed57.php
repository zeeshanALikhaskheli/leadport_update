<!--CRUMBS CONTAINER (RIGHT)-->
<div class="col-md-12 col-lg-7 p-b-9 align-self-center text-right <?php echo e($page['list_page_actions_size'] ?? ''); ?> <?php echo e($page['list_page_container_class'] ?? ''); ?>"
    id="list-page-actions-container">
    <div id="list-page-actions">
        <!--SEARCH BOX-->
        <div class="header-search" id="header-search">
            <i class="sl-icon-magnifier"></i>
            <input type="text" class="form-control search-records list-actions-search"
                data-url="<?php echo e($page['dynamic_search_url'] ?? ''); ?>" data-type="form" data-ajax-type="post"
                data-form-id="header-search" id="search_query" name="search_query"
                placeholder="<?php echo e(cleanLang(__('lang.search'))); ?>">
        </div>

        <!--FILTERING-->
        <?php if(config('visibility.list_page_actions_filter_button')): ?>
        <button type="button" data-toggle="tooltip" title="<?php echo e(cleanLang(__('lang.filter'))); ?>"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark js-toggle-side-panel"
            data-target="<?php echo e($page['sidepanel_id'] ?? ''); ?>">
            <i class="mdi mdi-filter-outline"></i>
        </button>
        <?php endif; ?>

        <!--EXPORT-->
        <?php if(config('visibility.list_page_actions_exporting')): ?>
        <button type="button" data-toggle="tooltip" title="<?php echo app('translator')->get('lang.export_ticket'); ?>"
            class="list-actions-button btn btn-page-actions waves-effect waves-dark js-toggle-side-panel"
            data-target="sidepanel-export-tickets">
            <i class="ti-export"></i>
        </button>
        <?php endif; ?>

        

        <!--Add New Button (Link)-->
        <?php if(config('visibility.list_page_actions_add_button_link')): ?>
        <a id="fx-page-actions-add-button" type="button" class="btn btn-success btn-add-circle edit-add-modal-button"
            href="<?php echo e($page['add_button_link_url'] ?? ''); ?>">
            <i class="ti-plus"></i>
        </a>
        <?php endif; ?>
    </div>
</div>

<!-- Popup Modal -->
<div id="shareModal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:#fff; padding:20px; border:1px solid #ccc; z-index:1000;">
    <h2>Share with</h2>
    <div class="socail-platform">
        <a href="#" target="_blank" id="whatsapp">
            <img src="<?php echo e(asset('/public/images/whatsapp.png')); ?>" alt="" class="socailicons">
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
    fetch("<?php echo e(url('ctickets/generate-link')); ?>", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' // Include CSRF token for security
        },
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('formLink').value = data.link; // Set the generated link
        document.getElementById('whatsapp').href = "https://api.whatsapp.com/send?text=" + encodeURIComponent(data.link); // Set WhatsApp share link
        document.getElementById('email').href = "mailto:?subject=Check this out&body=" + encodeURIComponent(data.link); // Set email share link
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
<?php /**PATH C:\xampp\htdocs\leadport\application\resources\views/pages/emails/components/misc/list-page-actions.blade.php ENDPATH**/ ?>