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
                    <h1 class="h3 fw-bold mb-1">@lang('locale.hashtag', ['suffix' => app()->getLocale() == 'en' ? 's' : ''])</h1>
                </div>
                <nav class="flex-shrink-0 mt-1 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">@lang('locale.hashtag_management')</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">@lang('locale.hashtag', ['suffix' => app()->getLocale() == 'en' ? 's' : ''])</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default d-flex align-items-center justify-content-between">
                <h3 class="block-title">@lang('locale.hashtag', ['suffix'=>'s'])</h3>
                <a role="button" data-bs-toggle="modal" data-bs-target="#add-hashtag" class="btn btn-sm btn-success">
                    <i class="si si-plus me-1"></i> @lang('locale.add', ['param' => ''])
                </a>
            </div>
            <div class="block-content block-content-full overflow-x-auto">
                <table class="table table-sm table-bordered table-striped table-vcenter js-dataTable-buttons">
                    <thead>
                        <th class="text-center">#</th>
                        <th class="d-none d-sm-table-cell">@lang('locale.hashtag', ['suffix'=>''])</th>
                        <th class="d-none d-sm-table-cell">@lang('locale.actions')</th>
                    </thead>
                    <tbody>
                        @foreach ($hashtags as $item)
                            <tr>
                                <td class="text-center fs-sm">{{ $loop->iteration }}</td>
                                <td class="fw-semibold fs-sm">{{ $item->hashtag }}</td>
                                <td class="d-none d-sm-table-cell fs-sm">
                                    <div class="d-flex gap-2">
                                        <a role="button"
                                           class="btn btn-sm btn-primary"
                                           data-id="{{ $item->id }}"
                                           data-hashtag="{{ $item->hashtag }}"
                                           data-bs-toggle="modal" 
                                           data-bs-target="#edit-hashtag"
                                           onclick="openEditHashtagModal(this)">
                                            <i class="si si-note me-1"></i>
                                        </a>

                                        <form action="{{ route('hashtags.destroy', $item->id) }}" method="post"
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
    <div class="modal fade" id="add-hashtag" tabindex="-1" role="dialog" aria-labelledby="add-hashtag" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default bg-success text-white">
                        <h3 class="block-title">@lang('locale.hashtag', ['suffix'=>''])</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option text-danger" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form action="{{ route('hashtags.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="created_by" value="{{ auth()->id() }}">
                        <div class="block-content fs-sm">
                            <div class="mb-4">
                                <label class="form-label" for="hashtag">@lang('locale.hashtag', ['suffix'=>'']) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-alt" id="hashtag" name="hashtag" placeholder="@lang('locale.hashtag', ['suffix'=>''])" required>
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
    <div class="modal fade" id="edit-hashtag" tabindex="-1" role="dialog" aria-labelledby="edit-hashtag" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default bg-primary text-white">
                        <h3 class="block-title">@lang('locale.hashtag', ['suffix'=>''])</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option text-danger" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form method="POST" id="edit-hashtag-form">
                        @csrf 
                        @method('PUT')
                        <input type="hidden" name="created_by" value="{{ auth()->id() }}">
                        <div class="block-content fs-sm">
                            <div class="mb-4">
                                <label class="form-label" for="edit-hashtag-field">@lang('locale.hashtag', ['suffix'=>'']) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-alt" id="edit-hashtag-field" name="hashtag" required>
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
            })

            let openEditHashtagModal = (button) => {
                const id = button.getAttribute('data-id');
                const hashtag = button.getAttribute('data-hashtag');

                document.getElementById('edit-hashtag-field').value = hashtag;  

                const form = document.getElementById('edit-hashtag-form');
                const baseUrl = document.querySelector('meta[name="app-url"]').getAttribute('content');
                form.action = `${baseUrl}/hashtags/${id}`;

                const modal = document.getElementById('edit-hashtag');
                modal.classList.remove('hidden');
            }
        </script>
    @endpush
</x-app-layout>
