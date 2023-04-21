<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationDon extends Model
{
    use HasFactory;

    protected $table = 'operation_don';
    protected $primaryKey = 'key_operation';

    public function location()
    {
        return $this->belongsTo(Lieu::class,'key_lieu','key_lieu');
    }

    public function detailOperation()
    {

        return $this->hasMany(DetailOperation::class,'key_operation','key_operation');
    }
}
