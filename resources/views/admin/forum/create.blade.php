@extends('admin.layouts.master')
@section('title','Forum detay')

@section('content')
    <div class="box box-default">
        <div class="box-body with-border">
            <div class="row">
                <div class="col-md-10">
                    <a href="{{ route('admin.home_page') }}"> <i class="fa fa-home"></i> Anasayfa</a>
                    › <a href="{{ route('admin.forum') }}"> @lang('admin.navbar.forum')</a>
                    › {{ $item->title }}
                </div>
            </div>
        </div>
    </div>
    <form role="form" method="post" action="{{ $item->id ?  route('admin.forum.update',$item->id) : route('admin.forum.store') }}" id="form" enctype="multipart/form-data">
        {{ csrf_field() }}
        @method($item->id ? 'PUT' : 'POST')
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('admin.navbar.forum') Detay</h3>
                        <div class="box-tools">
                            @if($item->writer and loggedAdminUser()->isSuperAdmin())
                                [ <a title="{{ $item->writer->email }}" href="{{ route('admin.user.edit',['user' => $item->writer_id]) }}">Oluşturan : <i class="fa fa-user"></i> {{ $item->writer->full_name }}</a> ]
                            @endif
                            @if($item->id)
                                ---  [ <a href="{{ route('forum.detail',['forum' => $item->slug]) }}">Sitede Görüntüle : <i class="fa fa-eye"></i></a> ]
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-row">
                            <x-input name="title" label="Başlık" width="12" horizontal :value="$item->title" required maxlength="255"/>
                            <x-select
                                name="category_id"
                                horizontal
                                label="Kategori"
                                :options="$categories->toArray()" width="12"
                                :value="$item->category_id"
                                onchange="subCategoriesByCategoryId(this.value)"
                                required
                            />
                            <x-select
                                name="sub_category_id"
                                horizontal
                                label="Alt Kategori"
                                :options="$subCategories" width="12"
                                :value="$item->sub_category_id"
                            />
                            @if(loggedAdminUser()->isSuperAdmin())
                                <div class="form-group col-md-12">
                                    <label for="id_manager_id" class="control-label col-sm-2">Yayında Mı ?</label>
                                    <div class="col-sm-10">
                                        <select name="status" id="id_status" class="form-control"  required="required">
                                            @foreach(__('admin.modules.forum.status') as $key => $status)
                                                <option value="{{ $key }}" {{ $key == $item->status ? 'selected' : '' }}>{{ $status['title'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <x-select name="manager_id" label="Moderatör" width="12" :value="$item->manager_id" :options="$moderators" option-value="full_name" horizontal required/>
                            @endif
                            <div class="form-group col-md-12">
                                @if(admin('modules.blog.image'))
                                    <x-input name="image" type="file" label="Görsel" width="2" :value="$item->image" path="blog"/>
                                @endif
                                @if(admin('multi_lang'))
                                    <x-select name="lang" label="Dil" width="2" :value="$item->lang" :options="$languages" key="0" option-value="1" nohint/>
                                @endif
                                @if(admin('modules.blog.tag'))
                                    <div class="form-group col-md-8">
                                        <label for="exampleInputEmail1">Kelimeler(Tags)</label>
                                        <select class="form-control" multiple="multiple" id="tags" name="tags[]">
                                            @if($item->tags)
                                                @foreach($item->tags as $tag)
                                                    <option value="{{ $tag }}" selected>{{ $tag }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Açıklama</label>
                                    <textarea name="description" class="form-control" id="editor1" cols="30" rows="20">{{ old('description',$item->description) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer text-right">
                        <button type="submit" class="btn btn-success">Kaydet</button>
                    </div>

                </div>
            </div>
        </div>
        @include('laravel-meta-tags::meta-tags')

    </form>

@endsection
@section('footer')
    <script src="//cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
    <script>
        $(function () {
            var options = {
                language: 'tr',
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
                height: 450
            };
            CKEDITOR.replace('editor1', options);

            $('#tags').select2({
                tags: true,
                tokenSeparators: [',', ' ']
            })
        })
        $('select[id*="categories"]').select2({
            placeholder: 'kategori seçiniz'
        });
    </script>
@endsection

