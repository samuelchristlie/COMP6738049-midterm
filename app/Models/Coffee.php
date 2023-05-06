<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coffee extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "name",
        "category",
        "description",
        "price",
        "imageUrl"
    ];

    protected $table = "coffees";
    protected $primaryKey = "id";
    public $timestamps = false;

    public function transaction(){
        return $this -> hasMany(Transaction::class);
    }
}
