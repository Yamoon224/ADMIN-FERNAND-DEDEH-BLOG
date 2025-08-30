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
                    <h1 class="h3 fw-bold mb-1">@lang('locale.exclusivity', ['suffix' => app()->getLocale() == 'en' ? 'ies' : 's'])</h1>
                </div>
                <nav class="flex-shrink-0 mt-1 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">@lang('locale.article_management')</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">@lang('locale.exclusivity', ['suffix' => app()->getLocale() == 'en' ? 'ies' : 's'])</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default d-flex align-items-center justify-content-between">
                <h3 class="block-title">
                    @lang('locale.exclusivity', ['suffix' => app()->getLocale() == 'en' ? 'ies' : 's'])
                </h3>
                <a role="button" data-bs-toggle="modal" data-bs-target="#add-exclusivity"
                   class="btn btn-sm btn-success">
                    <i class="si si-plus me-1"></i> @lang('locale.add', ['param' => ''])
                </a>
            </div>
            <div class="block-content block-content-full overflow-x-auto">
                <table class="table table-sm table-bordered table-striped table-vcenter js-dataTable-buttons">
                    <thead>
                        <th class="text-center">#</th>
                        <th class="d-none d-sm-table-cell">@lang('locale.title')</th>
                        <th class="d-none d-sm-table-cell">@lang('locale.body')</th>
                        <th class="d-none d-sm-table-cell">@lang('locale.actions')</th>
                    </thead>
                    <tbody>
                        @foreach ($exclusivities as $item)
                            <tr>
                                <td class="text-center fs-sm">{{ $loop->iteration }}</td>
                                <td class="fw-semibold fs-sm">{{ $item->title }}</td>
                                <td class="d-none d-sm-table-cell fs-sm">{{ $item->body ?? '---' }}</td>
                                <td class="d-none d-sm-table-cell fs-sm">
                                    <div class="d-flex gap-2">
                                        <a 
                                            role="button"
                                            class="btn btn-sm btn-primary"
                                            data-id="{{ $item->id }}"
                                            data-title="{{ $item->title }}"
                                            data-body="{{ $item->body }}"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#edit-exclusivity"
                                            onclick="openEditExclusivityModal(this)"
                                        >
                                            <i class="si si-note me-1"></i>
                                        </a>

                                        <form action="{{ route('exclusivities.destroy', $item->id) }}" method="post"
                                            onsubmit="return confirm('@lang('locale.confirm_delete')')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="si si-trash me-1"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Add Modal --}}
    <div class="modal fade" id="add-exclusivity" tabindex="-1" role="dialog" aria-labelledby="add-exclusivity" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default bg-success text-white">
                        <h3 class="block-title">@lang('locale.exclusivity', ['suffix' => app()->getLocale() == 'en' ? 'y' : ''])</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option text-danger" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form action="{{ route('exclusivities.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="created_by" value="{{ auth()->id() }}">
                        <div class="block-content fs-sm">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label class="form-label" for="title">@lang('locale.title') <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-alt" id="title" name="title" placeholder="@lang('locale.title')" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="body">@lang('locale.body') <span class="text-danger">*</span></label>
                                        <textarea name="body" id="body" cols="30" rows="5" class="form-control form-control-alt" placeholder="@lang('locale.body')" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-end bg-body">
                            <button class="btn btn-sm btn-success"><i class="si si-paper-plane me-1"></i> @lang('locale.submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="edit-exclusivity" tabindex="-1" role="dialog" aria-labelledby="edit-exclusivity" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default bg-primary text-white">
                        <h3 class="block-title">@lang('locale.exclusivity', ['suffix' => app()->getLocale() == 'en' ? 'y' : ''])</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option text-danger" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form method="POST" id="edit-exclusivity-form">
                        @csrf 
                        @method('PUT')
                        <input type="hidden" name="created_by" value="{{ auth()->id() }}">
                        <div class="block-content fs-sm">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label class="form-label" for="edit-exclusivity-title">@lang('locale.title') <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-alt" id="edit-exclusivity-title" name="title" placeholder="@lang('locale.title')" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="edit-exclusivity-body">@lang('locale.body') <span class="text-danger">*</span></label>
                                        <textarea name="body" id="edit-exclusivity-body" cols="30" rows="5" class="form-control form-control-alt" placeholder="@lang('locale.body')" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-end bg-body">
                            <button class="btn btn-sm btn-primary"><i class="si si-paper-plane me-1"></i> @lang('locale.submit')</button>
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
            });

            let openEditExclusivityModal = (button) => {
                const exclusivityId = button.getAttribute('data-id');
                const exclusivityTitle = button.getAttribute('data-title');
                const exclusivityBody = button.getAttribute('data-body');

                document.getElementById('edit-exclusivity-title').value = exclusivityTitle;
                document.getElementById('edit-exclusivity-body').value = exclusivityBody;

                const form = document.getElementById('edit-exclusivity-form');
                const baseUrl = document.querySelector('meta[name="app-url"]').getAttribute('content');
                form.action = `${baseUrl}/exclusivities/${exclusivityId}`;

                const modal = document.getElementById('edit-exclusivity');
                modal.classList.remove('hidden');
            }
        </script>
    @endpush
</x-app-layout>
