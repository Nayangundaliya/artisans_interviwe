<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSms extends Model
{
    use HasFactory;
    protected $table = 'customer_sms';
    protected $primaryKey = 'id';
    protected $fillable = ['customer_id', 'customer_name', 'message','created_at', 'updated_at'];
}
