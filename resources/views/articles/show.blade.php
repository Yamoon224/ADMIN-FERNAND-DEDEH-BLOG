<x-app-layout> 
    <div class="bg-body-light">
        <div class="content">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-1">@lang('locale.article_details')</h1>
                </div>
                <nav class="flex-shrink-0 mt-1 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('articles.index') }}">@lang('locale.article', ['suffix'=>'s'])</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">@lang('locale.details')</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="bg-image" style="min-height: 300px; background-image: url('{{ asset($article->path_resource) }}');"></div>
    <div class="bg-body-extra-light">
        <div class="content">
            <div class="text-center fs-sm push mb-0">
                <h1 class="mt-2">{{ $article->title }}</h1>
                <span class="d-inline-block py-2 px-4 bg-body-light rounded">
                    <a class="link-effect fw-semibold">{{ $article->user->name }}</a> @lang('locale.published_at') {{ $article->created_at->locale(app()->getLocale())->translatedFormat('d F Y') }} &bull; <span>{{ $article->created_at->diffForHumans() }}</span>
                </span>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    <article class="story">
                        <p class="text-justify">{!! $article->content !!}</p>
                    </article>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
