<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    use HasFactory;
    protected $fillable = [
        'no',
        'price',
        'image',
        'status',
    ];
    protected $casts = [
        'status' => 'boolean',
    ];
    protected $guarded = [
        'id'
    ];

    public function scopeFilter($query,array $filters)
    {
        
        $query->when($filters['search']?? false, function($query,$search){
            return $query->where('no','like','%'.$search.'%')
            ->orWhere('price','like','%'.$search.'%')
            ->orWhere('status','like','%'.$search.'%');
        });
    }

    public function booking(){
        return $this->hasMany(Booking::class);
    }
}
