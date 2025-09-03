<x-app-layout>
    <div class="bg-body-light">
        <div class="content">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-1">@lang('locale.daily', ['suffix'=>app()->getLocale() == 'en' ? 'ies' : 's'])</h1>
                </div>
                <nav class="flex-shrink-0 mt-1 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="{{ route('dailies.index') }}">@lang('locale.posting')</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">@lang('locale.edit', ['param' => __('locale.daily', ['suffix'=>app()->getLocale() == 'en' ? 'y' : ''])])</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default bg-primary text-white">
                <h3 class="block-title">@lang('locale.form', ['param'=>__('locale.edit', ['param'=>__('locale.daily', ['suffix'=>app()->getLocale() == 'en' ? 'y' : ''])])])</h3>
            </div>

            <div class="block-content block-content-full">
                <form action="{{ route('dailies.update', $daily->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="created_by" value="{{ auth()->id() }}">

                    <div class="row">
                        {{-- Affichage des erreurs --}}
                        <div class="col-12">
                            @if (!$errors->isEmpty())
                                <p class="text-danger text-center">{{ implode(', ', $errors->all()) }}</p>
                            @endif
                        </div>

                        {{-- Published at --}}
                        <div class="col-12">
                            <div class="mb-4">
                                <label class="form-label" for="published_at">@lang('locale.published_at') <span class="text-danger">*</span></label>
                                <input name="published_at" type="datetime-local" id="published_at" 
                                       class="form-control form-control-alt" 
                                       value="{{ $daily->published_at->format('Y-m-d\TH:i') }}" required>
                            </div>
                        </div>

                        {{-- Introduction --}}
                        <div class="col-12">
                            <div class="mb-4">
                                <label class="form-label" for="introduction">@lang('locale.introduction') <span class="text-danger">*</span></label>
                                <textarea name="introduction" id="introduction" cols="30" rows="5" 
                                          class="form-control form-control-alt" required>{{ $daily->introduction }}</textarea>
                            </div>
                        </div>

                        {{-- Contenus associés --}}
                        <div class="col-12">
                            <div class="block block-rounded">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">@lang('locale.content', ['suffix'=>''])</h3>
                                </div>
                                <div class="block-content block-content-full">
                                    @foreach($daily->contents as $index => $content)
                                        <div class="hashtag-row" data-index="{{ $index }}">
                                            <div class="row align-items-start border-bottom border-warning mb-4 p-4" style="border-bottom-width:2px; box-shadow:0 4px 10px rgba(0,0,0,0.1); border-radius:0.5rem;">
                                                {{-- Hashtag --}}
                                                <div class="col-lg-6">
                                                    <div class="mb-4">
                                                        <label class="form-label" for="hashtag_id[{{ $index }}]">@lang('locale.hashtag') <span class="text-danger">*</span></label>
                                                        <select class="form-select" id="hashtag_id[{{ $index }}]" name="hashtag_id[{{ $index }}]" required>
                                                            @foreach ($hashtags as $item)
                                                                <option value="{{ $item->id }}" {{ $item->id == $content->hashtag_id ? 'selected' : '' }}>
                                                                    {{ $item->hashtag }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                {{-- Image --}}
                                                <div class="col-lg-6">
                                                    <div class="mb-4">
                                                        <label class="form-label" for="path_image[{{ $index }}]">@lang('locale.hashtag_image')</label>
                                                        <input type="file" class="form-control form-control-alt" id="path_image[{{ $index }}]" name="path_image[{{ $index }}]">
                                                        @if($content->path_image)
                                                            <img src="{{ asset($content->path_image) }}" alt="image" class="img-fluid rounded mt-1" style="max-height:120px;">
                                                        @endif
                                                    </div>
                                                </div>

                                                {{-- CKEditor --}}
                                                <div class="col-12">
                                                    <div class="mb-4">
                                                        <label class="form-label" for="editor{{ $index }}">@lang('locale.content') <span class="text-danger">*</span></label>
                                                        <textarea id="editor{{ $index }}" placeholder="@lang('locale.content')">{!! $content->body !!}</textarea>
                                                        <textarea name="body[{{ $index }}]" id="content-hidden-{{ $index }}" required hidden>{!! $content->body !!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    {{-- Bouton ajouter un hashtag --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="button" id="addHashtag" class="btn btn-md btn-success">
                                                <i class="si si-plus me-1"></i>
                                                @lang('locale.add', ['param'=>__('locale.hashtag')])
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- Bouton submit --}}
                        <div class="col-12">
                            <button type="submit" class="btn btn-md btn-primary w-100">
                                <i class="si si-paper-plane me-1"></i> @lang('locale.submit')
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        let editors = {};

        // Initialisation CKEditor pour chaque contenu existant
        document.querySelectorAll('.hashtag-row').forEach(row => {
            const index = row.dataset.index;
            const editorEl = document.querySelector(`#editor${index}`);
            const hiddenEl = document.querySelector(`#content-hidden-${index}`);

            ClassicEditor.create(editorEl)
                .then(editor => {
                    editors[index] = editor;
                    editor.model.document.on('change:data', () => {
                        hiddenEl.value = editor.getData();
                    });
                });
        });

        // Bouton ajouter un hashtag
        document.getElementById('addHashtag').addEventListener('click', function () {
            const rows = document.querySelectorAll('.hashtag-row');
            const lastRow = rows[rows.length - 1];
            const lastIndex = parseInt(lastRow.dataset.index);
            const newIndex = lastIndex + 1;

            const newRow = lastRow.cloneNode(true);
            newRow.dataset.index = newIndex;

            // Supprime CKEditor cloné
            newRow.querySelectorAll('.ck-editor').forEach(el => el.remove());

            // Update IDs & names
            newRow.querySelectorAll('select, input, textarea, label').forEach(el => {
                if (el.id) el.id = el.id.replace(/\[\d+\]|\d+$/, match => match.includes('[') ? `[${newIndex}]` : newIndex);
                if (el.name) el.name = el.name.replace(/\[\d+\]|\d+$/, match => match.includes('[') ? `[${newIndex}]` : newIndex);
                if ((el.tagName === 'TEXTAREA' || el.tagName === 'INPUT') && !el.hasAttribute('hidden')) el.value = '';
            });

            lastRow.after(newRow);

            // Initialise CKEditor pour le nouveau
            const newEditorEl = newRow.querySelector(`textarea[id^="editor"]`);
            const newHiddenEl = newRow.querySelector(`textarea[name^="body"]`);

            if (newEditorEl) {
                ClassicEditor.create(newEditorEl).then(editor => {
                    if (newHiddenEl) {
                        editor.model.document.on('change:data', () => {
                            newHiddenEl.value = editor.getData();
                        });
                    }
                });
            }
        });
    });
    </script>
    @endpush
</x-app-layout>
