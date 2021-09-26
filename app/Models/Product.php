<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function presentPrice()
    {
        return "NPR " . number_format($this->price);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity', 'weight_in_pound', 'choice', 'message');
    }
}
