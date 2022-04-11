@extends('admin.layouts.master')
@section('title','Forum detay')

@section('content')
    <div class="box box-default">
        <div class="box-body with-border">
            <div class="row">
                <div class="col-md-10">
                    <a href="{{ route('admin.home_page') }}"> <i class="fa fa-home"></i> Anasayfa</a>
                    › <a href="{{ route('admin.forum') }}"> @lang('admin.navbar.forum_comments')</a>
                    › {{ $item->title }}
                </div>
            </div>
        </div>
    </div>
    <form role="form" method="post" action="{{  route('admin.forum.comment.update',$item->id) }}" id="form" enctype="multipart/form-data">
        {{ csrf_field() }}
        @method('PUT')
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('admin.navbar.forum_comments') Detay</h3>
                        <div class="box-tools">
                            @if($item->user and loggedAdminUser()->isSuperAdmin())
                                [ <a title="{{ $item->user->email }}" href="{{ route('admin.user.edit',['user' => $item->user_id]) }}">Oluşturan : <i class="fa fa-user"></i> {{ $item->user->full_name }}</a> ]
                            @endif
                            @if($item->forum)
                                [ <a title="{{$item->forum->title }}" href="{{ route('admin.forum.edit',['forum' => $item->forum_id]) }}">Forum : <i class="fa fa-user"></i> {{ \Illuminate\Support\Str::substr($item->forum->title,0,20) }}..</a> ]
                            @endif
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-row">
                            <x-input name="user_name" label="Kullanıcı" width="12" horizontal :value="$item->user->name" disabled=""/>
                            <x-input name="user_email" label="Kullanıcı Email" width="12" horizontal :value="$item->user->email" disabled=""/>

                            @if(loggedAdminUser()->isSuperAdmin())
                                <div class="form-group col-md-12">
                                    <label for="id_manager_id" class="control-label col-sm-2">Yayında Mı ?</label>
                                    <div class="col-sm-10">
                                        <select name="status" id="id_status" class="form-control" required="required">
                                            @foreach(__('admin.modules.forum_comment.status') as $key => $status)
                                                <option value="{{ $key }}" {{ $key === $item->status ? 'selected' : '' }}>{{ $status['title'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group col-md-12">
                                <div class="col-md-12">
                                    <label for="exampleInputEmail1">Yorum</label>
                                    <textarea name="comment" class="form-control" id="editor1" cols="30" rows="5" maxlength="500">{{ old('comment',$item->comment) }}</textarea>
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

    </form>

@endsection
@section('footer')
    <script>
        $('select[id*="categories"]').select2({
            placeholder: 'kategori seçiniz'
        });
    </script>
@endsection

