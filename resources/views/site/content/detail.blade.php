@extends('site.layouts.base')
@section('title',$item->title)
@section('header')
    @include('laravel-meta-tags::head-tags')
@endsection
@section('content')
    <!--Start breadcrumb bottom area-->
    <section class="breadcrumb-bottom-area" style="background: #000">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="left pull-left">
                        <ul>
                            <li><a href="/" style="color: white">Anasayfa</a></li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                            <li class="active">{{ $item->title }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Start welcome area-->
    <section class="welcome-area-v2">
        <div class="container inner-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-holder">
                        <div class="sec-title">
                            <h1>{{ $item->title }}</h1>
                            <span class="border"></span>
                        </div>
                        <p>
                            {!! $item->desc !!}
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

