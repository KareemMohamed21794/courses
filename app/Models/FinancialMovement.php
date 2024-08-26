<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialMovement extends Model
{
    use HasFactory;
    protected $fillable = ['admin_id','price','receipt_number','date','payment_method_id'];
    
     public function Admin()
    {
        return $this->belongsTo(Admin::class);
    }

     public function PaymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'id');
    }
}
