@extends('admin.layouts.master')
@section('title','Forum Listesi')


@section('content')
    <div class="box box-default">
        <div class="box-body with-border">
            <div class="row">
                <div class="col-md-10">
                    <a href="{{ route('admin.home_page') }}"> <i class="fa fa-home"></i> Anasayfa</a>
                    › @lang('admin.navbar.forum_comments')
                </div>
                <div class="col-md-2 text-right">
                    <a href="{{ route('admin.forum.comment') }}"><i class="fa fa-list"></i> Tüm Yorumlar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box ">
                <div class="box-header">
                    <h3 class="box-title">@lang('admin.navbar.forum_comments')</h3>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered" id="tableForumComment">
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script src="/admin_files/js/pages/admin.forum.comment.js"></script>
@endsection
