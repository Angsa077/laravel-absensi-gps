<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Absensi extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'foto_masuk',
        'foto_keluar',
        'lokasi_masuk',
        'lokasi_keluar',
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

    /**
     * Method getJamInAttribute
     *
     * @return void
     */
    public function getJamInAttribute()
    {
        return $this->created_at ? Carbon::parse($this->created_at)->format('H:i:s') : '';
    }

    /**
     * Method getJamOutAttribute
     *
     * @return void
     */
    public function getJamOutAttribute()
    {
        return ($this->created_at == $this->updated_at) ? '' : Carbon::parse($this->updated_at)->format('H:i:s');
    }
}
