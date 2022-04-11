@extends('admin.layouts.master')
@section('title','Forum Listesi')


@section('content')
    <div class="box box-default">
        <div class="box-body with-border">
            <div class="row">
                <div class="col-md-10">
                    <a href="{{ route('admin.home_page') }}"> <i class="fa fa-home"></i> Anasayfa</a>
                    › @lang('admin.navbar.forum')
                </div>
                <div class="col-md-2 text-right mr-3">
                    <a href="{{ route('admin.forum.new') }}"> <i class="fa fa-plus"></i> Yeni @lang('admin.navbar.forum') Ekle</a>&nbsp;
                    <a href="{{ route('admin.forum') }}"><i class="fa fa-refresh"></i>&nbsp;Yenile</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box ">
                <div class="box-header">
                    <h3 class="box-title">@lang('admin.navbar.forum')</h3>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered" id="tableForum">
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script src="/admin_files/js/pages/admin.forum.js"></script>
@endsection
