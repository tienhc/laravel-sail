@extends('common.admin.base')

@section('custom_css')
    @vite('resources/scss/admin/search.scss')
    @vite('resources/scss/admin/result.scss')
@endsection

@section('main_contents')
    <div class="page-wrapper search-page-wrapper">
        <h2 class="title">予約情報検索</h2>
        <hr>
        <form action="{{ route('adminBookingSearchPage') }}" method="get">
            <input type="text" name="customer_name" value="{{ old('customer_name') }}" placeholder="顧客名">
            <input type="text" name="customer_contact" value="{{ old('customer_contact') }}" placeholder="顧客連絡先">
            <input type="datetime-local" name="checkin_time" value="{{ old('checkin_time') }}" placeholder="チェックイン日時">
            <input type="datetime-local" name="checkout_time" value="{{ old('checkout_time') }}" placeholder="チェックアウト日時">
            <button type="submit">検索</button>
        </form>
        <hr>
        @if(!empty($bookings->items()))
            <table class="shopsearchlist_table">
                <tbody>
                <tr>
                    <td nowrap="">顧客名</td>
                    <td nowrap="">顧客連絡先</td>
                    <td nowrap="">チェックイン日時</td>
                    <td nowrap="">チェックアウト日時</td>
                    <td nowrap="">予約日時</td>
                    <td nowrap="">情報更新日時</td>
                </tr>
                </tbody>
                <tbody>
                @foreach($bookings as $booking)
                    <tr style="background-color:#BDF1FF">
                        <td>{{ $booking->customer_name }}</td>
                        <td>{{ $booking->customer_contact }}</td>
                        <td>{{ $booking->checkin_time }}</td>
                        <td>{{ $booking->checkout_time }}</td>
                        <td>{{ $booking->created_at }}</td>
                        <td>{{ $booking->updated_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-5">
                {{ $bookings->onEachSide(0)->withQueryString()->links('pagination::tailwind') }}
            </div>
        @else
            <p class="text-center text-gray-500 mt-10">検索結果がありません</p>
        @endif
    </div>
@endsection
