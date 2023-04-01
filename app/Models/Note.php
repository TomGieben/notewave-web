<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public function getPreviewContent(): string {
        return Str::words($this->content, 10);
    }
}
