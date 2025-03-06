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
            <form action="{{ route('adminHotelSearchResult') }}" method="get" class="flex gap-[20px]">
                <div class="form-group">
                    <input type="text" id="hotel_name" name="hotel_name"
                           value="{{ old('hotel_name', $hotelNameToSearch ?? '') }}" placeholder="ホテル名">
                    @error('hotel_name')
                    <p class="error text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <select id="prefecture_id" name="prefecture_id">
                        <option value="">都道府県</option>
                        @foreach($prefectureList as $entry)
                            <option value="{{ $entry['prefecture_id'] }}"
                                    @if($prefecture == $entry['prefecture_id']) selected @endif>
                                {{ $entry['prefecture_name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit">検索</button>
                </div>
            </form>
        </div>
        <hr>
    </div>
    @yield('search_results')
@endsection
