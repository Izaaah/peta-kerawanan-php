<section class="form-section">
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-input" placeholder="Masukkan password saat ini" autocomplete="current-password" />
            @if ($errors->updatePassword->has('current_password'))
                <p class="text-danger">{{ $errors->updatePassword->first('current_password') }}</p>
            @endif
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-medium text-gray-700 mb-2">{{ __('New Password') }}</label>
            <input id="update_password_password" name="password" type="password" class="form-input" placeholder="Masukkan password baru" autocomplete="new-password" />
            @if ($errors->updatePassword->has('password'))
                <p class="text-danger">{{ $errors->updatePassword->first('password') }}</p>
            @endif
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-input" placeholder="Konfirmasi password baru" autocomplete="new-password" />
            @if ($errors->updatePassword->has('password_confirmation'))
                <p class="text-danger">{{ $errors->updatePassword->first('password_confirmation') }}</p>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn-primary">{{ __('Save') }}</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-success"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
