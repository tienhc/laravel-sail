@extends('admin.hotel.search')

@section('search_results')
    <div class="page-wrapper search-page-wrapper">
        <div class="search-result">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg m-[10px]" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <h3 class="search-result-title">検索結果</h3>
            @if (!empty($hotelList->items()))
                <table class="shopsearchlist_table">
                    <tbody>
                    <tr>
                        <td nowrap="" id="hotel_name">
                            ホテル名
                        </td>
                        <td nowrap="" id="pref">
                            都道府県
                        </td>
                        <td nowrap="" id="created_at">
                            登録日
                        </td>
                        <td nowrap="" id="updated_at">
                            更新日
                        </td>
                        <td class="btn_center" id="edit"></td>
                        <td class="btn_center" id="delete"></td>
                    </tr>

                    @foreach($hotelList as $hotel)
                        <tr style="background-color:#BDF1FF">
                            <td>
                                <a href="" target="_blank">{{ $hotel['hotel_name'] }}</a>
                            </td>
                            <td>
                                {{ $hotel['prefecture']['prefecture_name'] }}
                            </td>
                            <td>
                                {{ (string) $hotel['created_at'] }}
                            </td>
                            <td>
                                {{ (string) $hotel['updated_at'] }}
                            </td>
                            <td>
                                <a href="{{ route('adminHotelEditPage', ['hotel_id' => $hotel['hotel_id']]) }}" class="btn btn-primary">編集</a>
                            </td>
                            <td>
                                <a href="{{ route('adminHotelDeleteProcess', array_merge(request()->query(), ['hotel_id' => $hotel['hotel_id']])) }}"
                                   class="btn btn-danger"
                                   onclick="event.preventDefault(); confirmDelete({{ $hotel['hotel_id'] }});">削除</a>
                                <form id="delete-form-{{ $hotel['hotel_id'] }}" action="{{ route('adminHotelDeleteProcess', request()->query()) }}" method="post" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="hotel_id" value="{{ $hotel['hotel_id'] }}">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>検索結果がありません</p>
            @endif
            <div class="w-[600px]">
                {{ $hotelList->onEachSide(0)->withQueryString()->links('pagination::tailwind') }}
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(hotelId) {
            Swal.fire({
                title: '削除確認',
                text: 'このホテルを削除してもよろしいですか？',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'はい',
                cancelButtonText: 'キャンセル'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + hotelId).submit();
                }
            });
        }
    </script>
@endsection

