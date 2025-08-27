<x-auth-layout>
    <div class="block block-rounded mb-0">
        <div class="block-header block-header-default bg-warning text-white">
            <h3 class="block-title">@lang('locale.sign_in')</h3>
            <div class="block-options">
                @if (Route::has('password.request'))
                <a class="btn-block-option fs-sm text-white" href="{{ route('password.request') }}">@lang('locale.forgot_password') ?</a>
                @endif
            </div>
        </div>
        <div class="block-content">
            <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-3">
                <h1 class="h2 mb-2"><x-app-logo></x-app-logo></h1>
                @if (!$errors->isEmpty())
                <p class="text-danger text-center">{{ implode(', ', $errors->all()) }}</p>
                @endif
                <form class="js-validation-signin" action="{{ route('auth') }}" method="POST">
                    @csrf
                    <div class="py-3">
                        <div class="mb-3">
                            <input type="text" class="form-control form-control-alt form-control-lg" id="username" name="username" placeholder="@lang('locale.username')"  autofocus autocomplete="username" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control form-control-alt form-control-lg" id="password" name="password" placeholder="@lang('locale.password')" minlength="8" required>
                        </div>
                        <div class="mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label" for="remember">@lang('locale.remember_me')</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12">
                            <button class="btn w-100 btn-alt-warning">
                                <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i> @lang('locale.sign_in')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-auth-layout>
