<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Hotel;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function search(Request $request)
    {
        $query = Booking::query();

        if ($request->filled('customer_name')) {
            $query->where('customer_name', 'like', '%' . $request->input('customer_name') . '%');
        }

        if ($request->filled('customer_contact')) {
            $query->where('customer_contact', 'like', '%' . $request->input('customer_contact') . '%');
        }

        if ($request->filled('checkin_time')) {
            $query->where('checkin_time', '>=', $request->input('checkin_time'));
        }

        if ($request->filled('checkout_time')) {
            $query->where('checkout_time', '<=', $request->input('checkout_time'));
        }

        $bookings = $query->paginate();

        return view('admin.bookings.search', compact('bookings'));
    }

    public function create()
    {
        $hotels = Hotel::getHotelList();
        return view('admin.bookings.create', compact('hotels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotels,hotel_id',
            'customer_name' => 'required|string|max:255',
            'customer_contact' => 'required|string|max:255',
            'checkin_time' => 'required|date',
            'checkout_time' => 'required|date|after:checkin_time',
        ]);

        Booking::create($request->all());

        return redirect()->route('adminBookingSearchPage')->with('success', 'Booking created successfully');
    }
}
