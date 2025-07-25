<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name', 'subcategory_id', 'image', 'is_popular'];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
