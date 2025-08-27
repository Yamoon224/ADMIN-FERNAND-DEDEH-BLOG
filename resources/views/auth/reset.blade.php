<x-auth-layout>
    <div class="block block-rounded mb-0">
        <div class="block-header block-header-default">
            <h3 class="block-title">@lang('locale.reset_password')</h3>
            <div class="block-options">
                @if (Route::has('login'))
                <a class="btn-block-option fs-sm" href="{{ route('login') }}">@lang('locale.sign_in') ?</a>
                @endif
            </div>
        </div>
        <div class="block-content">
            <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-3">
                <h1 class="h2 mb-1"><x-app-logo></x-app-logo></h1>
                @if (!$errors->isEmpty())
                <p class="text-danger">{{ implode(', ', $errors->all()) }}</p>
                @endif
                <form class="js-validation-signin" action="{{ route('password.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="py-3">
                        <div class="mb-3">
                            <input type="email" class="form-control form-control-alt form-control-lg" id="email" name="email" placeholder="@lang('locale.email')" autofocus autocomplete="email" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control form-control-alt form-control-lg" id="password" name="password" autocomplete="new-password" placeholder="@lang('locale.password')" minlength="8" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control form-control-alt form-control-lg" id="password_confirmation" name="password_confirmation" autocomplete="new-password" placeholder="@lang('locale.password_confirmation')" minlength="8" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12">
                            <button class="btn w-100 btn-alt-primary">
                                <i class="fa fa-fw fa-envelope me-1 opacity-50"></i> @lang('locale.reset_password')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-auth-layout>

