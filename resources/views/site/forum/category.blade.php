@extends('site.layouts.base')
@section('title',"Forum | " . $site->title)
@section('header')
    <style>
        .single-sidebar .popular-post li{
            padding-left: 0px;
        }
    </style>
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
                            <li class="active"><a href="{{ route('forum.index') }}">Forum</a></li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                            <li class="active"><a href="{{ route('forum.index') }}#category-{{ $item->parent_category->slug }}">{{ $item->parent_category->title }}</a></li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                            <li>{{ $item->title }}</li>
                        </ul>
                    </div>
                    <div class="right pull-right">
                        <a href="{{ route('forum.create',['category' => $item->id]) }}">
                            <span><i class="fa fa-pencil" aria-hidden="true"></i>Yeni Konu Aç</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="" style="margin-top: 25px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="left-sidebar">
                        <div class="single-sidebar">
                            <ul class="page-link">
                                <li><span href="#">{{ $item->title }}</span> <br>{{ $item->description }}</li>

                            </ul>
                        </div>
                    </div>
                    @foreach($forums as $forum)
                        <div class="single-event-item">
                            <div class="text-holder" style="padding: 10px 10px 10px;">
                                <a href="{{ route('forum.detail',['forum' => $forum->slug]) }}">
                                    <h5 class="title"></h5>
                                    <div class="text" style="font-size: 12px">
                                        <p></p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-8 text-comment single-sidebar">
                                <ul class="popular-post">
                                    <li>
                                        <div class="title-holder">
                                            <a href="{{ route('forum.detail',['forum' => $forum->slug]) }}"><h5 class="post-title">{{ $forum->title }}</h5></a>
                                            <h6 class="post-date">{{ $forum->created_at->translatedFormat('d M Y') }}</h6>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-md-2 text-comment txtcenter">
                                <span class="i-class text-ilk">Cevaplar</span>
                                <p>{{ $forum->active_comments_count }}</p>
                            </div>
                            <div class="col-md-2 text-comment txtcenter">
                                <span class="i-class text-ilk"> Görüntüleme </span>
                                <p>{{ $forum->view_count }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>


            </div>
        </div>
    </section>
@endsection
