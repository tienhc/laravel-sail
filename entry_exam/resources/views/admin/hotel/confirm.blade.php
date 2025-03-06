@extends('common.admin.base')

@section('main_contents')
    <div class="page-wrapper confirm-page-wrapper container">
        <h2 class="title">ホテル編集確認</h2>
        <hr>
        <div class="search-hotel-name">
            <form action="{{ route('adminHotelEditProcess', $hotel->hotel_id) }}" method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label for="hotel_name" class="block text-lg font-semibold mb-2">ホテル名</label>
                        <input type="text" id="hotel_name" name="hotel_name" value="{{ $data['hotel_name'] }}" readonly
                               class="input input-bordered w-2/3">
                    </div>
                    <div class="form-group">
                        <label for="prefecture_id" class="block text-lg font-semibold mb-2">都道府県</label>
                        <select id="prefecture_id" name="prefecture_id" class="select select-bordered w-2/3">
                            <option value="">選択してください</option>
                            @foreach($prefectureList as $entry)
                                <option
                                    value="{{ $entry['prefecture_id'] }}" {{ old('prefecture_id', $data['prefecture_id']) == $entry['prefecture_id'] ? 'selected' : '' }}>{{ $entry['prefecture_name'] }}</option>
                            @endforeach
                        </select>
                        @error('prefecture_id')
                        <span class="error text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="file_path" class="block text-lg font-semibold mb-2">画像</label>
                        @if($hotel->file_path)
                            <img src="{{ asset('assets/img/' . $hotel->file_path) }}" alt="Hotel Image"
                                 class="mb-4 w-32 h-32 object-cover">
                        @endif
                        <input type="hidden" name="file_path" value="{{ $data['file_path'] }}">
                    </div>
                </div>
                <div class="mt-6 text-center">
                    <button type="button" onclick="history.back()" class="btn btn-secondary w-full md:w-1/12">戻る
                    </button>
                    <button type="submit" class="btn btn-primary w-full md:w-1/12">更新</button>

                </div>
            </form>
        </div>
        <hr>
    </div>
@endsection
