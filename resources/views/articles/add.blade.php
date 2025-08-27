<x-app-layout>
    @push('links')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css"/>
    @endpush

    <div class="bg-body-light">
        <div class="content">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-1">@lang('locale.article', ['suffix' => 's'])</h1>
                </div>
                <nav class="flex-shrink-0 mt-1 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">@lang('locale.article_management')</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">@lang('locale.add', ['param' => __('locale.article', ['suffix' => ''])])</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">@lang('locale.form', ['param'=>__('locale.add', ['param'=>__('locale.article', ['suffix' => ''])])])</h3>
            </div>
            <div class="block-content block-content-full">
                <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="created_by" value="{{ auth()->id() }}">
                    <div class="row">
                        <div class="col-12">
                            @if (!$errors->isEmpty())
                            <p class="text-danger text-center">{{ implode(', ', $errors->all()) }}</p>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label" for="type">@lang('locale.type') <span class="text-danger">*</span></label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="">-- @lang('locale.select') --</option>
                                    @foreach (['ARTICLE', 'PODCAST'] as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>                          
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label" for="category_id">@lang('locale.category', ['suffix' => app()->getLocale() == 'en' ? 'y' : ''])</label>
                                <select class="form-select" id="category_id" name="category_id">
                                    <option value="">-- @lang('locale.select') --</option>
                                    @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>                            
                        </div>
                        <div class="col-12">
                            <div class="mb-4">
                                <label class="form-label" for="title">@lang('locale.title') <span class="text-danger">*</span></label>
                                <textarea class="form-control form-control-alt" id="title" name="title" placeholder="@lang('locale.title')" required></textarea>
                            </div>
                        
                            <div class="mb-4" id="file-wrapper">
                                <label class="form-label">@lang('locale.article_image') <span class="text-danger">*</span></label>
                                <input 
                                    type="file" 
                                    name="path_file" 
                                    id="uploaded_file" 
                                    class="form-control form-control-alt" 
                                    accept="image/*"
                                >
                            </div>
                            <div class="mb-4 d-none" id="text-wrapper">
                                <label class="form-label">@lang('locale.podcast_url') <span class="text-danger">*</span></label>
                                <input 
                                    type="text" 
                                    name="path_text" 
                                    id="text_input" 
                                    class="form-control form-control-alt"
                                    placeholder="https://..."
                                >
                            </div>
                        
                            <div class="mb-4">
                                <label class="form-label" for="content">@lang('locale.content') <span class="text-danger">*</span></label>
                                <!-- CKEditor visible -->
                                <textarea id="editor" placeholder="@lang('locale.content')"></textarea>

                                <!-- textarea masqué qui sera soumis -->
                                <textarea name="content" id="content-hidden" required maxlength="10000" hidden></textarea>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <button type="submit" class="btn btn-md btn-warning w-100">
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
        document.addEventListener("DOMContentLoaded", function() {
            const typeSelect   = document.getElementById('type');
            const fileWrapper  = document.getElementById('file-wrapper');
            const textWrapper  = document.getElementById('text-wrapper');
            const fileInput    = document.getElementById('uploaded_file');
            const textInput    = document.getElementById('text_input');

            function toggleFields() {
                if (typeSelect.value === 'ARTICLE') {
                    fileWrapper.classList.remove('d-none');
                    textWrapper.classList.add('d-none');

                    fileInput.setAttribute('required', 'required');
                    textInput.removeAttribute('required');

                    fileInput.name = 'path_resource';
                    textInput.name = '';
                } else {
                    fileWrapper.classList.add('d-none');
                    textWrapper.classList.remove('d-none');

                    textInput.setAttribute('required', 'required');
                    fileInput.removeAttribute('required');

                    textInput.name = 'path_resource';
                    fileInput.name = '';
                }
            }

            toggleFields();
            typeSelect.addEventListener('change', toggleFields);
        });

        document.querySelector('form').addEventListener('submit', function(e){
            console.log('fileInput.name =', fileInput.name, 'files =', fileInput.files);
            console.log('textInput.name =', textInput.name, 'value =', textInput.value);
            e.preventDefault();
        });

        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    document.querySelector('#content-hidden').value = editor.getData();
                });
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    @endpush
</x-app-layout>
