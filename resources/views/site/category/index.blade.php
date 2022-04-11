@extends('site.layouts.base')
@section('title',$category->title)
@section('header')

@endsection
@section('content')

    <!--Start breadcrumb bottom area-->
    <section class="breadcrumb-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="left pull-left">
                        <ul>
                            <li><a href="/">Anasayfa</a></li>
                            @if($category->parent_category)
                                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                                <li>
                                    <a href="{{ route('category.detail',['category' => $category->parent_category->slug]) }}">
                                        {{ $category->parent_category->title }}
                                    </a>
                                </li>
                            @endif
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                            <li class="">{{ $category->title }}</li>
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
                        @foreach($blogs as $blog)
                            <!--Start single blog post-->
                                <div class="col-md-6">
                                    <a href="{{ route('blog.detail',['blog' => $blog->slug]) }}">
                                        <div class="single-blog-post text-center wow fadeInUp" data-wow-delay="0s" data-wow-duration="1s" data-wow-offset="0">
                                            <div class="img-holder">
                                                <img src="{{ imageUrl('public/blog',$blog->image) }}" alt="{{ $blog->title }}">

                                                <div class="published-date">
                                                    <h5>{{ $blog->created_at->translatedFormat('d M') }}<br><span>{{ $blog->created_at->format('Y') }}</span></h5>
                                                </div>
                                            </div>
                                            <div class="text-holder">
                                                <a href="{{ route('blog.detail',['blog' => $blog->slug]) }}">
                                                    <h3 class="blog-title">
                                                        {{ \Illuminate\Support\Str::limit($blog->title,20) }}
                                                    </h3>
                                                </a>
                                                <div class="meta-info clearfix">
                                                    <ul class="post-info">
                                                        <li><i class="fa fa-user" aria-hidden="true"></i><a href="#">{{ $blog->writer->full_name }}</a></li>
                                                        <li><i class="fa fa-tags" aria-hidden="true"></i><a href="#">{{ $blog->sub_category ? $blog->sub_category->title : '' }}</a></li>
                                                    </ul>
                                                </div>
                                                <div class="text">
                                                    <p>{{ \Illuminate\Support\Str::limit(html_entity_decode($blog->description),100) }}</p>
                                                    <a class="readmore" href="{{ route('blog.detail',['blog' => $blog->slug]) }}">Daha Fazla<i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!--End single blog post-->
                            @endforeach
                        </div>
                        <!--Start post pagination-->
                    {!! $blogs->appends($_GET)->links() !!}
                    <!--End post pagination-->
                    </div>
                </div>
                <!--Start sidebar Wrapper-->
                <div class="col-lg-4 col-md-6 col-sm-7 col-xs-12">
                    <div class="sidebar-wrapper">
                        <!--Start single sidebar-->
                        <div class="single-sidebar wow fadeInUp" data-wow-delay="0s" data-wow-duration="1s" data-wow-offset="0">
                            <form class="search-form" action="#">
                                <input placeholder="'{{ $category->title }}' içinde ara..." type="text" name="search" value="{{ request()->get('search') }}">
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
                                <h3>Forum Kategoriler</h3>
                            </div>
                            <ul class="categories clearfix">
                                @foreach($forumCategories as $forumCategory)
                                    <li><a href="{{ route('forum.index') }}#category-{{ $forumCategory->slug }}">{{ $forumCategory->title }}</a></li>
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
                                            <a href="{{ route('blog.detail',['blog' => $popular->slug]) }}"><h5 class="post-title">{{ \Illuminate\Support\Str::limit($popular->title,60) }}</h5></a>
                                            <h6 class="post-date">{{ $popular->created_at->translatedFormat('d M,Y') }}</h6>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!--End single sidebar-->
                        <!--Start single-sidebar-->
                        <div class="single-sidebar wow fadeInUp" data-wow-delay="0s" data-wow-duration="1s" data-wow-offset="0">
                            <div class="sec-title">
                                <h3>Etiketler</h3>
                            </div>
                            <ul class="popular-tag">
                                @if($category->meta_tag->meta_keywords)
                                    @foreach(explode(',',$category->meta_tag->meta_keywords) as $tag)
                                        <li><a href="{{ route('search',['tag' => $tag]) }}">{{ $tag }}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        <!--End single-sidebar-->
                    </div>
                </div>
                <!--End Sidebar Wrapper-->
            </div>
        </div>
    </section>
    <div class="container">
        <!--End blog area-->
        <section class="choosing-area">
            <div class="sec-title text-center">
                <p class="bottom">{!! $category->description !!}</p>
            </div>
        </section>
    </div>

@endsection
@section('footer')
@endsection
