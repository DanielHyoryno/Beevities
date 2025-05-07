<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['organization_id', 'image', 'title', 'description'];

    // public function getImageAttribute($value)
    // {
    //     return $value ? 'data:image/jpeg;base64,' . base64_encode($value) : null;
    // }
    
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}