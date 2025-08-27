<header id="page-header">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>
        <div class="d-flex align-items-center">
            <div class="dropdown d-inline-block ms-2">
                <button type="button" class="btn btn-sm btn-alt-secondary d-flex align-items-center"
                    id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <img class="rounded-circle" src="{{ uiavatar(auth()->user()->name) }}" alt="Header Avatar"
                        style="width: 21px;">
                    <span class="d-none d-sm-inline-block ms-2">{{ auth()->user()->name }}</span>
                    <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block opacity-50 ms-1 mt-1"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0"
                    aria-labelledby="page-header-user-dropdown">
                    <div class="p-3 text-center bg-body-light border-bottom rounded-top">
                        <img class="img-avatar img-avatar48 img-avatar-thumb"
                            src="{{ uiavatar(auth()->user()->name) }}" alt="">
                        <p class="mt-2 mb-0 fw-medium">{{ auth()->user()->name }}</p>
                        <p class="mb-0 text-muted fs-sm fw-medium">{{ auth()->user()->group->name }}</p>
                    </div>
                    <div class="p-2">
                        <a class="dropdown-item d-flex align-items-center justify-content-between"
                            href="{{ route('profile.edit') }}">
                            <span class="fs-sm fw-medium">@lang('locale.profile')</span>
                        </a>
                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('logout') }}">
                            <span class="fs-sm fw-medium">@lang('locale.logout')</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>