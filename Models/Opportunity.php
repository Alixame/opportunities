<?php

namespace Alixame\Opportunities\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Opportunity extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // CAMPOS DA TABELA RECUPERADOS EM MASSA
    protected $fillable = [
        'name',
        'function',
        'unit_price',
        'unit_of_measure_id'
    ];
    
    protected $table = 'opportunities';
}