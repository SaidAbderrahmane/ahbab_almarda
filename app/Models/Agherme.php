<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agherme extends Model
{
    use HasFactory;

    protected $table = 'agherme';
    protected $primaryKey = 'key_agherme';

    public $timestamps = false;

    protected $fillable = ["agherme"];
}
