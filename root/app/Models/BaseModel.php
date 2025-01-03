<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected function serializeDate($date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
