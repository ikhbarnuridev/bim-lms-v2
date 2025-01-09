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

    public function contents(): HasMany
    {
        return $this->hasMany(Content::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function getCoverUrl(): ?string
    {
        return $this->cover ? Storage::url($this->cover) : asset('assets/images/book-cover.png');
    }

    public function isDone()
    {
        $done = false;

        $contentProgresses = ContentProgress::query()
            ->whereRelation('content', 'material_id', $this->id)
            ->where('student_id', auth()->user()->student->id)
            ->get();

        foreach ($contentProgresses as $contentProgress) {
            if (!$contentProgress->is_done) {
                $done = false;
                break;
            }

            $done = true;
        }

        return $done;
    }
}
