<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'mobile', 'address_line_one', 'address_line_two', 'pin', 'city', 'state', 'product_id', 'client_ip'];
    
    public function category()
    {
        return $this->belongsTo(Product::class);
    }
}
