@extends('site.layouts.base')

@section('content')
    @include('site.layouts.partials.messages')
    <!--Start breadcrumb bottom area-->
    <section class="breadcrumb-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="left pull-left">
                        <ul>
                            <li><a href="/">Anasayfa</a></li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                            <li>Parola Sıfırla</li>
                        </ul>
                    </div>
                    <div class="right pull-right">
                        <a href="{{ route('user.login') }}">
                            <span><i class="fa fa-user" aria-hidden="true"></i>Hesabın var mı ?</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End breadcrumb bottom area-->
    <div class="container" style="margin-top: 10px;margin-bottom: 10px">
        <div class="heading mt-5" style="margin-top: 17px">
            <h2 class="title">Parola Sıfırla</h2>
            <p>Parola sıfırlama isteği almak için aşağıdaki kutucuğa mail adresini giriniz. <br> Eğer mail sistemde kayıtlı ise size parola sıfırlama linki göndereceğiz</p>
        </div><!-- End .heading -->
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" aria-label="Parola Sıfırla">
            @csrf
            <div class="form-group required-field">
                <label for="reset-email">Email</label>
{{--                <input type="email" class="form-control" id="reset-email" name="reset-email" required="">--}}
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="mail@example.com"
                       value="{{ old('email') }}"
                       required>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div><!-- End .form-group -->

            <div class="form-footer">
                <button type="submit" class="btn btn-primary">Parolamı Sıfırla</button>
            </div><!-- End .form-footer -->
        </form>
    </div>
@endsection
