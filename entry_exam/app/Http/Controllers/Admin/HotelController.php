<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Prefecture;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HotelController extends Controller
{
    /** get methods */

    public function showSearch(): View
    {
        return view('admin.hotel.search');
    }

    public function showResult(): View
    {
        return view('admin.hotel.result');
    }

    public function showEdit($hotel_id): View
    {
        $hotel = Hotel::findOrFail($hotel_id);
        $prefectureList = Prefecture::getPrefectureList();
        return view('admin.hotel.edit', compact('hotel', 'prefectureList'));
    }

    public function showCreate(): View
    {
        $prefectureList = Prefecture::getPrefectureList();
        return view('admin.hotel.create', compact('prefectureList'));
    }

    /** post methods */

    public function searchResult(Request $request)
    {
//        $dataRq = $request->all();
//        if ($dataRq['hotel_name'] == null) {
//            return back()->with('error', ['Please enter hotel name']);
//        }
        $hotelNameToSearch = $request->input('hotel_name');
        $prefecture = $request->input('prefecture_id');
        $hotelList = Hotel::getHotelListByName($hotelNameToSearch, $prefecture);
        $prefectureList = Prefecture::getPrefectureList();

        return view('admin.hotel.result', compact('hotelList', 'hotelNameToSearch', 'prefectureList', 'prefecture'));
    }

    public function edit(Request $request, $hotel_id)
    {
        $this->validateHotel($request);

        $hotel = Hotel::findOrFail($hotel_id);

        if ($request->hasFile('file_path')) {
            $hotel->file_path = $this->uploadFile($request->file('file_path'));
        }

        $hotel->hotel_name = $request->input('hotel_name');
        $hotel->prefecture_id = $request->input('prefecture_id');
        $hotel->save();

        return redirect()->route('adminHotelSearchResult')->with('success', 'Hotel updated successfully');
    }

    public function create(Request $request)
    {
        $this->validateHotel($request);

        $filePath = $request->hasFile('file_path') ? $this->uploadFile($request->file('file_path')) : null;

        Hotel::create([
            'hotel_name' => $request->input('hotel_name'),
            'prefecture_id' => $request->input('prefecture_id'),
            'address' => $request->input('address'),
            'file_path' => $filePath,
        ]);

        return redirect()->route('adminHotelSearchResult')->with('success', 'Hotel created successfully');
    }

    private function validateHotel(Request $request)
    {
        $request->validate([
            'hotel_name' => 'required|string|max:255',
            'prefecture_id' => 'required|integer|exists:prefectures,prefecture_id',
            'file_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'hotel_name.required' => 'ホテル名を入力してください。',
            'hotel_name.string' => 'ホテル名は文字列でなければなりません。',
            'hotel_name.max' => 'ホテル名は255文字以内でなければなりません。',
            'prefecture_id.required' => '都道府県を選択してください。',
            'prefecture_id.integer' => '都道府県は整数でなければなりません。',
            'prefecture_id.exists' => '選択した都道府県は存在しません。',
            'file_path.image' => 'ファイルは画像でなければなりません。',
            'file_path.mimes' => 'ファイル形式はjpeg, png, jpg, gif, svgのいずれかでなければなりません。',
            'file_path.max' => 'ファイルサイズは2048KB以内でなければなりません。',
        ]);
    }

    private function uploadFile($file)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('assets/img/hoteltype'), $fileName);
        return 'hoteltype/' . $fileName;
    }

    public function delete(Request $request)
    {
        $hotel = Hotel::findOrFail($request->input('hotel_id'));
        $hotel->delete();

        return redirect()->route('adminHotelSearchResult', $request->except(['_token', 'hotel_id']))->with('success', 'Hotel deleted successfully');
    }
}
