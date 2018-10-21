<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">
                @lang('navigation.toggle_navigation')
            </span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ URL::route('adminDashboard') }}">
            @lang('navigation.application_name')
        </a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="{{ URL::route('postsDashboard') }}">@lang('navigation.blog_posts')</a>
            </li>
            <li>
                <a href="#">@lang('navigation.blog_categories')</a>
            </li>
            <li class="dropdown">
                <a href="{{ URL::route('authorsDashboard') }}">@lang('navigation.authors')</a>
            </li>
            <li>
                <a href="{{ URL::route('commentsDashboard') }}">@lang('navigation.comments')</a>
            </li>
            <li>
                <a href="{{ URL::route('pagesDashboard') }}">@lang('navigation.pages')</a>
            </li>
            <li>
                <a href="{{ URL::route('adminSettings') }}">@lang('navigation.settings')</a>
            </li>

        </ul>
        <ul class="nav navbar-nav pull-right">
            <li>
                <a href="{{ URL::route('logout') }}">
                    <i class="glyphicon glyphicon-log-out"></i>
                    @lang('navigation.logout')
                </a>
            </li>
        </ul>
    </div><!--/.nav-collapse -->
</nav>
