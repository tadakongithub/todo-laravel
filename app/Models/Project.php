<?php

namespace App\Models;

use App\Models\ToDo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function todos()
    {
        return $this->hasMany(ToDo::class);
    }

}
