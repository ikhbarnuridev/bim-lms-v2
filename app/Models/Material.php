<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Wildside\Userstamps\Userstamps;

class Material extends Model
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $guarded = [
        'id',
    ];

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }

    public function materialStatuses(): HasMany
    {
        return $this->hasMany(MaterialStatus::class);
    }

    public function getCoverUrl(): ?string
    {
        return $this->photo ? Storage::url($this->cover) : asset('assets/images/book-cover.png');
    }
}
