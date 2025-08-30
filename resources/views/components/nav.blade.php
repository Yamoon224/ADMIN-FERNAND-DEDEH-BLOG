<nav id="sidebar" aria-label="Main Navigation">
    <div class="content-header">
        <a class="fw-semibold text-dual" href="{{ route('dashboard') }}">
            <span class="smini-visible">
                <i class="fa fa-circle-notch text-primary"></i>
            </span>
            <span class="smini-hide fs-5 tracking-wider"><x-app-logo></x-app-logo></span>
        </a>
        <div class="d-flex align-items-center gap-1">
            <div class="dropdown">
                <button type="button" class="btn btn-sm btn-alt-secondary" id="sidebar-dark-mode-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="far fa-fw fa-moon" data-dark-mode-icon></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end smini-hide border-0"
                    aria-labelledby="sidebar-dark-mode-dropdown">
                    <button type="button" class="dropdown-item d-flex align-items-center gap-2"
                        data-toggle="layout" data-action="dark_mode_off" data-dark-mode="off">
                        <i class="far fa-sun fa-fw opacity-50"></i>
                        <span class="fs-sm fw-medium">Light</span>
                    </button>
                    <button type="button" class="dropdown-item d-flex align-items-center gap-2"
                        data-toggle="layout" data-action="dark_mode_on" data-dark-mode="on">
                        <i class="far fa-moon fa-fw opacity-50"></i>
                        <span class="fs-sm fw-medium">Dark</span>
                    </button>
                    <button type="button" class="dropdown-item d-flex align-items-center gap-2"
                        data-toggle="layout" data-action="dark_mode_system" data-dark-mode="system">
                        <i class="fa fa-desktop fa-fw opacity-50"></i>
                        <span class="fs-sm fw-medium">System</span>
                    </button>
                </div>
            </div>
            <div class="dropdown">
                <button type="button" class="btn btn-sm btn-alt-secondary" id="sidebar-themes-dropdown"
                    data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fa fa-fw fa-brush"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end fs-sm smini-hide border-0"
                    aria-labelledby="sidebar-themes-dropdown">
                    <button class="dropdown-item d-flex align-items-center justify-content-between fw-medium"
                        data-toggle="theme" data-theme="default">
                        <span>Default</span>
                        <i class="fa fa-circle text-default"></i>
                    </button>
                    <button class="dropdown-item d-flex align-items-center justify-content-between fw-medium"
                        data-toggle="theme" data-theme="assets/css/themes/amethyst.min-5.11.css">
                        <span>Amethyst</span>
                        <i class="fa fa-circle text-amethyst"></i>
                    </button>
                    <button class="dropdown-item d-flex align-items-center justify-content-between fw-medium"
                        data-toggle="theme" data-theme="assets/css/themes/city.min-5.11.css">
                        <span>City</span>
                        <i class="fa fa-circle text-city"></i>
                    </button>
                    <button class="dropdown-item d-flex align-items-center justify-content-between fw-medium"
                        data-toggle="theme" data-theme="assets/css/themes/flat.min-5.11.css">
                        <span>Flat</span>
                        <i class="fa fa-circle text-flat"></i>
                    </button>
                    <button class="dropdown-item d-flex align-items-center justify-content-between fw-medium"
                        data-toggle="theme" data-theme="assets/css/themes/modern.min-5.11.css">
                        <span>Modern</span>
                        <i class="fa fa-circle text-modern"></i>
                    </button>
                    <button class="dropdown-item d-flex align-items-center justify-content-between fw-medium"
                        data-toggle="theme" data-theme="assets/css/themes/smooth.min-5.11.css">
                        <span>Smooth</span>
                        <i class="fa fa-circle text-smooth"></i>
                    </button>
                    <div class="dropdown-divider d-dark-none"></div>
                    <a class="dropdown-item fw-medium d-dark-none" data-toggle="layout"
                        data-action="sidebar_style_light" href="javascript:void(0)">
                        <span>Sidebar Light</span>
                    </a>
                    <a class="dropdown-item fw-medium d-dark-none" data-toggle="layout"
                        data-action="sidebar_style_dark" href="javascript:void(0)">
                        <span>Sidebar Dark</span>
                    </a>
                    <div class="dropdown-divider d-dark-none"></div>
                    <a class="dropdown-item fw-medium d-dark-none" data-toggle="layout"
                        data-action="header_style_light" href="javascript:void(0)">
                        <span>Header Light</span>
                    </a>
                    <a class="dropdown-item fw-medium d-dark-none" data-toggle="layout"
                        data-action="header_style_dark" href="javascript:void(0)">
                        <span>Header Dark</span>
                    </a>
                </div>
            </div>
            <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout"
                data-action="sidebar_close" href="javascript:void(0)">
                <i class="fa fa-fw fa-times"></i>
            </a>
        </div>
    </div>
    <div class="js-sidebar-scroll">
        <div class="content-side">
            <ul class="nav-main">
                <li class="nav-main-item">
                    <a class="nav-main-link active" href="{{ route('dashboard') }}">
                        <i class="nav-main-link-icon si si-speedometer"></i>
                        <span class="nav-main-link-name">@lang('locale.dashboard')</span>
                    </a>
                </li>
                <li class="nav-main-heading">@lang('locale.article_management')</li>
                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::is('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                        <i class="nav-main-link-icon si si-tag"></i>
                        <span class="nav-main-link-name">@lang('locale.category', ['suffix'=>app()->getLocale() == 'en' ? 'ies' : 's'])</span>
                    </a>
                </li>  

                @if (isauthorized([1]))
                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::is('banners.*') ? 'active' : '' }}" href="{{ route('banners.index') }}">
                        <i class="nav-main-link-icon si si-picture"></i>
                        <span class="nav-main-link-name">@lang('locale.banner', ['suffix'=>'s'])</span>
                    </a>
                </li> 
                @endif

                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::is('comments.*') ? 'active' : '' }}" href="{{ route('comments.index') }}">
                        <i class="nav-main-link-icon si si-bubbles"></i>
                        <span class="nav-main-link-name">@lang('locale.comment', ['suffix'=>'s'])</span>
                    </a>
                </li>
                
                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::is('hashtags.*') ? 'active' : '' }}" href="{{ route('hashtags.index') }}">
                        <i class="nav-main-link-icon si si-tag"></i>
                        <span class="nav-main-link-name">@lang('locale.hashtag', ['suffix'=>'s'])</span>
                    </a>
                </li>
                
                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::is('questions.*') ? 'active' : '' }}" href="{{ route('questions.index') }}">
                        <i class="nav-main-link-icon si si-info"></i>
                        <span class="nav-main-link-name">@lang('locale.question', ['suffix'=>'s'])</span>
                    </a>
                </li>

                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::is('articles.*') ? 'active' : '' }}" href="{{ route('articles.index') }}">
                        <i class="nav-main-link-icon si si-docs"></i>
                        <span class="nav-main-link-name">@lang('locale.article', ['suffix'=>'s'])</span>
                    </a>
                </li> 

                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::is('dailies.*') ? 'active' : '' }}" href="{{ route('dailies.index') }}">
                        <i class="nav-main-link-icon si si-docs"></i>
                        <span class="nav-main-link-name">@lang('locale.daily', ['suffix'=>app()->getLocale() == 'en' ? 'ies' : 's'])</span>
                    </a>
                </li> 
                
                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::is('exclusivities.*') ? 'active' : '' }}" href="{{ route('exclusivities.index') }}">
                        <i class="nav-main-link-icon si si-flag"></i>
                        <span class="nav-main-link-name">@lang('locale.exclusivity', ['suffix'=>app()->getLocale() == 'en' ? 'ies' : 's'])</span>
                    </a>
                </li> 
                
                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::is('podcasts.index') ? 'active' : '' }}" href="{{ route('podcasts.index') }}">
                        <!-- Remplacer l'icône par un micro ou podcast -->
                        <i class="nav-main-link-icon si si-microphone"></i>
                        <span class="nav-main-link-name">@lang('locale.podcast', ['suffix'=>'s'])</span>
                    </a>
                </li>
                
                @if (isauthorized([1]))
                <li class="nav-main-heading">@lang('locale.user_management')</li>
                <li class="nav-main-item">
                    <a class="nav-main-link  {{ Route::is('groups.*') ? 'active' : '' }}" href="{{ route('groups.index') }}">
                        <i class="nav-main-link-icon si si-people"></i>
                        <span class="nav-main-link-name">@lang('locale.group', ['suffix'=>'s'])</span>
                    </a>
                </li>    
                <li class="nav-main-item">
                    <a class="nav-main-link {{ Route::is('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                        <i class="nav-main-link-icon si si-user"></i>
                        <span class="nav-main-link-name">@lang('locale.user', ['suffix'=>'s'])</span>
                    </a>
                </li>                    
                @endif
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('logout') }}">
                        <i class="nav-main-link-icon si si-power"></i>
                        <span class="nav-main-link-name">@lang('locale.logout')</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>