<!--google calendar-->
<li class="sidenav-menu-item {{ $page['mainmenu_calendar'] ?? '' }} menu-tooltip menu-with-tooltip"
    title="{{ cleanLang(__('lang.calendar')) }}">
    <a class="waves-effect waves-dark" href="{{ url('app-admin/eventss') }}" aria-expanded="false" target="_self">
         <i class="ti-calendar"></i>
        <span class="hide-menu">{{ cleanLang(__('lang.calendar')) }}
        </span>
    </a>
</li>
