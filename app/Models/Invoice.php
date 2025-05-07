<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable =[
        'invoice_number',
        'user_id',
        'address',
        'postal_code',
        'payment_proof',
        'total_price'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(InvoiceDetail::class, 'invoice_id');
    }
}
