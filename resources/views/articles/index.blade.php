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
                    <h1 class="h3 fw-bold mb-1">@lang('locale.article', ['suffix'=>'s'])</h1>
                </div>
                <nav class="flex-shrink-0 mt-1 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">@lang('locale.article_management')</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">@lang('locale.article', ['suffix'=>'s'])</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="row items-push">
            <div class="col-xxl-8">
                @foreach ($articles as $item)
                <div class="block block-rounded">
                    <div class="block-content">
                        <div class="row items-push">
                            <div class="col-md-4 col-lg-5">
                                <a class="img-link img-link-simple" href="{{ route('articles.show', $item->id) }}">
                                    <img class="img-fluid rounded" src="{{ asset($item->path_resource) }}" alt="IMAGE" style="height: 180px">
                                </a>
                            </div>
                            <div class="col-md-8 col-lg-7 d-md-flex align-items-center">
                                <div class="w-100">
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        <h4 class="mb-0">
                                            <a class="text-dark" href="{{ route('articles.show', $item->id) }}">{{ $item->title }}</a>
                                        </h4>
                                        <div class="d-flex ms-2" style="gap: 0.5rem;" role="group" aria-label="Actions">
                                            <!-- Edit button -->
                                            <a href="{{ route('articles.edit', $item->id) }}" class="btn btn-sm btn-primary" title="@lang('locale.edit', ['param'=>''])">
                                                <i class="si si-pencil"></i>
                                            </a>
                                            @if (isauthorized([1, 2]))
                                            <!-- Delete button -->
                                            <form action="{{ route('articles.destroy', $item->id) }}" method="POST" onsubmit="return confirm('@lang('locale.confirm_delete')');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="@lang('locale.delete')">
                                                    <i class="si si-trash"></i>
                                                </button>
                                            </form>
                                            @endif                                            
                                        </div>
                                    </div>
                
                                    <div class="fs-sm fw-medium mb-3">
                                        <a>{{ $item->user->name }}</a> @lang('locale.published_at') {{ $item->created_at->locale(app()->getLocale())->translatedFormat('d F Y') }} · 
                                        <span class="text-muted">{{ $item->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="fs-sm text-muted text-justify">
                                        {{ Str::limit(strip_tags($item->content), 200) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                                
                @endforeach

                @if($articles->isNotEmpty())
                <nav aria-label="Page navigation">
                    <ul class="pagination push">
                        {{-- Lien "Précédent" --}}
                        <li class="page-item {{ $articles->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $articles->previousPageUrl() ?? 'javascript:void(0)' }}" aria-label="Previous">
                                <span aria-hidden="true"><i class="fa fa-angle-left"></i></span>
                                <span class="visually-hidden">Previous</span>
                            </a>
                        </li>
                
                        {{-- Numéros de pages --}}
                        @foreach ($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
                            <li class="page-item {{ $articles->currentPage() == $page ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach
                
                        {{-- Lien "Suivant" --}}
                        <li class="page-item {{ $articles->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $articles->nextPageUrl() ?? 'javascript:void(0)' }}" aria-label="Next">
                                <span aria-hidden="true"><i class="fa fa-angle-right"></i></span>
                                <span class="visually-hidden">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>  
                @endif              
            </div>
        </div>
    </div>
    <div class="bg-body-dark">
        <div class="content content-full">
            <div class="my-5 text-center">
                <h3 class="fw-bold mb-2">Une idée qui te trotte dans la tête ?</h3>
                <h4 class="h5 fw-medium opacity-75">
                    Envie de la partager ou de t’exprimer à travers un blog ? Clique sur le bouton ci-dessous et contribue à notre communauté de lecteurs passionnés !
                </h4>
                <a class="btn btn-primary px-4 py-2" href="{{ route('articles.create') }}">Commenter maintenant</a>
            </div>
        </div>
    </div>
</x-app-layout>
