@extends('site.layouts.base')
@section('title',$item->title)

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
                            @if($item->category)
                                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                                <li>
                                    <a href="{{ route('category.detail',['category' => $item->category->slug]) }}">
                                        {{ $item->category->title }}
                                    </a>
                                </li>
                            @endif
                            @if($item->sub_category)
                                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                                <li>
                                    <a href="{{ route('category.detail',['category' => $item->sub_category->slug]) }}">
                                        {{ $item->sub_category->title }}
                                    </a>
                                </li>
                            @endif
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                            <li>{{ $item->title }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End breadcrumb bottom area-->
    <!--End breadcrumb bottom area-->

    <!--Start blog Single area-->
    <section id="blog-area" class="blog-large-area blog-single-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                    <div class="blog-post">
                        <!--Start single blog post-->
                        <div class="single-blog-post text-left">
                            <div class="img-holder">
                                <img src="{{ imageUrl('public/blog',$item->image) }}" alt="{{ $item->title }}">
                                <div class="published-date">
                                    <h5>{{ $item->created_at->translatedFormat('d M') }}<br><span>{{ $item->created_at->format('Y') }}</span></h5>
                                </div>
                            </div>
                            <div class="text-holder">
                                <a href="#">
                                    <h3 class="blog-title">
                                        {{ $item->title }}
                                    </h3>
                                </a>
                                <div class="meta-info clearfix">
                                    <ul class="post-info">
                                        @if($item->writer)
                                            <li><i class="fa fa-user" aria-hidden="true"></i><a href="#">{{ $item->writer->full_name }}</a></li>
                                        @endif
                                        <li><i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href="{{ route('category.detail',['category' => $item->category->slug]) }}">{{ $item->category->title }}</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="text">
                                    {!! $item->description !!}
                                </div>
                            </div>
                        </div>
                        <!--End single blog post-->
                        <!--Start comment box-->
                        <div class="comment-box">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="sec-title pdb-30">
                                        <h3>Yorumlar</h3>
                                        <span class="border"></span>
                                    </div>
                                    <!--Start single comment box-->
                                    <div class="single-comment-box">
                                        <div class="img-holder">
                                            <img src="/images/blog/comment-1.jpg" alt="Awesome Image">
                                        </div>
                                        <div class="text-holder">
                                            <div class="top">
                                                <div class="date pull-left">
                                                    <h5>Steven Rich – Sep 17, 2016:</h5>
                                                </div>
                                                <div class="review-box pull-right">
                                                    <ul>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="text">
                                                <p>How all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End single comment box-->
                                    <!--Start single comment box-->
                                    <div class="single-comment-box">
                                        <div class="img-holder">
                                            <img src="/images/blog/comment-2.jpg" alt="Awesome Image">
                                        </div>
                                        <div class="text-holder">
                                            <div class="top">
                                                <div class="date pull-left">
                                                    <h5>William Cobus – Aug 21, 2016:</h5>
                                                </div>
                                                <div class="review-box pull-right">
                                                    <ul>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-half-o"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="text">
                                                <p>there anyone who loves or pursues or desires to obtain pain itself, because it is pain, because occasionally circumstances occur some great pleasure.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End single comment box-->
                                </div>
                            </div>
                        </div>
                        <!--End comment box-->
                        <!--Start add comment box-->
                        <div class="add-comment-box">
                            <div class="sec-title pdb-30">
                                <h3>Gönderiyi Puanla</h3>
                                <span class="border"></span>
                            </div>
                            <div class="add-rating-box">
                                <h4>Puanın</h4>
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-star"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <form id="add-comment-form" name="comment-form" action="{{ route('blog.comment.store',['blog' => $item->id]) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="field-label">Adınız*</div>
                                                <input type="text" name="name" placeholder="" required="">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="field-label">Soyadınız*</div>
                                                <input type="text" name="surname" placeholder="" required="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="field-label">Email*</div>
                                                <input type="email" name="email" placeholder="" required="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="field-label">Yorum</div>
                                                <textarea name="comment"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="thm-btn bgclr-1" type="submit">Gönder</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--End add comment box-->
                    </div>
                </div>
                <!--Start sidebar Wrapper-->
                <div class="col-lg-3 col-md-6 col-sm-7 col-xs-12">
                    <div class="sidebar-wrapper">
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
                                @if($item->tags)
                                    @foreach($item->tags as $tag)
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
    <!--End blog Single area-->
@endsection

