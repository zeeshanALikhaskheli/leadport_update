<!--google calendar-->
<li class="sidenav-menu-item {{ $page['mainmenu_calendar'] ?? '' }} menu-tooltip menu-with-tooltip"
    title="{{ cleanLang(__('lang.calendar')) }}">
    <a class="waves-effect waves-dark" href="{{ url('eventss') }}" aria-expanded="false" target="_self">
         <i class="ti-calendar"></i>
        <span class="hide-menu">{{ cleanLang(__('lang.calendar')) }}
        </span>
    </a>
</li>
<!--google calendar-->
<li class="sidenav-menu-item } menu-tooltip menu-with-tooltip"
    title="{{ cleanLang(__('Emails')) }}">
    <a class="waves-effect waves-dark" href="{{ route('emails.index') }}" aria-expanded="false" target="_self">
         <i class="ti-email"></i>
        <span class="hide-menu">Emails
        </span>
    </a>
</li>

<!--custom tickets-->
<li class="sidenav-menu-item {{ $page['mainmenu_ctickets'] ?? '' }} menu-tooltip menu-with-tooltip"
    title="{{ cleanLang(__('lang.tickets')) }}">
    <a class="waves-effect waves-dark" href="{{ url('ctickets/index') }}" aria-expanded="false" target="_self">
          <i class="ti-comments"></i>
        <span class="hide-menu">{{ cleanLang(__('lang.tickets')) }}
        </span>
    </a>
</li>
