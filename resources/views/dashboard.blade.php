<x-app-layout>
    <div class="content">
        <div
            class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
            <div class="flex-grow-1 mb-1 mb-md-0">
                <h1 class="h3 fw-bold mb-2">@lang('locale.dashboard')</h1>
                <h2 class="h6 fw-medium fw-medium text-muted mb-0">
                    Hello <a class="fw-semibold" href="be_pages_generic_profile.html">{{ auth()->user()->name }}</a>.
                </h2>
            </div>
        </div>
        <div class="row items-push">
            <div class="col-sm-6 col-xxl-3">
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold">{{ $articles }}</dt>
                            <dd class="fs-sm fw-medium text-muted mb-0">@lang('locale.article', ['suffix'=>'s'])</dd>
                        </dl>
                        <div class="item item-rounded-lg bg-body-light">
                            <i class="si si-docs fs-3 text-primary"></i> <!-- Articles -->
                        </div>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                            href="{{ route('articles.index') }}">
                            <span>@lang('locale.view_all', ['param'=>__('locale.article', ['suffix'=>'s'])])</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6 col-xxl-3">
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold">{{ $podcasts }}</dt>
                            <dd class="fs-sm fw-medium text-muted mb-0">@lang('locale.podcast', ['suffix'=>'s'])</dd>
                        </dl>
                        <div class="item item-rounded-lg bg-body-light">
                            <i class="si si-microphone fs-3 text-primary"></i> <!-- Podcasts -->
                        </div>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                            href="{{ route('podcasts.index') }}">
                            <span>@lang('locale.view_all', ['param'=>__('locale.podcast', ['suffix'=>'s'])])</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6 col-xxl-3">
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold">{{ $categories }}</dt>
                            <dd class="fs-sm fw-medium text-muted mb-0">@lang('locale.category', ['suffix'=>app()->getLocale() == 'en' ? 'ies' : 's'])</dd>
                        </dl>
                        <div class="item item-rounded-lg bg-body-light">
                            <i class="si si-tag fs-3 text-primary"></i> <!-- Categories -->
                        </div>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                            href="{{ route('categories.index') }}">
                            <span>@lang('locale.view_all', ['param'=>__('locale.category', ['suffix'=>app()->getLocale() == 'en' ? 'ies' : 's'])])</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6 col-xxl-3">
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold">{{ $banners }}</dt>
                            <dd class="fs-sm fw-medium text-muted mb-0">@lang('locale.banner', ['suffix'=>'s'])</dd>
                        </dl>
                        <div class="item item-rounded-lg bg-body-light">
                            <i class="si si-picture fs-3 text-primary"></i> <!-- Banners -->
                        </div>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                            href="{{ route('banners.index') }}">
                            <span>@lang('locale.view_all', ['param'=>__('locale.banner', ['suffix'=>'s'])])</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/pages/be_pages_dashboard.min.js') }}"></script>
    @endpush
</x-app-layout>
