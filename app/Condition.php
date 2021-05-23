<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    const CREATED_AT = null;
    const UPDATED_AT = null;
    public function textbooks()
    {
        return $this->hasMany(Textbook::class, 'condition_id');
    }
}
