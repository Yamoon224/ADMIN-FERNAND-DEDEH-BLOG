<x-app-layout>
    <div class="bg-body-light">
        <div class="content">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-1">@lang('locale.user', ['suffix' => 's'])</h1>
                </div>
                <nav class="flex-shrink-0 mt-1 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">@lang('locale.user_management')</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">@lang('locale.edit', ['param' => __('locale.user', ['suffix' => 's'])])</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default bg-primary text-white">
                <h3 class="block-title">@lang('locale.form', ['param'=>__('locale.edit', ['param'=>__('locale.user', ['suffix' => ''])])])</h3>
            </div>
            <div class="block-content block-content-full">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            @if (!$errors->isEmpty())
                            <p class="text-danger text-center">{{ implode(', ', $errors->all()) }}</p>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label" for="name">@lang('locale.name') <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-alt" value="{{ $user->name }}" id="name" name="name" placeholder="@lang('locale.name')" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="phone">@lang('locale.phone') <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control form-control-alt" value="{{ $user->phone }}" id="phone" name="phone" placeholder="@lang('locale.phone')" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label" for="group_id">@lang('locale.group', ['suffix'=>''])</label>
                                <select class="form-select" id="group_id" name="group_id">
                                    <option value="">-- @lang('locale.select') --</option>
                                    @foreach ($groups as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == $user->group_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="email">@lang('locale.email') <span class="text-danger">*</span></label>
                                <input type="email" class="form-control form-control-alt" id="email" value="{{ $user->email }}" name="email" placeholder="@lang('locale.email')" required>
                            </div>
                        </div>
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
</x-app-layout>
