<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerMail extends Model
{
    use HasFactory;

    protected $table = 'customer_mail';
    protected $primaryKey = 'id';
    protected $fillable = ['customer_id', 'customer_email', 'subject', 'message','created_at', 'updated_at'];
}
