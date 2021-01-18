<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WindData extends Model
{
    public int $previousRead = 0;
    public float $speed = 0;
    public float $direction = 0;
}
