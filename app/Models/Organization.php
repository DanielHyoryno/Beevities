<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'email', 'phone', 'website', 'banner_image', 'logo'];


    // public function getLogoAttribute($value)
    // {
    //     return $value ? 'data:image/png;base64,' . base64_encode($value) : null;
    // }

    // public function getBannerImageAttribute($value)
    // {
    //     return $value ? 'data:image/png;base64,' . base64_encode($value) : null;
    // }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}