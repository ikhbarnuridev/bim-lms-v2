<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Question extends Model
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function options(): HasMany
    {
        return $this->hasMany(Option::class);
    }
}
