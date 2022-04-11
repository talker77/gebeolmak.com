@extends('site.layouts.base')
@section('title','Hesabım')
@section('header')
    <link rel="stylesheet" href="/css/profile.css">
@endsection
@section('content')
    <section class="breadcrumb-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="left pull-left">
                        <ul>
                            <li><a href="/">Anasayfa</a></li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                            <li class="">Profil</li>
                        </ul>
                    </div>
                    <div class="right pull-right">
                        <a href="{{ route('forum.create') }}">
                            <span><i class="fa fa-pencil" aria-hidden="true"></i>Yeni Konu Aç</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="" style="margin-top: 25px">
        <div class="container" style="margin-top: 30px;">
            <div class="profile-head">
                <!--col-md-4 col-sm-4 col-xs-12 close-->
                <div class="col-md- col-sm-4 col-xs-12">
                    <img src="/images/kindpng_785975.png" class="img-responsive"/>

                    <div class="container" style="margin-left: 90px;">
{{--                <span class="btn btn-default uplod-file">--}}
{{--                        Upload Photo <input type="file"/>--}}
{{--                </span>--}}
                    </div>
                </div>
                <!--col-md-4 col-sm-4 col-xs-12 close-->

                <div class="col-md-5 col-sm-5 col-xs-12">
                    <h5>{{ $user->full_name }}</h5>
                    <p>Forum Üyesi</p>
                    <ul>
                        <li><span class="glyphicon glyphicon-briefcase"></span> Kayıt {{ $user->created_at->translatedFormat('d M Y') }}</li>

                        <li><span class="glyphicon glyphicon-user"></span> Konular - {{ $forumCount }} </li>
                        <li><span class="glyphicon glyphicon-comment"></span> <a href="#" title="call">Yorumlar ( {{ $commentCount }} )</a></li>
                        <li><span class="glyphicon glyphicon-envelope"></span><a href="#" title="mail" style="text-transform: none">{{ $user->email }}</a></li>
                    </ul>
                </div>
            </div>
            <!--profile-head close-->
        </div>
        <!--container close-->


        <br/>
        <br/>

        <div class="container">
            @include('site.layouts.partials.messages')
            <div class="col-sm-12">
                <div data-spy="scroll" class="tabbable-panel">
                    <div class="tabbable-line">
                        <ul class="nav nav-tabs ">
                            <li class="active">
                                <a href="#tab_default_1" data-toggle="tab">Profiliniz </a>
                            </li>
                            <li>
                                <a href="#tab_default_2" data-toggle="tab">Şifre ve Güvenlik</a>
                            </li>
                            <li class="outhov">
                                <a class="out" data-toggle="tab" onclick="confirm('Çıkış Yapmak istiyor musunuz ?') ? document.getElementById('logoutForm').submit() : false">
                                    Çıkış Yap
                                </a>
                            </li>
                        </ul>
                        <form action="{{ route('user.logout') }}" method="POST" id="logoutForm">
                            @csrf
                        </form>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_default_1">
                                <div class="well well-sm">
                                    <h4>Profil</h4>
                                </div>
{{--                                <p align="right">--}}
{{--                                    <button type="button" class="btn btn-default btn-sm">--}}
{{--                                        <span class="glyphicon glyphicon-edit"></span> DDüzenler--}}
{{--                                    </button>--}}
{{--                                </p>--}}
                                <table class="table bio-table">
                                    <tbody>
                                    <tr>
                                        <td>İsim</td>
                                        <td>: {{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Soy isim</td>
                                        <td>: {{ $user->surname }}</td>
                                    </tr>
                                    <tr>
                                        <td>E-mail</td>
                                        <td>:  {{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kayıt Tarihi</td>
                                        <td>:  {{ $user->created_at->translatedFormat('d M Y') }}</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane" id="tab_default_2">
                                <div class="well well-sm">
                                    <h4>Sifre ve Güvenlik</h4>
                                </div>
                                <form action="{{ route('user.change-password') }}" method="POST" class="form-horizontal">
                                    <p align="right">
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <span class="glyphicon glyphicon-edit"></span> Kaydet
                                        </button>
                                    </p>
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Mevcut Şifreniz</label>
                                        <div class="col-md-10">
                                            <input type="password" class="form-control" name="old_password" placeholder="Mevcut Şifreniz" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Yeni Şifre</label>
                                        <div class="col-md-10">
                                            <input type="password" class="form-control" name="new_password" placeholder="Yeni Şifre" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Yeni Şifreyi Onayla</label>
                                        <div class="col-md-10">
                                            <input type="password" class="form-control" name="confirm_password" placeholder="Yeni şifreyi onayla" required>
                                        </div>
                                    </div>
                                </form>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
