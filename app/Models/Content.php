<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Content extends Model
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $guarded = [
        'id',
    ];

    public function contentProgresses(): HasMany
    {
        return $this->hasMany(ContentProgress::class);
    }

    public function file(): HasOne
    {
        return $this->hasOne(File::class);
    }
}
