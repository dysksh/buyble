<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    const CREATED_AT = null;
    const UPDATED_AT = null;
    public function textbooks()
    {
        return $this->hasMany(Textbook::class, 'classification_id');
    }
}
