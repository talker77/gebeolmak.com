@extends('site.layouts.base')
@section('title',"Konu Aç | ". $site->title)

@section('header')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: 'textarea#editor',
            menubar: false,
        });
    </script>
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
                            <li ><a href="{{ route('forum.index') }}">Forum</a></li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                            <li class="">Yeni Konu Aç</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="" style="margin-top: 25px">
        <div class="container">
            @include('site.layouts.partials.messages')
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="left-sidebar">
                        <div class="single-sidebar">
                            <ul class="page-link" style="margin-bottom: 30px">
                                <li><span href="">Yeni Konu Aç</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="row justify-content-md-center" style="margin-bottom: 25px">
                        <form action="{{ route('forum.store') }}" method="POST">
                            @csrf
                            <div class="col-md-12 col-lg-12">

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Konu Başlığı</label>
                                    <input type="text" name="title" class="form-control" required placeholder="Konu Başlığı" value="{{ old('title') }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Kategori</label>
                                    <select name="sub_category_id" id="" class="form-control">
                                        @foreach($categories as $category)
                                            <option  disabled>{{ $category->title }}</option>
                                            @foreach($category->sub_categories as $subCategory)
                                                <option value="{{ $subCategory->id }}"
                                                    {{ request()->get('category') == $subCategory->id ? 'selected' : '' }}
                                                >
                                                    &nbsp; --- {{ $subCategory->title }}
                                                </option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>

                                <label>Konu Hakkında Kısa Açıklama</label>
                                <div class="form-group">
                                    <textarea id="editor" name="description" maxlength="2000">{{ old('description') }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Konu Aç</button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer')

@endsection
