<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $table = 'project_currencies';
    protected $fillable = [
        'code_alfa',
        'code_num',
        'rate_buy',
        'rate_sell',
        'rate_cross',
    ];
}
