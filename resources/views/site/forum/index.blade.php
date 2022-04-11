@extends('site.layouts.base')
@section('title',"Forum | " . $site->title)

@section('content')
    <section class="breadcrumb-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="left pull-left">
                        <ul>
                            <li><a href="/">Anasayfa</a></li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                            <li class="active">Forum</li>
                        </ul>
                    </div>
                    <div class="right pull-right">
                        <a href="{{ route('forum.create') }}">
                            <span><i class="fa fa-pencil" aria-hidden="true"></i>Yeni Konu Aç</span>
                        </a>
                        <a href="{{ route('user.dashboard') }}" style="margin-left: 10px">
                            <span><i class="fa fa-list" aria-hidden="true"></i>Hesabım</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="" style="margin-top: 25px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="left-sidebar">
                        <div class="single-sidebar">
                            <ul class="page-link">
                                <li><span href="">Anneden Anneye Bilgi Kaynağı - {{ $site->title }} : FORUM</span></li>

                            </ul>
                        </div>
                    </div>
                    @foreach($categories as $category)
                        <div class="single-event-item" id="category-{{ $category->slug }}">
                            <div class="text-holder" style="padding: 10px 10px 10px;">
                                <a href="javascript:void(0);">
                                    <h5 class="title">{{ $category->title }}</h5>
                                    <div class="text" style="font-size: 12px">
                                        <p>{{ $category->description }}</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-8 text-comment">
                                @foreach($category->sub_categories_active as $subCategory)
                                    <a>
                                        <span class="i-class"><i style="color: #FDE428; font-size: 30px" class="fa fa-comments" aria-hidden="true"></i>
                                            <a href="{{ route('forum.category',['category' => $subCategory->slug]) }}" class="text-ilk">{{ $subCategory->title }}</a>
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                            <div class="col-md-2 text-comment txtcenter">
                                <a href="#">
                                    <span class="i-class"><a class="text-ilk">Kategoriler </a></span>
                                    <p> {{ $category->sub_categories_active_count }}</p>
                                </a>
                            </div>
                            <div class="col-md-2 text-comment txtcenter">
                                <a href="#">
                                    <span class="i-class"><a class="text-ilk"> Konular  </a></span>
                                    <p>{{ $category->forums_active_count }}</p>
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="col-lg-4 col-md-6 col-sm-7 col-xs-12">
                    <div class="sidebar-wrapper">
                        <!--Start single sidebar-->

                        <!--End single sidebar-->
                        <!--Start single sidebar-->
                        <div class="single-sidebar wow fadeInUp animated" data-wow-delay="0s" data-wow-duration="1s" data-wow-offset="0" style="visibility: visible; animation-duration: 1s; animation-delay: 0s; animation-name: fadeInUp;">
                            <div class="sec-title">
                                <h3>Son Konular</h3>
                            </div>
                            <ul class="popular-post">
                                @foreach($recents as $recent)
                                    <li>
                                        <div class="img-holder">
                                            <img src="{{ $recent->image_path }}" alt="{{ $recent->title }}">
                                        </div>
                                        <div class="title-holder">
                                            <a href="#"><h5 class="post-title">{{ $recent->title }}</h5></a>
                                            <h6 class="post-date">{{ $recent->display_date }}</h6>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!--End single-sidebar-->
                        <!--Start single-sidebar-->
                        <div class="single-sidebar wow fadeInUp animated" data-wow-delay="0s" data-wow-duration="1s" data-wow-offset="0" style="visibility: visible; animation-duration: 1s; animation-delay: 0s; animation-name: fadeInUp;">
                            <div class="sec-title">
                                <h3>Forum Kategoriler</h3>
                            </div>
                            <ul class="categories clearfix">
                                @foreach($categories as $category)
                                    <li><a href="#category-{{ $category->slug }}">{{ $category->title }}<span>({{ $category->forums_active_count }})</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="single-sidebar wow fadeInUp" data-wow-delay="0s" data-wow-duration="1s" data-wow-offset="0" style="visibility: hidden; animation-duration: 1s; animation-delay: 0s; animation-name: none;">
                            <div class="sec-title">
                                <h3>Sosyal ağlar</h3>
                            </div>
                            <ul class="popular-tag">
                                @if($site->twitter)
                                    <li><a href="{{ $site->twitter }}"><i class="fa fa-twitter"></i></a></li>
                                @endif
                                @if($site->facebook)
                                    <li><a href="{{ $site->facebook }}"><i class="fa fa-facebook"></i></a></li>
                                @endif
                                @if($site->instagram)
                                    <li><a href="{{ $site->instagram }}"><i class="fa fa-instagram"></i></a></li>
                                @endif
                                @if($site->youtube)
                                    <li><a href="{{ $site->youtube }}"><i class="fa fa-youtube"></i></a></li>
                                @endif

                            </ul>
                        </div>
                        <!--End single-sidebar-->
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

