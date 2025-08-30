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
                            <a class="link-fx" href="javascript:void(0)">@lang('locale.article_management')</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">@lang('locale.add', ['param' => __('locale.daily', ['suffix'=>app()->getLocale() == 'en' ? 'y' : ''])])</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default bg-success text-white">
                <h3 class="block-title">@lang('locale.form', ['param'=>__('locale.add', ['param'=>__('locale.daily', ['suffix'=>app()->getLocale() == 'en' ? 'y' : ''])])])</h3>
            </div>
            <div class="block-content block-content-full">
                <form action="{{ route('dailies.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            @if (!$errors->isEmpty())
                            <p class="text-danger text-center">{{ implode(', ', $errors->all()) }}</p>
                            @endif
                        </div>
                        <div class="col-12">
                            <div class="mb-4">
                                <label class="form-label" for="introduction">@lang('locale.introduction') <span class="text-danger">*</span></label>
                                <textarea name="body" id="introduction" cols="30" rows="5" class="form-control form-control-alt" placeholder="@lang('locale.introduction')" required></textarea>
                            </div>
                            
                            <div class="block block-rounded">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">@lang('locale.content', ['suffix'=>''])</h3>
                                </div>
                                <div class="block-content block-content-full">
                                    <div class="hashtag-row" data-index="0">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-4">
                                                    <label class="form-label" for="hashtag_id[0]">@lang('locale.hashtag', ['suffix'=>'']) <span class="text-danger">*</span></label>
                                                    <select class="form-select" id="hashtag_id[0]" name="hashtag_id[0]" required>
                                                        @foreach ($hashtags as $item)
                                                            <option value="{{ $item->id }}">{{ $item->hashtag }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                    
                                            <div class="col-lg-6">
                                                <div class="mb-4">
                                                    <label class="form-label" for="path_image[0]">@lang('locale.hashtag_image')</label>
                                                    <input type="file" class="form-control form-control-alt" id="path_image[0]" name="path_image[0]" placeholder="@lang('locale.path_image')">
                                                </div>
                                            </div>
                                    
                                            <div class="col-12">
                                                <div class="mb-4">
                                                    <label class="form-label" for="editor0">@lang('locale.content') <span class="text-danger">*</span></label>
                                                    <!-- CKEditor visible -->
                                                    <textarea id="editor0" placeholder="@lang('locale.content')"></textarea>
                                    
                                                    <!-- textarea masqué qui sera soumis -->
                                                    <textarea name="body[0]" id="content-hidden-0" required maxlength="10000" hidden></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                   
                                
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Bouton -->
                                            <button type="button" id="addHashtag" class="btn btn-md btn-success">
                                                <i class="si si-plus me-1"></i> 
                                                @lang('locale.add', ['param'=>__('locale.hashtag', ['suffix'=>''])])
                                            </button>
                                        </div>
                                    </div>                               
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-md btn-success w-100">
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
            let editors = {}; // stocke les instances CKEditor

            // Initialise le premier éditeur
            ClassicEditor
                .create(document.querySelector('#editor0'))
                .then(editor => {
                    editors[0] = editor;
                    editor.model.document.on('change:data', () => {
                        document.querySelector('#content-hidden-0').value = editor.getData();
                    });
                });

            // Bouton "Ajouter hashtag"
            document.getElementById('addHashtag').addEventListener('click', function () {
                const rows = document.querySelectorAll('.hashtag-row');
                if (rows.length === 0) {
                    console.error("Aucune .hashtag-row trouvée !");
                    return;
                }

                const lastRow = rows[rows.length - 1]; // le dernier élément

                const lastIndex = parseInt(lastRow.dataset.index);
                const newIndex = lastIndex + 1;

                // Cloner la ligne
                const newRow = lastRow.cloneNode(true);
                newRow.dataset.index = newIndex;

                // Mise à jour des IDs et NAMES
                newRow.querySelectorAll('select, input, textarea, label').forEach(el => {
                    if (el.id) el.id = el.id.replace(/\[\d+\]|\d+$/, match => match.includes('[') ? `[${newIndex}]` : newIndex);
                    if (el.name) el.name = el.name.replace(/\[\d+\]|\d+$/, match => match.includes('[') ? `[${newIndex}]` : newIndex);

                    // vider seulement les champs éditables visibles (pas les hidden)
                    if (el.tagName === 'TEXTAREA' || el.tagName === 'INPUT') {
                        if (!el.hasAttribute('hidden')) {
                            el.value = '';
                        }
                    }
                });

                lastRow.after(newRow);

                // Réinit CKEditor pour le nouveau textarea
                const newEditor = newRow.querySelector(`textarea[id^="editor"]`);
                const newHidden = newRow.querySelector(`textarea[name^="body"]`);

                if (newEditor) {
                    ClassicEditor
                        .create(newEditor)
                        .then(editor => {
                            if (newHidden) {
                                editor.model.document.on('change:data', () => {
                                    newHidden.value = editor.getData();
                                });
                            }
                        });
                }
            });
        });
    </script>         
    @endpush
</x-app-layout>
