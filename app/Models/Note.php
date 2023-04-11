<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
Use Illuminate\Support\Str;

class Note extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'is_public',
        'slug',
        'title',
        'content',
        'sharing_key',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getShareLink(): string {
        return route('notes.share', $this->sharing_key);
    }

    public function isPublic(): bool {
        return (bool)$this->is_public;
    }

    public function isShared(): bool {
        $sharedNotes = auth()->user()
            ->sharedNotes()
            ->select('note_id')
            ->where('note_id', $this->id)
            ->first();

        return $sharedNotes ? true : false;
    }

    public function getPreviewContent(): string {
        return Str::words($this->content, 10);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, SharedNote::class)
            ->whereNull('shared_notes.deleted_at')
            ->withTimestamps();
    }
}
