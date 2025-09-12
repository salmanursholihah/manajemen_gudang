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
    return $this->belongsTo(Customer::class);
}
public function supplier(){
    return $this->belongsTo(Supplier::class);
}

public function user(){
    return $this->belongsTo(User::class);
}
public function items(){
    return $this->hasMany(TransactionItem::class);
}
}
