<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Textbook extends Model
{
    protected $fillable = ['isbn_no', 'title', 'author', 'classification', 'condition', 'price', 'buyer_id', 'seller_id', 'purchased_at'];
    public function buyer()
    {
        return $this->belongsTo(User::class);
    }
    public function seller()
    {
        return $this->belongsTo(User::class);
    }
}
