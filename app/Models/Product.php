<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'stock', 'category_id', 'organization_id', 'image'];

    // public function getImageAttribute($value)
    // {
    //     return $value ? 'data:image/jpeg;base64,' . base64_encode($value) : null;
    // }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function invoiceDetails()
    {
        return $this->hasMany(InvoiceDetail::class, 'product_id');
    }
}