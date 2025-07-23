@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-light">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="membership_type" class="col-md-4 col-form-label text-md-end">{{ __('Membership') }}</label>

                            <div class="col-md-6">
                                <select id="membership_type" class="form-control @error('membership_type') is-invalid @enderror" name="membership_type" required>
                                    <option value="">-- Tipe Membership --</option>
                                    <option value="A" {{ old('membership_type') == 'A' ? 'selected' : '' }}>A (3 Artikel & 3 Video)</option>
                                    <option value="B" {{ old('membership_type') == 'B' ? 'selected' : '' }}>B (10 Artikel & 10 Video)</option>
                                    <option value="C" {{ old('membership_type') == 'C' ? 'selected' : '' }}>C (Unlimited Access)</option>
                                </select>

                                @error('membership_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="card-body">
                        <div class="social-login text-center mt-4">
                            <p class="mb-3"><b>Atau daftar dengan:<b></p>
                            
                            <form id="social-register-form" method="GET">
                                <div class="form-group mb-3">
                                    <select id="social-membership-type" name="membership_type" class="form-control" required>
                                        <option value="">-- Tipe Membership --</option>
                                        <option value="A">A (3 Artikel & 3 Video)</option>
                                        <option value="B">B (10 Artikel & 10 Video)</option>
                                        <option value="C">C (Unlimited Access)</option>
                                    </select>
                                </div>
                                
                                <button type="button" class="btn btn-danger mb-2 social-login-btn" data-provider="google">
                                    <i class="fab fa-google"></i> Google
                                </button>
                                <button type="button" class="btn btn-primary mb-2 social-login-btn" data-provider="facebook">
                                    <i class="fab fa-facebook"></i> Facebook
                                </button>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const socialLoginBtns = document.querySelectorAll('.social-login-btn');
    
    socialLoginBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const provider = this.getAttribute('data-provider');
            const membershipType = document.getElementById('social-membership-type').value;
            
            if (!membershipType) {
                alert('Silakan pilih membership type terlebih dahulu');
                return;
            }
            
            if (provider === 'google') {
                window.location.href = "{{ route('login.google') }}?membership_type=" + membershipType;
            } else if (provider === 'facebook') {
                window.location.href = "{{ route('login.facebook') }}?membership_type=" + membershipType;
            }
        });
    });
});
</script>
@endsection