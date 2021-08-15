@if(Auth::user()->is_admin)
<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="{{env('APP_URL') ?? 'https://alpana.org'}}">
            <img class="navbar-brand-full" src="{{env('APP_LOGO') ?? 'https://res.cloudinary.com/debjit/image/upload/v1598972041/149_50_logo_uas3uf.png'}}" width="118" height="46" alt="{{ trans('config.site_name') }}">
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.dashboard") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('dashboard') }}
            </a>
        </li>
                {{-- Exam Menu --}}
                <li class="c-sidebar-nav-dropdown {{ request()->is("admin.exam*") ? "c-show" : "" }}">
                    <a class="c-sidebar-nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                        </i>
                        {{ __('Exam') }}
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.exam.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/exam") || request()->is("admin/exam/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-list c-sidebar-nav-icon"></i>
                                {{ __('All Examinations') }}
                            </a>
                        </li>

                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.exam.create") }}" class="c-sidebar-nav-link {{ request()->is("admin/exam") || request()->is("admin/exam/create*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-plus c-sidebar-nav-icon"></i>
                                {{ __('Create Exam') }}
                            </a>
                        </li>
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.exam.trash") }}" class="c-sidebar-nav-link {{ request()->is("admin/exam") || request()->is("admin/exam/trash*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-trash c-sidebar-nav-icon"></i>
                                {{ __('Trash') }}
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Exam Menu --}}


        {{-- Subject Menu Start --}}
        <li class="c-sidebar-nav-dropdown {{ request()->is("admin.subject*") ? "c-show" : "" }}">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-bars c-sidebar-nav-icon">

                </i>
                {{ __('Subject') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.subject.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/subject") || request()->is("admin/subject/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-list c-sidebar-nav-icon">

                        </i>
                        {{ __('All Subjects') }}
                    </a>
                </li>

                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.subject.create") }}" class="c-sidebar-nav-link {{ request()->is("admin/subject") || request()->is("admin/subject/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-pen c-sidebar-nav-icon">

                        </i>
                        {{ __('Create Subject') }}
                    </a>
                </li>
            </ul>
        </li>
        {{-- Subject manu End --}}


        {{-- Question Bank Menu Start --}}
        <li class="c-sidebar-nav-dropdown {{ request()->is("admin.subject*") ? "c-show" : "" }}">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">

                <i class="fa-fw fas fa-question-circle c-sidebar-nav-icon">

                </i>
                {{ __('Question Bank') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.question.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/question") || request()->is("admin/question/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-th-list c-sidebar-nav-icon">

                        </i>
                        {{ __('Questions') }}
                    </a>
                </li>

                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.question.create") }}" class="c-sidebar-nav-link {{ request()->is("admin/question") || request()->is("admin/question/create*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-pen c-sidebar-nav-icon">

                        </i>
                        {{ __('Create a Question') }}
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.question.importform") }}" class="c-sidebar-nav-link {{ request()->is("admin/import") || request()->is("admin/question/import*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-retweet c-sidebar-nav-icon">
                        </i>
                        {{ __('Import / Export') }}
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.question.report") }}" class="c-sidebar-nav-link {{ request()->is("admin/question") || request()->is("admin/question/report*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-bug c-sidebar-nav-icon">

                        </i>
                        {{ __('Reports') }}
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.question.trash") }}" class="c-sidebar-nav-link {{ request()->is("admin/question") || request()->is("admin/question/trash*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-trash c-sidebar-nav-icon">

                        </i>
                        {{ __('Trash') }}
                    </a>
                </li>
            </ul>
        </li>
        {{-- Question Bank Menu End --}}

         {{-- Tags Start --}}
         <li class="c-sidebar-nav-dropdown {{ request()->is("admin.tag*") ? "c-show" : "" }}">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-bars c-sidebar-nav-icon">

                </i>
                {{ __('Tag') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.tag.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tag") || request()->is("admin/tag/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-list c-sidebar-nav-icon">

                        </i>
                        {{ __('All Tags') }}
                    </a>
                </li>

                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.tag.create") }}" class="c-sidebar-nav-link {{ request()->is("admin/tag") || request()->is("admin/tag/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-pen c-sidebar-nav-icon">

                        </i>
                        {{ __('Create tag') }}
                    </a>
                </li>
            </ul>
        </li>
        {{-- Subject Tags End --}}

    <li class="c-sidebar-nav-dropdown {{ request()->is("admin.details*") ? "c-show" : "" }}">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon"></i>
                {{ trans('settings') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a href="#{{-- route("admin.settings") --}}" class="c-sidebar-nav-link {{ request()->is("admin/settings") || request()->is("admin/settings/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-cog c-sidebar-nav-icon">

                        </i>
                        {{ trans('settings_site_details') }}
                    </a>
                </li>
            </ul>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-dropdown {{ request()->is("admin.usermanager*") ? "c-show" : "" }}">
                    <a class="c-sidebar-nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                        </i>
                        {{ trans('usermanager') }}
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.usermanager.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/usermanager") || request()->is("admin/usermanager/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-th-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('usermanager_index') }}
                            </a>
                        </li>

                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.usermanager.create") }}" class="c-sidebar-nav-link {{ request()->is("admin/usermanager") || request()->is("admin/usermanager/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-plus c-sidebar-nav-icon">

                                </i>
                                {{ trans('usermanager_create') }}
                            </a>
                        </li>
                    </ul>
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
                            <a class="c-sidebar-nav-link" href="{{ url()->current() }}?change_language={{ $langLocale }}"><i class="fa-fw fas Example of chevron-circle-right fa-chevron-circle-right c-sidebar-nav-icon">

                            </i> {{ $langName }} <span class="badge badge-danger">{{ strtoupper($langLocale) }}</span></a>
                        </li>
                    </ul>
                    @endforeach

                </li>
            </ul>
        </li>

        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">
                </i>
                {{ trans('logout') }}
            </a>
        </li>
    </ul>
</div>
@endif
