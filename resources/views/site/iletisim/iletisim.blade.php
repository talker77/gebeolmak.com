@extends('site.layouts.base')
@section('title','İletişim')
@section('content')
    <!--Start breadcrumb area-->
    <section class="breadcrumb-area" style="background-image: url(images/resources/breadcrumb-bg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumbs">
                        <h1>İletişim</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End breadcrumb area-->

    <!--Start breadcrumb bottom area-->
    <section class="breadcrumb-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="left pull-left">
                        <ul>
                            <li><a href="{{ route('homeView') }}">Anasayfa</a></li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                            <li class="active">İletişim</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End breadcrumb bottom area-->

    <!--Start contact form area-->
    <section class="contact-form-area">
        <div class="container">
            <div class="sec-title text-center">
                <h1>Bizimle İletişime Geçin</h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-content">
                        <div class="center-block">
                            <div class="contact-form">
                                <form id="contact-form" name="contact_form" class="default-form" action="{{ route('contact.post') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" name="name" value="" placeholder="Tam Adınız*" required="" maxlength="100">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="email" name="email" value="" placeholder="Email Adresiniz*" required="" maxlength="100">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="text" name="subject" value="" placeholder="Konu">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <textarea name="message" placeholder="Mesajınızı buraya yazabilirsiniz.." required="" maxlength="250"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden" value="">
                                            <button class="thm-btn bgclr-1" type="submit" data-loading-text="Please wait...">Gönder</button>
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
    <!--End contact form area-->
@endsection
