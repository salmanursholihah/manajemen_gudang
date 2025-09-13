<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded =[];
  protected $casts = [
        'date' => 'datetime', 
    ];

   public function customer()
{
    return $this->belongsTo(Customer::class, 'customer_id');
}
public function supplier(){
    return $this->belongsTo(Supplier::class, 'supplier_id');
}

public function user(){
    return $this->belongsTo(User::class);
}
public function items(){
    return $this->hasMany(TransactionItem::class);
}

public function product()
{
    return $this->belongsTo(Product::class);
}

public function operator(){
    return $this->belongsTo(User::class, 'user_id');
}
}
