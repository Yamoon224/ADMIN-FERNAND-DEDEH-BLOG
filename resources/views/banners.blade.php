<x-app-layout>
    @push('links')
        <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css') }}">
    @endpush

    <div class="bg-body-light">
        <div class="content">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-1">@lang('locale.banner', ['suffix' => 's'])</h1>
                </div>
                <nav class="flex-shrink-0 mt-1 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">@lang('locale.article_management')</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">@lang('locale.banner', ['suffix' => 's'])</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="block block-rounded overflow-hidden">
            <div class="block-header block-header-default d-flex align-items-center justify-content-between">
                <div class="block-title">
                    <ul class="nav nav-tabs nav-tabs-block" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" id="horizontal_banners-tab" data-bs-toggle="tab"
                                data-bs-target="#horizontal_banners" role="tab" aria-controls="horizontal_banners"
                                aria-selected="true">@lang('locale.horizontal_banners')</button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" id="sidebar_banners-tab" data-bs-toggle="tab"
                                data-bs-target="#sidebar_banners" role="tab" aria-controls="sidebar_banners"
                                aria-selected="false">@lang('locale.sidebar_banners')</button>
                        </li>
                    </ul>
                </div>
                <a role="button" data-bs-toggle="modal" data-bs-target="#add-banner" class="btn btn-sm btn-success">
                    <i class="si si-plus me-1"></i> @lang('locale.add', ['param' => ''])
                </a>
            </div>
            <div class="block-content tab-content overflow-hidden">
                <div class="tab-pane fade fade-up show active" id="horizontal_banners" role="tabpanel"
                    aria-labelledby="horizontal_banners-tab" tabindex="0">
                    @session('message')
                    <div class="fs-4 fw-semibold p-2 mb-4 border-start border-4 border-success bg-body-light">{{ session('message') }}</div>
                    @endsession
                    
                    @foreach ($horizontales as $item)
                    <div class="block block-rounded bg-transparent bg-image" style="background-image: url('{{ asset($item->image_path) }}');">
                        <div class="block-content block-content-full bg-primary-dark-op">
                            <div class="py-4 text-center">
                                <h1 class="h3 text-white fw-bold mb-2">{{ $item->position }}</h1>
                                <h2 class="h6 fw-medium text-white-75 mb-0">{{ $item->link }}</h2>
                                <div class="d-flex justify-content-center gap-2">
                                    <a 
                                        role="button"
                                        class="btn btn-sm btn-primary"
                                        data-id="{{ $item->id }}"
                                        data-link="{{ $item->link }}"
                                        data-position="{{ $item->position }}"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#edit-banner"
                                        onclick="openEditbannerModal(this)"
                                    >
                                        <i class="si si-note me-1"></i>
                                    </a>
                                
                                    <form action="{{ route('banners.destroy', $item->id) }}" method="post"
                                        onsubmit="return confirm('@lang('locale.confirm_delete')')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="si si-trash me-1"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    @if($horizontales->isNotEmpty())
                    <div class="d-flex justify-content-center">
                        <nav aria-label="Projects Search Navigation">
                            <ul class="pagination pagination-sm">
                                {{-- Lien "Précédent" --}}
                                <li class="page-item {{ $horizontales->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $horizontales->previousPageUrl() ?? 'javascript:void(0)' }}" aria-label="Previous">
                                        <span aria-hidden="true"><i class="fa fa-angle-left"></i></span>
                                        <span class="visually-hidden">Previous</span>
                                    </a>
                                </li>
                        
                                {{-- Numéros de pages --}}
                                @foreach ($horizontales->getUrlRange(1, $horizontales->lastPage()) as $page => $url)
                                    <li class="page-item {{ $horizontales->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach
                        
                                {{-- Lien "Suivant" --}}
                                <li class="page-item {{ $horizontales->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $horizontales->nextPageUrl() ?? 'javascript:void(0)' }}" aria-label="Next">
                                        <span aria-hidden="true"><i class="fa fa-angle-right"></i></span>
                                        <span class="visually-hidden">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    @endif              
                </div>
                <div class="tab-pane fade fade-up" id="sidebar_banners" role="tabpanel"
                    aria-labelledby="sidebar_banners-tab" tabindex="0">
                    <div class="row items-push">
                        @foreach ($verticales as $item)
                            <div class="col-md-6 col-xl-4">
                                <a class="block block-rounded bg-image h-100 mb-0" style="background-image: url({{ asset($item->image_path) }});" href="javascript:void(0)">
                                    <div class="block-content bg-black-50">
                                        <div class="mb-5 mb-sm-7 d-sm-flex justify-content-sm-between align-items-sm-center">
                                            <p><span class="badge bg-primary fw-bold p-2 text-uppercase">{{ $item->position }}</span></p>
                                            <p class="fs-sm"></p>
                                        </div>
                                        <p class="fw-medium text-white-75">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a 
                                                    role="button"
                                                    class="btn btn-sm btn-primary"
                                                    data-id="{{ $item->id }}"
                                                    data-link="{{ $item->link }}"
                                                    data-position="{{ $item->position }}"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#edit-banner"
                                                    onclick="openEditbannerModal(this)"
                                                >
                                                    <i class="si si-note me-1"></i>
                                                </a>
                                            
                                                <form action="{{ route('banners.destroy', $item->id) }}" method="post"
                                                    onsubmit="return confirm('@lang('locale.confirm_delete')')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="si si-trash me-1"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </p>
                                    </div>
                                </a>
                            </div>
                        
                        @endforeach
                    </div>

                    @if($verticales->isNotEmpty())
                    <div class="d-flex justify-content-center">
                        <nav aria-label="Projects Search Navigation">
                            <ul class="pagination pagination-sm">
                                {{-- Lien "Précédent" --}}
                                <li class="page-item {{ $verticales->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $verticales->previousPageUrl() ?? 'javascript:void(0)' }}" aria-label="Previous">
                                        <span aria-hidden="true"><i class="fa fa-angle-left"></i></span>
                                        <span class="visually-hidden">Previous</span>
                                    </a>
                                </li>
                        
                                {{-- Numéros de pages --}}
                                @foreach ($verticales->getUrlRange(1, $verticales->lastPage()) as $page => $url)
                                    <li class="page-item {{ $verticales->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach
                        
                                {{-- Lien "Suivant" --}}
                                <li class="page-item {{ $verticales->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $verticales->nextPageUrl() ?? 'javascript:void(0)' }}" aria-label="Next">
                                        <span aria-hidden="true"><i class="fa fa-angle-right"></i></span>
                                        <span class="visually-hidden">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-banner" tabindex="-1" role="dialog" aria-labelledby="add-banner"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default bg-success text-white">
                        <h3 class="block-title">@lang('locale.banner', ['suffix' => app()->getLocale() == 'en' ? 'y' : ''])</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option text-danger" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="created_by" value="{{ auth()->id() }}">
                        <div class="block-content fs-sm">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label class="form-label" for="name">@lang('locale.behind_link') <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-alt" id="link"
                                            name="link" placeholder="Ex: https://" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="position">@lang('locale.position') <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" id="position" name="position" required>
                                            <option value="">-- @lang('locale.select') --</option>
                                            @foreach ([
                                                        'HEADER' => 'En-tête',
                                                        'HOMEPAGE_TOP' => 'Accueil - Haut',
                                                        'HOMEPAGE_MIDDLE' => 'Accueil - Milieu',
                                                        'HOMEPAGE_BOTTOM' => 'Accueil - Bas',
                                                        'SIDEBAR_LEFT' => 'Barre latérale gauche',
                                                        'SIDEBAR_RIGHT' => 'Barre latérale droite',
                                                        'FOOTER' => 'Pied de page',
                                                        'POPUP' => 'Fenêtre pop-up',
                                                        'MOBILE_TOP' => 'Mobile - Haut',
                                                        'MOBILE_BOTTOM' => 'Mobile - Bas',
                                                    ] as $key => $item)
                                                <option value="{{ $key }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="image_path">@lang('locale.image') <span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control form-control-alt" id="image_path"
                                            name="image_path" placeholder="@lang('locale.image_path')" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-end bg-body">
                            <button class="btn btn-sm btn-success"><i class="si si-paper-plane me-1"></i>
                                @lang('locale.submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-banner" tabindex="-1" role="dialog" aria-labelledby="edit-banner" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default bg-primary text-white">
                        <h3 class="block-title">@lang('locale.banner', ['suffix' => app()->getLocale() == 'en' ? 'y' : ''])</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option text-danger" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form method="POST" id="edit-banner-form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="updated_by" value="{{ auth()->id() }}">
                        <div class="block-content fs-sm">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label class="form-label" for="edit-banner-link">@lang('locale.behind_link') <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-alt"
                                            id="edit-banner-link" name="link" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="edit-banner-position">@lang('locale.position') <span class="text-danger">*</span></label>
                                        <select class="form-select" id="edit-banner-position" name="position" required>
                                            <option value="">-- @lang('locale.select') --</option>
                                            @foreach ([
                                                'HEADER' => 'En-tête',
                                                'HOMEPAGE_TOP' => 'Accueil - Haut',
                                                'HOMEPAGE_MIDDLE' => 'Accueil - Milieu',
                                                'HOMEPAGE_BOTTOM' => 'Accueil - Bas',
                                                'SIDEBAR_LEFT' => 'Barre latérale gauche',
                                                'SIDEBAR_RIGHT' => 'Barre latérale droite',
                                                'FOOTER' => 'Pied de page',
                                                'POPUP' => 'Fenêtre pop-up',
                                                'MOBILE_TOP' => 'Mobile - Haut',
                                                'MOBILE_BOTTOM' => 'Mobile - Bas',
                                            ] as $key => $item)
                                                <option value="{{ $key }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="edit-banner-image">@lang('locale.image')</label>
                                        <input type="file" class="form-control form-control-alt"
                                            id="edit-banner-image" name="image_path">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-end bg-body">
                            <button class="btn btn-sm btn-primary"><i class="si si-paper-plane me-1"></i>
                                @lang('locale.submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
        <script>
            let openEditbannerModal = (button) => {
                const bannerId = button.getAttribute('data-id');
                const bannerPosition = button.getAttribute('data-position');
                const bannerLink = button.getAttribute('data-link');

                document.getElementById('edit-banner-position').value = bannerPosition;
                document.getElementById('edit-banner-link').value = bannerLink;

                const form = document.getElementById('edit-banner-form');
                const baseUrl = document.querySelector('meta[name="app-url"]').getAttribute('content');
                form.action = `${baseUrl}/banners/${bannerId}`;
            };
        </script>
    @endpush
</x-app-layout>
