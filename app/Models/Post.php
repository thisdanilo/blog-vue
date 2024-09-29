<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use App\Models\Scopes\FilterByUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([FilterByUser::class])]
class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'image',
        'slug',
        'content',
        'status',
        'category_id',
        'user_id'   
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()  
    {
        return $this->belongsTo(User::class);
    }
}
