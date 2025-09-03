<x-app-layout>
    <div class="bg-body-light">
        <div class="content">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-1">@lang('locale.daily', ['suffix' => 's'])</h1>
                </div>
                <nav class="flex-shrink-0 mt-1 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">@lang('locale.posting')</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">@lang('locale.daily', ['suffix' => app()->getLocale() == 'en' ? 'ies' : 's'])</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default d-flex align-items-center">
                <h3 class="block-title mb-0">@lang('locale.daily', ['suffix' => app()->getLocale() == 'en' ? 'ies' : 's'])</h3>
                <a href="{{ route('dailies.create') }}" class="btn btn-sm btn-success ms-auto">
                    <i class="si si-plus me-1"></i> @lang('locale.add', ['param' => ''])
                </a>
            </div>

            <div class="block-content block-content-full overflow-x-auto">
                <div class="row">
                    @foreach ($dailies as $item)
                    <div class="col-12 border-bottom border-warning mb-4" style="border-bottom-width:2px;">
                        <h4 class="h5 mb-1">
                            <a href="{{ route('dailies.show', $item->id) }}" 
                               title="@lang('locale.show', ['param'=>__('locale.daily', ['suffix' => app()->getLocale() == 'en' ? 'y' : '']).' #'.$item->id])">
                                @lang('locale.daily', ['suffix' => app()->getLocale() == 'en' ? 'y' : '']) #{{ $item->id }}
                            </a>
                        </h4>
                    
                        <!-- Ligne infos + actions -->
                        <div class="d-flex justify-content-between align-items-center fs-sm fw-medium text-success mb-1">
                            <div>
                                @lang('locale.published_at') {{ $item->published_at->format('d/m/Y H:i') }} | 
                                @lang('locale.created_by'): {{ $item->user->name }}
                            </div>
                    
                            <!-- Boutons alignés avec btn-xs -->
                            <div class="btn-group btn-group-xs" role="group" aria-label="Actions">
                                <a href="{{ route('dailies.edit', $item->id) }}" class="btn btn-primary btn-xs" 
                                   title="@lang('locale.edit', ['param'=>''])">
                                    <i class="si si-pencil"></i>
                                </a>
                                <form action="{{ route('dailies.destroy', $item->id) }}" method="POST" 
                                      onsubmit="return confirm('@lang('locale.confirm_delete')');" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs" title="@lang('locale.delete')">
                                        <i class="si si-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    
                        <p class="fs-sm text-muted" style="text-align: justify">
                            {{ Str::limit($item->introduction, 700, '...') }}
                        </p>
                    </div>
                    @endforeach

                    @if($dailies->isNotEmpty())
                    <div class="d-flex justify-content-center mt-2">
                        <nav aria-label="Projects Search Navigation">
                            <ul class="pagination pagination-sm">
                                {{-- Lien "Précédent" --}}
                                <li class="page-item {{ $dailies->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $dailies->previousPageUrl() ?? 'javascript:void(0)' }}" aria-label="Previous">
                                        <span aria-hidden="true"><i class="fa fa-angle-left"></i></span>
                                        <span class="visually-hidden">Previous</span>
                                    </a>
                                </li>
                        
                                {{-- Numéros de pages --}}
                                @foreach ($dailies->getUrlRange(1, $dailies->lastPage()) as $page => $url)
                                    <li class="page-item {{ $dailies->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach
                        
                                {{-- Lien "Suivant" --}}
                                <li class="page-item {{ $dailies->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $dailies->nextPageUrl() ?? 'javascript:void(0)' }}" aria-label="Next">
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

    @push('scripts')
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    @endpush
</x-app-layout>
