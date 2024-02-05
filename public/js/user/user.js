function handleCredentialResponse(response) {

    $.ajax({
        url: parseJWTRoute,
        type: 'POST',
        data: {
            credential: response.credential
        },
        success: function(response) {
            console.log(response);
            if (response.success === false) {
                var errorMsg = $('.error-message');
                errorMsg.text(response.message);
                setTimeout(function() {
                    errorMsg.text('');
                }, 3000);
            } else {
                if (response.session_key) {
                   
                    var expires = "";
                    var date = new Date();
                    date.setTime(date.getTime() + (30 * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                    document.cookie = 'session_key' + brandName + "=" + (response.session_key || "") + expires + "; path=/";
                    location.reload();
                }
            }
        },
        error: function(error) {
            console.error(error);
        }
    });
}


$(document).ready(function() {

    $('.user').click(function() {
        $('.user-popup').show();
    });

    $('.user-popup').on('click', '.close-btn', function() {
        $('.user-popup').hide();
        $('.sign-form').show();
        $('.forgot-password-form').remove();
        $('.sign-up-form').remove();
    });

    $('.user-popup').on('click', '.back-to-signin', function(event) {
        event.preventDefault();
        resetToSignIn();
    });


    $('.forgot-password-link').click(function(event) {
        event.preventDefault();

        var forgotPasswordForm = `
        <div class="form-container forgot-password-form">
            <div class="close-btn">&times;</div>
            <h2>Reset Password</h2>
            <div class="form-group">
                <label for="forgot-email">Email</label>
                <input type="email" id="forgot-email" name="forgot-email" placeholder="Enter your email" required>
            </div>
            <button class="sign-button" type="submit">Reset Password</button>
            <a href="#" class="back-to-signin">Back to Sign In</a>
        </div>
    `;

        $('.sign-form').hide();
        $('.user-popup').append(forgotPasswordForm);
    });


    $('.signup-link').click(function(event) {
        event.preventDefault();

        var signUpForm = `
        <div class="form-container sign-up-form">
            <div class="close-btn">&times;</div>
            <h2>Sign Up</h2>
            <div class="form-group">
                <label for="signup-email">Email</label>
                <input class="email-input" type="email" id="signup-email" name="signup-email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="signup-phone">Phone</label>
                <input class="phone-input" type="phone" id="signup-phone" name="signup-phone" placeholder="Enter your phone" required>
            </div>
            <div class="form-group">
            <label for="signup-name">Name</label>
            <input class="name-input" type="text" id="signup-name" name="signup-name" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
            <label for="signup-address">Address</label>
            <input class="address-input" type="text" id="signup-address" name="signup-address" placeholder="Enter your address" required>
            </div>
            <div class="form-group">
            <label for="signup-city">City</label>
            <input class="city-input" type="text" id="signup-city" name="signup-city" placeholder="Enter your city" required>
            </div>
            <div class="form-group">
                <label for="signup-password">Password</label>
                <input class="password-input" type="password" id="signup-password" name="signup-password" placeholder="Enter your password" required>
            </div>
            <p class="error-message">  </p>
            <button class="sign-button" type="submit">Sign Up</button>
            <a href="#" class="back-to-signin">Back to Sign In</a>
        </div>
    `;

        $('.sign-form').hide();
        $('.forgot-password-form').remove();
        $('.user-popup').append(signUpForm);
    });

    function resetToSignIn() {
        $('.forgot-password-form, .sign-up-form').remove();
        $('.sign-form').show();
    }


    $('.user-popup').on('click', '.sign-up-form .sign-button', function() {
        handleUserAction('register', '.sign-up-form');
    });
    $('.user-popup').on('click', '.sign-form .sign-button', function() {

        handleUserAction('login', '.sign-form');
    });

    function handleUserAction(action, formElement) {

        var email = $(formElement).find('.email-input').val();
        var password = $(formElement).find('.password-input').val();
        var phone = $(formElement).find('.phone-input').val();
        var name = $(formElement).find('.name-input').val();
        var address = $(formElement).find('.address-input').val();
        var city = $(formElement).find('.city-input').val();

        var url, data;
        if (action === 'register') {
            url = registerRoute;
            data = {
                email: email,
                password: password,
                phone: phone,
                name: name,
                address: address,
                city: city
            }
        } else if (action === 'login') {
            url = loginRoute;
            data = {
                email_phone: email,
                password: password
            }
        } else {
            console.error('Invalid action specified');
            return;
        }

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function(response) {
                if (response.success === false) {
                    var errorMsg = $('.error-message');
                    errorMsg.text(response.message);
                    setTimeout(function() {
                        errorMsg.text('');
                    }, 3000);
                } else {
                    if (response.session_key) {
                        setCookie('session_key' + brandName, response
                            .session_key, 30);
                        location.reload();
                    }
                }
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }
});