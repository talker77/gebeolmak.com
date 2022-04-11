@extends('site.layouts.base')
@section('title','Kullanıcı Giriş')

@section('content')

    <!--Start breadcrumb bottom area-->
    <section class="breadcrumb-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="left pull-left">
                        <ul>
                            <li><a href="/">Anasayfa</a></li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                            <li>Kullanıcı Girişi</li>
                        </ul>
                    </div>
                    <div class="right pull-right">
                        <a href="{{ route('user.register') }}">
                            <span><i class="fa fa-user" aria-hidden="true"></i>Hesabın yok mu ?</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End breadcrumb bottom area-->

    <!--Start login register area-->
    <section class="login-register-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" style="float:none;margin:auto;" >
                    @include('site.layouts.partials.messages')
                    <div class="form">
                        <div class="sec-title">
                            <h1>Giriş Yap</h1>
                            <span class="border"></span>
                        </div>
                        <div class="row">
                            <form action="{{ route('user.login') }}" method="POST">
                                @csrf
                                <div class="col-md-12">
                                    <div class="input-field">
                                        <input type="email" name="email" placeholder="Email Adresi" required>
                                        <div class="icon-holder">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-field">
                                        <input type="password" name="password" required placeholder="Parola" style="margin-bottom: 10px">
                                        <div class="icon-holder">
                                            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                        </div>
                                        <span class="help-block text-right mt-0"><a class="text-black" style="color: #003545" href="{{ route('password.reset') }}">Şifremi Unuttum</a></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                            <div class="remember-text" style="margin-top: 0">
                                                <div class="checkbox">
                                                    <label>
                                                        <input name="rememberme" type="checkbox">
                                                        <span>Beni Hatırla</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <button class="thm-btn bgclr-1" type="submit">Giriş Yap</button>
                                            <a href="{{ route('user.register') }}" style="color: #003545;margin-top: 5px">Hesabınız yok mu ?</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End login register area-->
@endsection


