<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'body',
        'user_id',
    ];

    protected $relations = [
        'author',
    ];

    /**
     * Get the author of the post
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(related: User::class, foreignKey: 'user_id', ownerKey: 'id');
    }
}
