<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use SoftDeletes;

    /** @var array */
    protected $fillable = [
        'name', 'note',
    ];
}
