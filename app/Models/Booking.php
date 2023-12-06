<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

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
