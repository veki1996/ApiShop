@push('head-css')
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/user/user.css">
@endpush

<div class="user-popup">
    <div class="sign-form">
        <div class="close-btn">&times;</div>
        <h2>Sign in With</h2>

        {{-- <div class="user-sign-option">
            <img src="{{env('APP_URL')}}/static/facebook-pop.png" class="check-icon" alt="facebook icon">
            <p>Facebook</p>
        </div> --}}
        <div class="user-sign-options">
            <div class="user-sign-option">
                <div id="g_id_onload"
                    data-client_id="{{env('GOOGLE_CONSOLE_KEY')}}"
                    data-context="signin" data-ux_mode="popup" data-auto_prompt="false" data-auto_select="true"
                    data-callback="handleCredentialResponse">
                </div>
                <div class="g_id_signin" data-type="standard" data-shape="rectangular" data-theme="outline"
                    data-text="signin_with" data-size="large" data-logo_alignment="left">
                </div>
            </div>
        </div>

        <div class="form-container">
            <div class="form-group">
                <label for="email">Email or Phone</label>
                <input class="email-input" type="text" id="email" name="email_phone"
                    placeholder="Enter your email or phone" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <a href="" class="forgot-password-link">Forgot Password?</a>
                <input class="password-input" type="password" id="password" name="password"
                    placeholder="Enter your password" required>
            </div>
            <p class="error-message"> </p>
            <button class="sign-button" type="submit">Sign In</button>
        </div>
        <div class="signup-message">
            Not a member? <a href="/path-to-signup" class="signup-link">Sign up now</a>
        </div>
    </div>
</div>
<script>
    let registerRoute = '{{ route('user.register') }}';
    let loginRoute    = '{{ route('user.login') }}';
    let parseJWTRoute = '{{ route('user.parseJWT') }}';
</script>
<script src="{{env('APP_URL')}}/js/user/user.js"></script>
