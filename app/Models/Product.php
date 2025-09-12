<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function Supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function stoctmovements(){
        return $this->hasMany(StockMovement::class);
    }

    public function transactionItems(){
        return $this->hasMany(TransactionItem::class);
    }
}
