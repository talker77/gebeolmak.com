@extends('site.layouts.base')
@section('title',$item->title)

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
                            <li class="active"><a href="{{ route('forum.index') }}#category-{{ $item->category->slug }}">{{ $item->category->title }}</a></li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                            <li class="">{{ $item->sub_category->title }}</li>
                        </ul>
                    </div>
                    <div class="right pull-right">
                        <a href="{{ route('forum.create',['category' => $item->sub_category_id]) }}">
                            <span><i class="fa fa-pencil" aria-hidden="true"></i>Yeni Konu Aç</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="blog-area" class="blog-large-area blog-single-area" style="padding-top: 25px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @include('site.layouts.partials.messages')
                    <div class="blog-post">

                        <!--End bottom content box-->
                        <!--Start tag and social share box-->

                        <!--End tag and social share box-->
                        <!--Start author box-->

                        <!--End author box-->
                        <!--Start comment box-->
                        <div class="comment-box" style="padding-top: 0px">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="left-sidebar">
                                        <div class="single-sidebar">
                                            <ul class="page-link">
                                                <li><span href="">{{ $item->title }}</span></li>
                                                <li><span>{!! $item->description !!}</span></li>
                                            </ul>
                                            <h6 class="post-date">{{ $item->created_at->translatedFormat('d M Y') }}</h6>
                                        </div>
                                    </div>
                                    <div class="sec-title pdb-30">

                                        <span class="border"></span>
                                    </div>
                                    @foreach($comments as $comment)
                                        <div class="single-comment-box">
                                            <div class="img-holder">
                                                <img src="/images/user-64px.png" alt="{{ $item->title }}">
                                            </div>
                                            <div class="text-holder">
                                                <div class="top">
                                                    <div class="date pull-left">
                                                        <h5>{{ $comment->user->full_name }} – {{ $comment->created_at->translatedFormat('d M Y H:i') }}</h5>
                                                    </div>
                                                </div>
                                                <div class="text">
                                                    <p>{{ $comment->comment }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{ $comments->links() }}
                                </div>

                            </div>
                        </div>
                        <!--End comment box-->
                        <!--Start add comment box-->
                        <div class="add-comment-box">
                            <div class="sec-title pdb-30">
                                <h3>Yorumlarınızı Ekleyin</h3>
                                <span class="border"></span>
                            </div>
                            <form id="add-comment-form" name="" action="{{ route('forum.comment.store',['forum' => $item->id]) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="field-label">Cevabınız</div>
                                                <textarea minlength="4" maxlength="255" name="comment" placeholder="Bu alana bir cevap yazınız.."></textarea>
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

                <!--End Sidebar Wrapper-->
            </div>
        </div>
    </section>
@endsection
