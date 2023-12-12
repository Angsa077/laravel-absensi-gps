<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'tgl_izin',
        'status',
        'keterangan',
        'status_approved',
    ];
    
    /**
     * Method user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
