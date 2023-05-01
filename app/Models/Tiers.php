<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiers extends Model
{
    use HasFactory;

    
    protected $table = 'tiers';
    protected $primaryKey = 'key_tiers';

    public $timestamps = false;
    protected $guarded = ['key_tiers'];
    protected $hidden = ['photo'];
    public function operationsDon()
    {
        return $this->hasMany(DetailOperation::class,"key_tiers","key_tiers");
    }
}
