<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php if (Auth::check()) { ?>
               <a class="navbar-brand" href="{{ URL::route('homeLogged') }}"><?= trans('base.appointments'); ?></a>
                <?php if (Auth::user()->role == \App\User::ROLE_CITIZEN) { ?>
                    <a class="navbar-brand" href="{{ URL::route('search_lawyers') }}"><?= trans('base.searchLawyers'); ?></a>
                <?php } ?>
            <?php } else { ?>
                <a class="navbar-brand" href="{{ URL::route('login') }}"><?= trans('base.siteTitle'); ?></a>
            <?php } ?>

        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <?php if (!Auth::check()) { ?>
                    <li><a href="{{ URL::route('login') }}"><?= trans('base.login'); ?></a></li>
                    <li><a href="{{ URL::route('register') }}"><?= trans('base.register'); ?></a></li>
                <?php } ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if (Auth::check()) { ?>
                    <?php if (Auth::user()->role == \App\User::ROLE_CITIZEN) { ?>
                        <li><a href="{{ URL::route('scheduled_appointments') }}"><?= trans('base.scheduledAppointments'); ?></a></li>
                    <?php } ?>

                    <li><a href="{{ URL::route('logout') }}"><?= trans('base.logout'); ?></a></li>
                <?php } ?>

                <li><a href="{{ URL::route('change_locale') }}"><?= trans('base.changeLanguage'); ?> (BG/EN)</a></li>

            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

