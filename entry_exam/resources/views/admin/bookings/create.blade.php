@extends('common.admin.base')

@section('custom_css')
    @vite('resources/scss/admin/create.scss')
@endsection

@section('main_contents')
    <div class="page-wrapper create-page-wrapper container py-10 ">
        <h2 class="title text-3xl font-bold mb-10">新規予約作成</h2>
        <hr class="mb-10">
        <div class="search-hotel-name">
            <form action="{{ route('adminBookingStore') }}" method="post" class="hotel-form search-result px-[20px]">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="">
                        <label for="hotel_id" class="block text-lg font-semibold mb-3">ホテル</label>
                        <select name="hotel_id" required class="select select-bordered w-2/3">
                            @foreach($hotels as $hotel)
                                <option
                                    value="{{ $hotel['hotel_id'] }}" {{ old('hotel_id') == $hotel['hotel_id'] ? 'selected' : '' }}>
                                    {{ $hotel['hotel_name'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('hotel_id')
                        <p class="error text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="customer_name" class="block text-lg font-semibold mb-3">顧客名</label>
                        <input type="text" name="customer_name" value="{{ old('customer_name') }}" required
                               class="input input-bordered w-2/3">
                        @error('customer_name')
                        <p class="error text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="customer_contact" class="block text-lg font-semibold mb-3">顧客連絡先</label>
                        <input type="text" name="customer_contact" value="{{ old('customer_contact') }}" required
                               class="input input-bordered w-2/3">
                        @error('customer_contact')
                        <p class="error text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="checkin_time" class="block text-lg font-semibold mb-3">チェックイン日時</label>
                        <input type="datetime-local" name="checkin_time" value="{{ old('checkin_time') }}" required
                               class="input input-bordered w-2/3">
                        @error('checkin_time')
                        <p class="error text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="checkout_time" class="block text-lg font-semibold mb-3">チェックアウト日時</label>
                        <input type="datetime-local" name="checkout_time" value="{{ old('checkout_time') }}" required
                               class="input input-bordered w-2/3">
                        @error('checkout_time')
                        <p class="error text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mt-10 text-center">
                    <button type="submit" class="btn btn-primary w-1/12">作成</button>
                </div>
            </form>
        </div>
        <hr class="mt-10">
    </div>
@endsection
