{{--<div class="preloader"></div>--}}

<!--Start mainmenu area-->
<section class="mainmenu-area stricky">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 clearfix">
                <!--Start logo-->
                <div class="logo pull-left">
                    <a href="/">
                        <img src="/images/resources/logo.png" alt="{{ $site->title }}">
                    </a>
                </div>
                <!--End logo-->
                <!--Start mainmenu-->
                <nav class="main-menu pull-left">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="navbar-collapse collapse clearfix">
                        <ul class="navigation clearfix">
                            @foreach($cacheCategories as $category)
                                <li class="dropdown"><a href="{{ route('category.detail',['category' => $category->slug]) }}">{{ $category->title }}</a>
                                    <ul>
                                        @foreach($category->sub_categories_active as $subCategory)
                                            <li><a href="{{ route('category.detail',['category' => $subCategory->slug]) }}">{{ $subCategory->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                            <li><a href="{{ route('forum.index') }}">Forum</a></li>
                        </ul>
                    </div>
                </nav>
                <!--End mainmenu-->
                <!--Start mainmenu right box-->
                <div class="mainmenu-right-box pull-right">
                    <div class="outer-search-box">
                        <div class="seach-toggle"><i class="fa fa-search"></i></div>
                        <ul class="search-box">
                            <li>
                                <form method="GET" action="{{ route('search') }}">
                                    <div class="form-group">
                                        <input type="search" name="search" placeholder="Sitede Ara.." required>
                                        <button type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--End mainmenu right box-->
            </div>
        </div>
    </div>
</section>
<!--End mainmenu area-->
