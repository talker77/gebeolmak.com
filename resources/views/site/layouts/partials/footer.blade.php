<!--Start footer bottom area-->
<footer class="footer-area" style="background-image:url(images/footer/footer-bg.jpg);">
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <!--Start single footer widget-->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="single-footer-widget mar-bottom">
                        <div class="title">
                            <h3>GebeOlmak.com Hakkında</h3>
                            <span class="border"></span>
                        </div>
                        <div class="our-info">
                            <p>{!! $site->footer_text !!}</p>
                            <a href="{{ route('about') }}">Daha Fazla<i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!--End single footer widget-->
                <!--Start single footer widget-->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="single-footer-widget mar-bottom">
                        <div class="title">
                            <h3>Kategoriler</h3>
                            <span class="border"></span>
                        </div>
                        <ul class="service-list">
                            @foreach($cacheCategories as $category)
                                <li><a href="{{ route('category.detail',['category'  => $category->slug]) }}"><i class="fa fa-angle-right" aria-hidden="true"></i>{{ $category->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!--End single footer widget-->
                <!--Start single footer widget-->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="single-footer-widget mar-bottom">
                        <div class="title">
                            <h3>Hızlı Erişim</h3>
                            <span class="border"></span>
                        </div>
                        <ul class="service-list">
                                <li><a href="{{ route('about') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Hakkımızda</a></li>
                                <li><a href="{{ route('user.login') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Giriş</a></li>
                                <li><a href="{{ route('forum.index') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Forum</a></li>
                                <li><a href="{{ route('user.dashboard') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Hesabım</a></li>
                                <li><a href="{{ route('content.detail',['content' => 'gizlilik-politikasi']) }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Gizlilik Politikası</a></li>
                                <li><a href="{{ route('contact') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>İletişim</a></li>
                        </ul>
                    </div>
                </div>
                <!--End single footer widget-->
                <!--Start single footer widget-->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="single-footer-widget mar-bottom">
                        <div class="title">
                            <h3>Son Gönderiler</h3>
                            <span class="border"></span>
                        </div>
                        <ul class="service-list">
                            @foreach($lastBlogs as $lastBlog)
                                <li><a href="{{ route('blog.detail',['blog' => $lastBlog->slug]) }}" title="{{ $lastBlog->title }}">
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>{{ \Illuminate\Support\Str::limit($lastBlog->title,25) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!--End single footer widget-->
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-8 col-xs-12">
                    <div class="copy-right">
                        <p>Copyrights © Tüm Hakları Saklıdır. <a href="">GebeOlmak</a></p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="footer-social-link">
                        <ul class="social-links">
                            <li><a href="{{ $site->facebook }}"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="{{ $site->twitter }}"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="{{ $site->instagram }}"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="{{ $site->linkedin }}"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--End footer bottom area-->
