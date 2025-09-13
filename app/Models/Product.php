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

    public function user(){
        return $this->belongsTo(User::class);
     }

    public function stoctmovements(){
        return $this->hasMany(StockMovement::class);
    }

    public function transactionItems(){
        return $this->hasMany(TransactionItem::class);
    }

    public function transactions(){
        return $this->hasManyThrough(Transaction::class, TransactionItem::class);
    }
    // Status standar
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

}
