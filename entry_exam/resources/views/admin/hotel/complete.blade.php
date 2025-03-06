@extends('common.admin.base')

@section('main_contents')
    <div class="page-wrapper complete-page-wrapper container">
        <h2 class="title">ホテル編集完了</h2>
        <hr>
        <p>ホテルの編集が完了しました。</p>
        <a href="{{ route('adminHotelSearchResult') }}" class="btn btn-primary">戻る</a>
        <hr>
    </div>
@endsection
