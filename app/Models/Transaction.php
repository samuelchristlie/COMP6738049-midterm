<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "customerId",
        "coffeeId",
        "price",
        "timestamp"
    ];

    protected $table = "transactions";
    protected $primaryKey = "id";
    public $timestamps = false;

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function coffee(){
        return $this->belongsTo(Coffee::class);
    }
}
