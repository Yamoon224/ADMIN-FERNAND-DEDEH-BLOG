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
        <div class="block block-rounded">
            <div class="block-header block-header-default d-flex align-items-center justify-content-between">
                <h3 class="block-title">
                    @lang('locale.banner', ['suffix' => 's'])
                </h3>
                <a role="button" data-bs-toggle="modal" data-bs-target="#add-banner" class="btn btn-sm btn-success">
                    <i class="si si-plus me-1"></i> @lang('locale.add', ['param' => ''])
                </a>
            </div>
            <div class="block-content block-content-full overflow-x-auto">
                @foreach ($banners as $item)
                <div class="col-12 col-md-6">
                    <a class="block block-rounded" href="{{ $item->link }}">
                        <div class="block-content">
                            <p class="text-center py-6">...</p>
                        </div>
                    </a>
                </div>
                @endforeach
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
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="created_by" value="{{ auth()->id() }}">
                        <div class="block-content fs-sm">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label class="form-label" for="name">@lang('locale.bannername') <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-alt" id="name"
                                            name="name" placeholder="@lang('locale.bannername')" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="phone">@lang('locale.description')</label>
                                        <textarea name="description" id="" cols="30" rows="5" class="form-control form-control-alt"
                                            placeholder="@lang('locale.description')"></textarea>
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

    <div class="modal fade" id="edit-banner" tabindex="-1" role="dialog" aria-labelledby="edit-banner"
        aria-hidden="true">
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
                    <form method="POST" id="edit-banner-form">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="created_by" value="{{ auth()->id() }}">
                        <div class="block-content fs-sm">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label class="form-label" for="edit-banner-name">@lang('locale.bannername') <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-alt"
                                            id="edit-banner-name" name="name" placeholder="@lang('locale.bannername')"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label"
                                            for="edit-banner-description">@lang('locale.description')</label>
                                        <textarea name="description" id="edit-banner-description" cols="30" rows="5"
                                            class="form-control form-control-alt" placeholder="@lang('locale.description')"></textarea>
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
        <script src="{{ asset('js/plugins/datatables/dataTables.min.js') }}"></script>
        <script src="{{ asset('js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
        <script src="{{ asset('js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
        <script>
            "use strict";
            $(".js-dataTable-buttons").DataTable({
                pagingType: "simple_numbers",
                layout: {
                    topStart: {
                        buttons: ["copy", "excel", "csv", "pdf", "print"]
                    }
                },
                pageLength: 10,
                autoWidth: !1
            })

            let openEditbannerModal = (button) => {
                const bannerId = button.getAttribute('data-id');
                const bannerName = button.getAttribute('data-name');
                const bannerDesc = button.getAttribute('data-description');

                document.getElementById('edit-banner-name').value = bannerName;
                document.getElementById('edit-banner-description').value = bannerDesc;

                const form = document.getElementById('edit-banner-form');
                const baseUrl = document.querySelector('meta[name="app-url"]').getAttribute('content');
                form.action = `${baseUrl}/categories/${bannerId}`;

                const modal = document.getElementById('edit-banner');
                modal.classList.remove('hidden');
            }
        </script>
        {{-- <script src="{{ asset('js/pages/be_tables_datatables.min.js') }}"></script> --}}
    @endpush
</x-app-layout>
