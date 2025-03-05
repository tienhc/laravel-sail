<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hotel extends Model
{
    /**
     * @var string
     */
    protected $primaryKey = 'hotel_id';

    /**
     * @var array
     */
    protected $guarded = ['hotel_id'];

    /**
     * @return BelongsTo
     */
    public function prefecture(): BelongsTo
    {
        return $this->belongsTo(Prefecture::class, 'prefecture_id', 'prefecture_id');
    }

    /**
     * Search hotel by hotel name
     *
     * @param ?string $hotelName
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    static public function getHotelListByName(?string $hotelName, ?int $prefecture): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $result = Hotel::when($hotelName, function ($query, $hotelName) {
            return $query->where('hotel_name', 'like', '%' . $hotelName . '%');
        })
            ->when($prefecture, function ($query, $prefecture) {
                return $query->where('prefecture_id', $prefecture);
            })
            ->with('prefecture')
            ->orderBy('hotel_id', 'asc')
            ->paginate();

        return $result;
    }

    /**
     * Override serializeDate method to customize date format
     *
     * @param \DateTimeInterface $date
     * @return string
     */
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    /**
     * Get the bookings for the hotel.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'hotel_id', 'hotel_id');
    }

    /**
     * Get hotel_id & hotel_name.
     * @return array
     */
    static public function getHotelList(){
        $entries = Hotel::select('hotel_id', 'hotel_name')->get()->toArray();
        return $entries;
    }
}
