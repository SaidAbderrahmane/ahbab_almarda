<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lieu extends Model
{
    use HasFactory;

    protected $table = 'lieu';
    protected $primaryKey = 'key_lieu';

    public $timestamps = false;
    public $fillable =['nom_lieu'];
}
