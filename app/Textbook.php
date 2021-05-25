<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Textbook extends Model
{
    protected $fillable = ['isbn_no', 'title', 'author', 'classification_id', 'condition_id', 'price', 'buyer_id', 'seller_id', 'purchased_at', 'file_name', 'file_path'];
    public function buyer()
    {
        return $this->belongsTo(User::class);
    }
    public function seller()
    {
        return $this->belongsTo(User::class);
    }
    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }
    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }
}
