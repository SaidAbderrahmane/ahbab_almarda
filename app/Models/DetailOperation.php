<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOperation extends Model
{
    use HasFactory;
    
    protected $table = 'detail_operation';
    protected $primaryKey = 'key_detail_operation';
    public $guarded = ['key_detail_operation'];
    const CREATED_AT = 'date_creat';
    const UPDATED_AT = 'date_modif';

    public function operationDon()
    {
        return $this->belongsTo(OperationDon::class,"key_operation","key_operation");
    }

    public function donneur()
    {
        return $this->belongsTo(Tiers::class,"key_tiers","key_tiers");
    }

}
