<x-app-layout>
    <div class="bg-image" style="background-image: url('{{ asset('media/photos/photo10@2x.jpg') }}');">
        <div class="bg-primary-dark-op">
            <div class="content content-full text-center">
                <div class="my-3">
                    <img class="img-avatar img-avatar-thumb" src="{{ uiavatar(auth()->user()->name) }}" alt="">
                </div>
                <h1 class="h2 text-white mb-0">@lang('locale.profile')</h1>
                <h2 class="h4 fw-normal text-white-75">{{ auth()->user()->name }}</h2>
            </div>
        </div>
    </div>
    <div class="content content-boxed">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">@lang('locale.user_profile')</h3>
            </div>
            <div class="block-content">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row push">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label" for="name">@lang('locale.name')</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$user->name }}" placeholder="@lang('locale.name')" required>
                            </div>
                        </div>
                            
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="email">@lang('locale.email')</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{$user->email }}" placeholder="@lang('locale.email')" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="phone">@lang('locale.phone')</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{$user->phone }}" placeholder="@lang('locale.phone')" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="password">@lang('locale.password')</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="@lang('locale.password')" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="password_confirmation">@lang('locale.password_confirmation')</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="@lang('locale.password_confirmation')" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-4 w-100">
                                <button type="submit" class="btn btn-alt-warning w-100">
                                    @lang('locale.submit')
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</x-app-layout>
