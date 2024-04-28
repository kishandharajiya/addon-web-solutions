<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    
    //########################## RELASTIONSHIPS ##########################
   
    /**
     * Retrieve the user that the post belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to search for records by title or body.
     */
    public function scopeSearch($query,$search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('title', 'LIKE', "%$search%")->orWhere('body', 'LIKE', "%$search%");
        });
    }

}
