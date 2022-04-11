@extends('site.layouts.base')
@section('title','Kullanıcı Kayıt')

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
                            <li>Kullanıcı Kayıt</li>
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

    <!--Start login register area-->
    <section class="login-register-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" style="float:none;margin:auto;">
                    @include('site.layouts.partials.messages')
                    <div class="form">
                        <div class="sec-title">
                            <h1>Hesap Oluştur</h1>
                            <span class="border"></span>
                        </div>
                        <div class="row">
                            <form action="{{ route('user.register') }}" method="POST">
                                @csrf
                                <div class="col-md-12">
                                    <div class="input-field">
                                        <input type="text" name="name" placeholder="Adınız" required maxlength="60" minlength="3">
                                        <div class="icon-holder">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-field">
                                        <input type="text" name="surname" placeholder="Soyadınız" required maxlength="60" minlength="3">
                                        <div class="icon-holder">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-field">
                                        <input type="email" name="email" placeholder="Email Adresi" required maxlength="60" minlength="5">
                                        <div class="icon-holder">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-field">
                                        <input type="password" name="password" required placeholder="Parola"  maxlength="60" minlength="6">
                                        <div class="icon-holder">
                                            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-field">
                                        <input type="password" name="password_confirmation" required placeholder="Parola Tekrar" maxlength="60" minlength="6">
                                        <div class="icon-holder">
                                            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <button class="thm-btn bgclr-1" type="submit">Kayıt Ol</button>
                                            <a href="" style="color: #003545;margin-top: 5px">Hesabınız var mı ?</a>
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
