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
                            <a class="link-fx" href="javascript:void(0)">@lang('locale.article_management')</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">@lang('locale.daily', ['suffix' => app()->getLocale() == 'en' ? 'ies' : 's'])</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="block block-rounded">
            <div class="block-content block-content-full overflow-x-auto">
                <div class="row">
                    <div class="col-12 border-bottom border-warning" style="border-bottom-width:2px;">
                        <h4 class="h5 mb-1">
                            <a href="{{ route('dailies.edit', $daily->id) }}" title="@lang('locale.edit', ['param'=>__('locale.daily', ['suffix' => app()->getLocale() == 'en' ? 'y' : '']).' #'.$daily->id])">
                                @lang('locale.daily', ['suffix' => app()->getLocale() == 'en' ? 'y' : '']) #{{ $daily->id }}
                            </a>
                        </h4>
                        <div class="fs-sm fw-medium text-success mb-1">
                            @lang('locale.published_at') {{ $daily->published_at->format('d/m/Y H:i') }} | 
                            @lang('locale.created_by'): {{ $daily->user->name }}
                        </div>
                        <p class="fs-sm text-muted" style="text-align: justify">
                            {{ $daily->introduction }}
                        </p>
                    </div>

                    @foreach ($daily->contents as $item)
                    <div class="block block-rounded">
                        <div class="block-content">
                            {{-- Badge du hashtag --}}
                            <span class="badge bg-warning text-dark mb-2">
                                #{{ $item->hashtag->hashtag ?? 'NoHashtag' }}
                            </span>
                    
                            <a class="img-link img-link-simple float-start me-3 mb-2" 
                               href="{{ route('contents.show', $item->id) }}">
                                <img class="img-fluid rounded" 
                                     src="{{ asset($item->path_image) }}" 
                                     alt="IMAGE" 
                                     style="height: 180px; width:auto;">
                            </a>
                    
                            <p class="fs-sm text-muted" style="text-align: justify">
                                {{ $item->body }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    @endpush
</x-app-layout>
