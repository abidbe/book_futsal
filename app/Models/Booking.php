<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            $query->whereHas('user', function($userQuery) use ($search) {
                $userQuery->where('name', 'like', '%'.$search.'%');
            })
            ->orWhereHas('lapangan', function($lapanganQuery) use ($search) {
                $lapanganQuery->where('no', 'like', '%'.$search.'%');
            })
            ->orWhere('from', 'like', '%'.$search.'%')
            ->orWhere('to', 'like', '%'.$search.'%')
            ->orWhere('status', 'like', '%'.$search.'%')
            ->orWhere('payment', 'like', '%'.$search.'%');
        });
    }
    public static function totalSaldo()
    {
        $bookings = self::where('status', 1)->get();
        $totalSaldo = 0;

        foreach ($bookings as $booking) {
            $from = Carbon::parse($booking->from);
            $to = Carbon::parse($booking->to);
            $hourDifference = $to->diffInHours($from);

            $totalSaldo += $booking->lapangan->price * $hourDifference;
        }

        return $totalSaldo;
    }
    protected $fillable=[
        'user_id',
        'lapangan_id',
        'from',
        'to',
        'status',
        'payment'
    ];
    protected $casts=[
        'from'=>'datetime',
        'to'=>'datetime',
        'status'=>'boolean',
        'total'=>'integer'
    ];
    protected $guarded=[
        'id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function lapangan(){
        return $this->belongsTo(Lapangan::class);
    }
}
