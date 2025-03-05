<!-- base view -->
@extends('common.admin.base')

<!-- CSS per page -->
@section('custom_css')
    @vite('resources/scss/admin/search.scss')
    @vite('resources/scss/admin/result.scss')
@endsection

<!-- main contents -->
@section('main_contents')
    <div class="page-wrapper create-page-wrapper container">
        <h2 class="title">ホテル作成</h2>
        <hr>
        <form action="{{ route('adminHotelCreateProcess') }}" method="post" enctype="multipart/form-data" class="hotel-form">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-group">
                    <label for="hotel_name" class="block text-lg font-semibold mb-2">ホテル名</label>
                    <input type="text" id="hotel_name" name="hotel_name" value="{{ old('hotel_name') }}" placeholder="ホテル名" class="input input-bordered w-full">
                    @error('hotel_name')
                    <span class="error text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="prefecture_id" class="block text-lg font-semibold mb-2">都道府県</label>
                    <select id="prefecture_id" name="prefecture_id" class="select select-bordered w-full">
                        <option value="">選択してください</option>
                        @foreach($prefectureList as $entry)
                            <option value="{{ $entry['prefecture_id'] }}" {{ old('prefecture_id') == $entry['prefecture_id'] ? 'selected' : '' }}>{{ $entry['prefecture_name'] }}</option>
                        @endforeach
                    </select>
                    @error('prefecture_id')
                    <span class="error text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="file_path" class="block text-lg font-semibold mb-2">画像</label>
                    <input type="file" id="file_path" name="file_path" class="file-input file-input-bordered w-full">
                    @error('file_path')
                    <span class="error text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="mt-6 text-center">
                <button type="submit" class="btn btn-primary w-full md:w-1/12">作成</button>
            </div>
        </form>
        <hr>
    </div>
@endsection
