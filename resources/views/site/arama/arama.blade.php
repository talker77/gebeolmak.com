@php
    $title = request()->has('search') ? request()->get('search') : "#".request()->get('tag');
@endphp
@extends('site.layouts.base')
@section('title',$title . " için sonuçlar")

@section('content')


    <!--Start breadcrumb bottom area-->
    <!--Start breadcrumb bottom area-->
    <section class="breadcrumb-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="left pull-left">
                        <ul>
                            <li><a href="/">Anasayfa</a></li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                            <li class="">"<b>{{ $title }}</b>" için Arama Sonuçları</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End breadcrumb bottom area-->
    <!--Start blog area-->
    <section id="blog-area" class="blog-default-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="blog-post">
                        <div class="row">
                        @if(count($items))
                            @foreach($items as $item)
                                <!--Start single blog post-->
                                    <div class="col-md-6">
                                        <a href="{{ route('blog.detail',['blog' => $item->slug]) }}">
                                            <div class="single-blog-post text-center wow fadeInUp" data-wow-delay="0s" data-wow-duration="1s" data-wow-offset="0">
                                                <div class="img-holder">
                                                    <img src="{{ imageUrl('public/blog',$item->image) }}" alt="{{ $item->title }}">

                                                    <div class="published-date">
                                                        <h5>{{ $item->created_at->translatedFormat('d M') }}<br><span>{{ $item->created_at->format('Y') }}</span></h5>
                                                    </div>
                                                </div>
                                                <div class="text-holder">
                                                    <a href="{{ route('blog.detail',['blog' => $item->slug]) }}">
                                                        <h3 class="blog-title">
                                                            {{ \Illuminate\Support\Str::limit($item->title,20) }}
                                                        </h3>
                                                    </a>
                                                    <div class="meta-info clearfix">
                                                        <ul class="post-info">
                                                            <li><i class="fa fa-user" aria-hidden="true"></i><a href="#">{{ $item->writer->full_name }}</a></li>
                                                            <li><i class="fa fa-tags" aria-hidden="true"></i><a href="#">{{ $item->category ? $item->category->title : '' }}</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="text">
                                                        <p>{{ \Illuminate\Support\Str::limit(html_entity_decode($item->description),100) }}</p>
                                                        <a class="readmore" href="{{ route('blog.detail',['blog' => $item->slug]) }}">Daha Fazla<i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <!--End single blog post-->
                                @endforeach
                            @else
                                <div class="col-md-6">
                                    <h4>Aramanız için sonuç bulunamadı...</h4>
                                </div>
                            @endif

                        </div>
                        <!--Start post pagination-->
                    {!! is_array($items) ? '' : $items->appends($_GET)->links() !!}
                    <!--End post pagination-->
                    </div>
                </div>
                <!--Start sidebar Wrapper-->
                <div class="col-lg-4 col-md-6 col-sm-7 col-xs-12">
                    <div class="sidebar-wrapper">
                        <!--Start single sidebar-->
                        <div class="single-sidebar wow fadeInUp" data-wow-delay="0s" data-wow-duration="1s" data-wow-offset="0">
                            <form class="search-form" action="#">
                                <input placeholder="Tüm sitede ara..." type="text" name="search" value="{{ request()->get('search') }}">
                                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </form>
                        </div>
                        <!--End single sidebar-->
                        <!--Start single sidebar-->
                        <div class="single-sidebar wow fadeInUp" data-wow-delay="0s" data-wow-duration="1s" data-wow-offset="0">
                            <div class="sec-title">
                                <h3>Kategoriler</h3>
                            </div>
                            <ul class="categories clearfix">
                                @foreach($cacheCategories as $cat)
                                    <li><a href="{{ route('category.detail',['category' => $cat->slug]) }}">{{ $cat->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <!--End single sidebar-->
                        <!--Start single sidebar-->
                        <div class="single-sidebar wow fadeInUp" data-wow-delay="0s" data-wow-duration="1s" data-wow-offset="0">
                            <div class="sec-title">
                                <h3>Öne Çıkanlar</h3>
                            </div>
                            <ul class="popular-post">
                                @foreach($populars as $popular)
                                    <li>
                                        <div class="img-holder">
                                            <img src="{{ imageUrl('public/blog',$popular->image) }}" alt="Awesome Image">
                                        </div>
                                        <div class="title-holder">
                                            <a href="#"><h5 class="post-title">{{ title($popular->title) }}</h5></a>
                                            <h6 class="post-date">{{ $popular->created_at->translatedFormat('d M,Y') }}</h6>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!--End single sidebar-->
                    </div>
                </div>
                <!--End Sidebar Wrapper-->
            </div>
        </div>
    </section>
    <!--End blog area-->

@endsection

