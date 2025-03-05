<!-- base view -->
@extends('common.admin.base')

<!-- CSS per page -->
@section('custom_css')
    @vite('resources/scss/admin/search.scss')
    @vite('resources/scss/admin/result.scss')
@endsection

<!-- main containts -->
@section('main_contents')
    <div class="page-wrapper search-page-wrapper">
        <h2 class="title">検索画面</h2>
        <hr>
        <div class="search-hotel-name">
            <form action="{{ route('adminHotelSearchResult') }}" method="get">
                <input type="text" name="hotel_name" value="{{ old('hotel_name', $hotelNameToSearch ?? '') }}" placeholder="ホテル名">
                <select name="prefecture_id">
                    <option>都道府県</option>
                    @foreach($prefectureList as $entry)
                        <option value="{{ $entry['prefecture_id'] }}" @if($prefecture == $entry['prefecture_id']) selected @endif>{{ $entry['prefecture_name'] }}</option>
                    @endforeach
                </select>
                <button type="submit">検索</button>
            </form>
        </div>
        <hr>
    </div>
    @yield('search_results')
@endsection
