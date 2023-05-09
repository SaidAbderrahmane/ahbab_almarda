<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telephone extends Model
{
    use HasFactory;

    protected $table = 'telephones';
    protected $primaryKey = 'key_tel';
    protected $guarded = ['key_tel'];
    
    public $timestamps = false;

    public function tiers()
    {
        return $this->belongsTo(Tiers::class,"key_tiers","key_tiers");
    }
    
}
