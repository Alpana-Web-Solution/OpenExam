<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="{{env('APP_URL') ?? 'https://alpana.org'}}">
            <img class="navbar-brand-full" src="{{env('APP_LOGO') ?? 'https://res.cloudinary.com/debjit/image/upload/v1598972041/149_50_logo_uas3uf.png'}}" width="118" height="46" alt="{{ trans('config.site_name') }}">
        </a>
    </div>
    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("user.dashboard") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('dashboard') }}
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route("exam.index") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-book">

                </i>
                {{ trans('Exam') }}
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route("user.result") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-list">

                </i>
                {{ trans('Results') }}
            </a>
        </li>



            {{-- Subject Profile Start --}}
        <li class="c-sidebar-nav-dropdown {{ request()->is("user.profile*") ? "c-show" : "" }}">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-bars c-sidebar-nav-icon">

                </i>
                {{ __('Profile') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("user.profile") }}" class="c-sidebar-nav-link">
                        <i class="c-sidebar-nav-icon fas fa-user">

                        </i>
                        {{ trans('Edit Profile') }}
                    </a>
                </li>

                <li class="c-sidebar-nav-item">
                    <a href="{{ route("user.profile.password.form") }}" class="c-sidebar-nav-link {{ request()->is("user/profile/password/form") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-edit c-sidebar-nav-icon">

                        </i>
                        {{ __('Change Password') }}
                    </a>
                </li>
            </ul>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-dropdown">
                    <a href="#" class="c-sidebar-nav-dropdown-toggle">
                        <i class="fa-fw fas fa-language c-sidebar-nav-icon">

                        </i>
                        {{ trans('settings_language') }} [{{ strtoupper(app()->getLocale()) }}]
                    </a>
                    @foreach(['en'=>'English','bn'=>'বাংলা'] as $langLocale => $langName)
                    <ul class="c-sidebar-nav-dropdown-items">
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link" href="{{ url()->current() }}?change_language={{ $langLocale }}">
                                <i class="fa-fw fas Example of chevron-circle-right fa-chevron-circle-right c-sidebar-nav-icon">
                            </i> {{ $langName }} <span class="badge badge-danger">{{ strtoupper($langLocale) }}</span></a>
                        </li>
                    </ul>
                    @endforeach

                </li>
            </ul>
        </li>
        {{-- Profile manu End --}}

        <li class="c-sidebar-nav-item">
                <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">
                    </i>
                    {{ trans('logout') }}
                </a>
            </li>
        </ul>

    </div>
