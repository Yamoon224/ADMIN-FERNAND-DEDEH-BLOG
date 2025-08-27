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
                    <h1 class="h3 fw-bold mb-1">@lang('locale.user', ['suffix'=>'s'])</h1>
                </div>
                <nav class="flex-shrink-0 mt-1 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">@lang('locale.user_management')</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">@lang('locale.user', ['suffix'=>'s'])</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default d-flex align-items-center">
                <h3 class="block-title mb-0">@lang('locale.user', ['suffix'=>'s'])</h3>
                <a href="{{ route('users.create') }}" class="btn btn-sm btn-success ms-auto">
                    <i class="si si-plus me-1"></i> @lang('locale.add', ['param'=>''])
                </a>
            </div>
            
            <div class="block-content block-content-full overflow-x-auto">
                <table class="table table-sm table-bordered table-striped table-vcenter js-dataTable-buttons">
                    <thead>
                        <th class="text-center">#</th>
                        <th class="d-none d-sm-table-cell">@lang('locale.created_at')</th>
                        <th class="d-none d-sm-table-cell">@lang('locale.name')</th>
                        <th class="d-none d-sm-table-cell">@lang('locale.email')</th>
                        <th class="d-none d-sm-table-cell">@lang('locale.phone')</th>
                        <th class="d-none d-sm-table-cell">@lang('locale.groupname')</th>
                        <th class="d-none d-sm-table-cell">@lang('locale.actions')</th>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                        <tr>
                            <td class="text-center fs-sm">{{ $loop->iteration }}</td>
                            <td class="fw-semibold fs-sm">{{ $item->created_at->format('d/m/Y H:i:s') }}</td>
                            <td class="fw-semibold fs-sm">{{ $item->name }}</td>
                            <td class="fw-semibold fs-sm">{{ $item->email }}</td>
                            <td class="fw-semibold fs-sm">{{ $item->phone }}</td>
                            <td class="d-none d-sm-table-cell fs-sm">{{ $item->group->name }}</td>
                            <td class="d-none d-sm-table-cell fs-sm">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('users.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                        <i class="si si-note me-1"></i>
                                    </a>
                            
                                    <form action="{{ route('users.destroy', $item->id) }}" method="post"
                                        onsubmit="return confirm('Confirmez-vous cette suppression ?')">
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
                pagingType:"simple_numbers",
                layout:{
                    topStart:{
                        buttons:["copy","excel","csv","pdf","print"]
                    }
                },
                pageLength:10,
                autoWidth:!1
            })
        </script>
        {{-- <script src="{{ asset('js/pages/be_tables_datatables.min.js') }}"></script> --}}
    @endpush
</x-app-layout>
