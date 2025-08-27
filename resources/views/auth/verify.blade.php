<x-auth-layout>
    <div class="block block-rounded mb-0">
        <div class="block-header block-header-default">
            <h3 class="block-title">@lang('locale.email_verify')</h3>
            <div class="block-options">
                @if (Route::has('login'))
                <a class="btn-block-option fs-sm" href="{{ route('login') }}">@lang('locale.sign_in') ?</a>
                @endif
            </div>
        </div>
        <div class="block-content">
            <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-3">
                <h1 class="h2 mb-1"><x-app-logo></x-app-logo></h1>
                @if (session('status') == 'verification-link-sent')
                <p class="text-danger">{{ __('A new verification link has been sent to the email address you provided during registration.') }}</p>
                @endif
                <form class="js-validation-signin" action="{{ route('verification.send') }}" method="POST">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-12">
                            <button class="btn w-100 btn-alt-primary">
                                <i class="fa fa-fw fa-spin me-1 opacity-50"></i> @lang('locale.resend_email_verification')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-auth-layout>


