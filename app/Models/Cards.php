<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cards extends Model
{
    use HasFactory;

    protected $fillable = [
        'mylist_id', 'title', 'description', 'attachment', 'completed'
    ];

    public function list()
    {
        return $this->belongsTo('App\Models\Mylist');
    }
}
