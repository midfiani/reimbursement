<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reimburse extends Model
{
    use HasFactory;

    protected $table = 'reimburse';

    protected $fillable = [
        'nip',
        'reimburse_name',
        'amount',
        'description',
        'file_name',
        'status'
    ];
}
