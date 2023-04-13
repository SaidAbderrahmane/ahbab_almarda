<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiers extends Model
{
    use HasFactory;

    
    protected $table = 'tiers';
    protected $primaryKey = 'key_tiers';

    public function operationDon()
    {
        return $this->hasMany(DetailOperation::class);
    }
}
