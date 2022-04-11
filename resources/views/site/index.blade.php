@extends('site.layouts.base')
@section('title',$site->title)
@section('content')
    <!--Start rev slider wrapper-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="project-single-carousel">
                    @foreach($blogs->where('type','home_page_top_left_slider')->take(10) as $homePageLeftSlider)
                        <!--Start single project item-->
                            <div class="single-project-item">
                                <a href="{{ route('blog.detail',['blog' => $homePageLeftSlider->slug]) }}">
                                    <div class="img-holder">
                                        <img src="{{ imageUrl('public/blog',$homePageLeftSlider->image) }}" alt="{{ $homePageLeftSlider->title }}">
                                    </div>
                                </a>
                            </div>
                            <!--End single project item-->
                        @endforeach
                    </div>
                </div>
                @foreach($blogs->where('type','home_page_top_right')->take(2) as $home_page_top_right)
                    <div class="col-md-4" style="{{ !$loop->first ? 'margin-top:10px' : '' }}">
                        <a href="{{ route('blog.detail',['blog' => $home_page_top_right->slug]) }}">
                            <div class="single-blog-post text-center">
                                <div class="img-holder">
                                    <img src="{{ imageUrl('public/blog',$home_page_top_right->image) }}" alt="{{ $home_page_top_right->title }}">
                                    <h6>{{ title($home_page_top_right->category->title) }}</h6>
                                    <div class="index" style="background: linear-gradient(to bottom, transparent 0%, black 100%);">
                                        <h5>{{ title($home_page_top_right->title) }}</span></h5>
                                    </div>
                                </div>
                            </div>
                        </a>

                    </div>
                @endforeach

            </div>
            <div class="row bottom">
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="button prev pull-left">
                        <a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i>Prev</a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="icon-holder text-center">
                        <a href="#">
                            <i class="fa fa-th" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="button next pull-right">
                        <a href="#">Next<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="blog-area" class="blog-default-area" style=": ">
        <div class="container">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="blog-post">
                    <div class="sec-title">
                        <h1>Editörün Seçtikleri</h1>
                        <span class="border"></span>
                        <p class="bottom">we promised you that, we always try to take care of your childdren. Early child care is a very important and often overlooked component of child development</p>
                    </div>
                    <div class="row">

                        @foreach($blogs->where('type','editor_picks')->take(3) as $editorPicks)
                            <div class="col-md-4 col-xs-12 ">
                                <div class="single-blog-post  wow fadeInUp" data-wow-delay="0s" data-wow-duration="1s" data-wow-offset="0">
                                    <div class="img-holder">
                                        <a href="{{ route('blog.detail',['blog' => $editorPicks->slug]) }}">
                                            <img src="{{ imageUrl('public/blog',$editorPicks->image) }}" alt="{{ $editorPicks->title }}">
                                        </a>
                                        <h6>{{ @$editorPicks->category->title }}</h6>
                                    </div>
                                    <div class="single-title">
                                        <a href="{{ route('blog.detail',['blog' => $editorPicks->slug]) }}" style="color: #888888">{{ title($editorPicks->title) }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="blog-post">
                    <div class="row">
                        @foreach($lastHomeCategories->take(2) as $lastCategory)
                            <div class="col-md-6">
                                <div class="sec-title">
                                    <h1>{{ $lastCategory->title }}</h1>
                                    <span class="border"></span>
                                </div>
                            </div>
                        @endforeach
                        @foreach($lastHomeCategories->take(2) as $lastCategory)
                            <div class="col-md-6 p-0" style="padding: 0">
                                @foreach($lastCategory->last_active_blogs->take(2) as $activeBlog)
                                    <div class="col-md-12 col-xs-12">
                                        <a href="{{ route('blog.detail',['blog' => $activeBlog->slug]) }}">
                                            <div class="single-blog-post text-center wow fadeInUp" data-wow-delay="0s" data-wow-duration="1s" data-wow-offset="0">
                                                <div class="img-holder">
                                                    <img src="{{ imageUrl('public/blog',$activeBlog->image) }}" alt="{{ $activeBlog->title }}">
                                                    <h6>{{ $activeBlog->category->title }}</h6>
                                                    <div class="index">
                                                        <h5>{{ title($activeBlog->title) }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="blog-post">
                    <div class="sec-title">
                        <h1>En Çok Okunanlar</h1>
                        <span class="border"></span>
                    </div>
                    <div class="row">
                        @foreach($mostViewed as $view)
                            <div class="col-md-4 col-xs-12 ">
                                <div class="single-blog-post  wow fadeInUp" data-wow-delay="0s" data-wow-duration="1s" data-wow-offset="0">
                                    <div class="img-holder">
                                        <a href="{{ route('blog.detail',['blog' => $view->slug]) }}">
                                            <img src="{{ imageUrl('public/blog',$view->image) }}" alt="{{ $view->title }}">
                                        </a>
                                        <h6>{{ @$view->category->title }}</h6>
                                    </div>
                                    <div class="single-title">
                                        <a href="{{ route('blog.detail',['blog' => $view->slug]) }}" class="text-normal"> {{ title($view->title) }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="blog-post">
                    <div class="row">

                        <div class="sec-title">
                            <h1>Son Konular</h1>
                            <span class="border"></span>
                        </div>
                        @foreach($lastPosts as $lastPost)

                                <div class="col-md-6 col-xs-12 items ">
                                    <div class="single-blog-post wow fadeInUp" data-wow-delay="0s" data-wow-duration="1s" data-wow-offset="0">

                                        <div class="itemimg">
                                            <div class="col-md-6 ">
                                                <a href="{{ route('blog.detail',['blog' => $lastPost->slug]) }}">
                                                    <img src="{{ imageUrl('public/blog',$lastPost->image) }}" style="width: 195px;height: 144px" alt="{{ $lastPost->title }}">
                                                </a>
                                            </div>
                                            <div class="col-md-6 itemcon">
                                                <h4>{{ title($lastPost->title) }}</h4>

                                                {{ title(strip_tags($lastPost->description),60) }}
                                                <ul>
                                                    <li><i class="fa fa-calendar"></i> {{ $lastPost->display_date }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach

                    </div>
                </div>
            </div>

            <!--Start sidebar Wrapper-->
            <div class="col-lg-4 col-md-4 col-sm-7 col-xs-12">
                <div class="sidebar-wrapper">
                    <!--Start single sidebar-->
                    <div class="single-sidebar wow fadeInUp" data-wow-delay="0s" data-wow-duration="1s" data-wow-offset="0">
                        <form method="GET" action="{{ route('search') }}" class="search-form">
                            <input placeholder="Sitede Ara..." name="search" type="text" required>
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
                    <div class="single-sidebar wow fadeInUp" data-wow-delay="0s" data-wow-duration="1s" data-wow-offset="0">
                        <div class="sec-title">
                            <h3>Etiketler</h3>
                        </div>
                        <ul class="popular-tag">
                            @foreach($tags as $tag)
                                <li><a href="{{ route('search',['tag' => $tag]) }}">{{ $tag }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="img-holder wow slideInRight animated" style="visibility: visible; animation-name: slideInRight; position: inherit;">
                        <img src="images/about/welcome.png" alt="Awesome Image">
                    </div>
                    <!--End single-sidebar-->
                </div>
            </div>
            <!--End Sidebar Wrapper-->
        </div>
    </section>
    <section id="">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="product-tab-box" style="overflow: inherit; margin-top: 0px">
                        <ul class="nav nav-tabs tab-menu">
                            @foreach($lastHomeCategories->skip(2)->take(4) as $lastCategoryTab)
                                <li class="{{ $loop->first ? 'active' : '' }}"><a href="#{{ $lastCategoryTab->slug }}" data-toggle="tab" aria-expanded="true">{{ $lastCategoryTab->title }}</a></li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach($lastHomeCategories->skip(2)->take(4) as $lastCategoryTabContent)
                                <div class="tab-pane {{ $loop->first ? 'active' : '' }}" id="{{ $lastCategoryTabContent->slug }}">
                                    <div class="product-details-content">
                                        <div class="desc-content-box" style="margin-left: -15px">
                                            @foreach($lastCategoryTabContent->last_active_blogs->take(3) as $activeBlogTab)
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                    <a href="{{ route('blog.detail',['blog' => $activeBlogTab->slug]) }}">
                                                        <div class="single-classes-item hvr-float-shadow">
                                                            <div class="img-holder">
                                                                <img src="{{ imageUrl('public/blog',$activeBlogTab->image) }}" alt="{{ $activeBlogTab->title }}">

                                                            </div>
                                                            <div class="text-holder">
                                                                <div class="classes-meta-info">
                                                                    <ul>
                                                                        <li class="text-normal">{{ title($activeBlogTab->title) }}</li>
                                                                    </ul>
                                                                </div>
                                                                <div class="text-box">
                                                                    <p class="text-normal">{{ title(strip_tags($activeBlogTab->description),160) }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
