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
                    <input type="hidden" name="created_by" value="{{ auth()->id() }}">
                    <div class="row">
                        <div class="col-12">
                            @if (!$errors->isEmpty())
                            <p class="text-danger text-center">{{ implode(', ', $errors->all()) }}</p>
                            @endif
                        </div>
                        <div class="col-12">
                            <div class="mb-4">
                                <label class="form-label" for="published_at">@lang('locale.published_at') <span class="text-danger">*</span></label>
                                <input name="published_at" type="datetime-local" id="published_at" class="form-control form-control-alt" required></input>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="introduction">@lang('locale.introduction') <span class="text-danger">*</span></label>
                                <textarea name="introduction" id="introduction" cols="30" rows="5" class="form-control form-control-alt" placeholder="@lang('locale.introduction')" required></textarea>
                            </div>

                            <div class="block block-rounded p-2">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">@lang('locale.content', ['suffix'=>''])</h3>
                                </div>
                                <div class="block-content block-content-full">
                                    <div class="hashtag-row" data-index="0">
                                        <div class="row align-items-start border-bottom border-warning mb-4 p-4" style="border-bottom-width:2px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); border-radius: 0.5rem;">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="mb-4">
                                                    <label class="form-label" for="hashtag_id[0]">@lang('locale.hashtag', ['suffix'=>'']) <span class="text-danger">*</span></label>
                                                    <select class="form-select" id="hashtag_id[0]" name="hashtag_id[0]" required>
                                                        @foreach ($hashtags as $item)
                                                            <option value="{{ $item->id }}">{{ $item->hashtag }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                    
                                            <div class="col-lg-6 col-md-6">
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
                                
                                    <div class="row mt-2">
                                        <div class="col-12">
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
    
            // Fonction d'initialisation d'un éditeur
            function initEditor(editorId, hiddenId, index) {
                ClassicEditor
                    .create(document.querySelector('#' + editorId))
                    .then(editor => {
                        editors[index] = editor;
                        editor.model.document.on('change:data', () => {
                            document.querySelector('#' + hiddenId).value = editor.getData();
                        });
                    });
            }
    
            // Init du premier éditeur
            initEditor('editor0', 'content-hidden-0', 0);
    
            // Bouton "Ajouter hashtag"
            document.getElementById('addHashtag').addEventListener('click', function () {
                const rows = document.querySelectorAll('.hashtag-row');
                const lastRow = rows[rows.length - 1];
                const lastIndex = parseInt(lastRow.dataset.index);
                const newIndex = lastIndex + 1;
    
                // Cloner la ligne
                const newRow = lastRow.cloneNode(true);
                newRow.dataset.index = newIndex;
    
                // Nettoyer CKEditor cloné
                newRow.querySelectorAll('.ck-editor').forEach(el => el.remove());
    
                // Mise à jour des IDs, NAMES et reset des champs
                newRow.querySelectorAll('select, input, textarea, label').forEach(el => {
                    if (el.id) {
                        el.id = el.id.replace(/\[\d+\]|\d+$/, match =>
                            match.includes('[') ? `[${newIndex}]` : newIndex
                        );
                    }
                    if (el.name) {
                        el.name = el.name.replace(/\[\d+\]|\d+$/, match =>
                            match.includes('[') ? `[${newIndex}]` : newIndex
                        );
                    }
    
                    // reset uniquement les champs visibles
                    if ((el.tagName === 'TEXTAREA' || el.tagName === 'INPUT') && !el.hasAttribute('hidden')) {
                        el.value = '';
                    }
                });
    
                // Ajouter bouton supprimer si pas déjà présent
                if (!newRow.querySelector('.removeHashtag')) {
                    const removeBtn = document.createElement('button');
                    removeBtn.type = "button";
                    removeBtn.className = "btn btn-sm btn-danger removeHashtag mt-2";
                    removeBtn.innerHTML = '<i class="si si-trash"></i> Supprimer';
                    removeBtn.addEventListener('click', function () {
                        newRow.remove();
                    });
                    newRow.querySelector('.col-12:last-child').appendChild(removeBtn);
                }
    
                // Insérer dans la page
                lastRow.after(newRow);
    
                // Réinit CKEditor pour le nouveau textarea
                const newEditorId = `editor${newIndex}`;
                const newHiddenId = `content-hidden-${newIndex}`;
    
                const newEditor = newRow.querySelector(`textarea[id^="editor"]`);
                const newHidden = newRow.querySelector(`textarea[name^="body"]`);
    
                if (newEditor && newHidden) {
                    newEditor.id = newEditorId;
                    newHidden.id = newHiddenId;
                    initEditor(newEditorId, newHiddenId, newIndex);
                }
            });
        });
    </script>          
    @endpush
</x-app-layout>
