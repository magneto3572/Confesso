<html>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src={{ URL::asset('js/Posts.js') }}></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.js"></script>
<script src="https://kit.fontawesome.com/89fb92b8aa.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{asset('css/login.css')}}">
<body>
<section class="forms-section">
    <img src="{{asset('img/titt.png')}}" height="100" width="250" style="padding-top: 20px" alt="">
    <div class="forms">
        <div class="form-wrapper is-active">
            <button type="button" class="switcher switcher-login">
                {{ __('Login') }}
                <span class="underline"></span>
            </button>
            <form class="form form-login" method="post" action="{{route('login')}}">
                @csrf
                <fieldset>
                    <legend>Please, enter your email and password for login.</legend>
                    <div class="input-block">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"
                               value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="input-block">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="@error('password') is-invalid @enderror"
                               name="password" required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                            <div class="row">
                                <div class="col-auto">
                                    <label for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                                <div class="col-auto">
                                    <input type="checkbox" name="remember"
                                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                                </div>
                            </div>
                    </div>
                </fieldset>
                <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </form>
        </div>
        <div class="form-wrapper">
            <button type="button" class="switcher switcher-signup">
                {{ __('Register') }}
                <span class="underline"></span>
            </button>
            <form class="form form-signup" method="POST" action="{{ route('register') }}">
                @csrf
                <fieldset>
                    <legend>Please, enter your email, password and password confirmation for sign up.</legend>
                    <div class="input-block">
                        <label for="name">{{ __('Name') }}</label>
                        <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name"
                               value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="input-block">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"
                               value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="input-block">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="@error('password') is-invalid @enderror"
                               name="password" required autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>
                    <div class="input-block>">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                               required autocomplete="new-password">
                    </div>
                </fieldset>
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </form>
        </div>
    </div>
</section>
</body>
<script>
    const switchers = [...document.querySelectorAll('.switcher')]
    switchers.forEach(item => {
        item.addEventListener('click', function () {
            switchers.forEach(item => item.parentElement.classList.remove('is-active'))
            this.parentElement.classList.add('is-active')
        })
    })

</script>
</html>


