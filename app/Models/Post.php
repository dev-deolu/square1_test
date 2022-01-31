<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'uuid', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'publication_date' => 'date',
    ];

    /**
     * The default number of posts
     *
     * @var string
     */
    const POST_PAGE_SIZE = 50;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($post) {
            $post->uuid = (string) Str::uuid(); // Create uuid
        });
    }

     /**
     * @return \App\Models\Post[]
     */
    public static function getPosts()
    {
        return self::filter(request()->only('date_from', 'date_to'))->latest('publication_date')->get();
    }

    /**
     * @return \App\Models\Post[]
     */
    public static function getPostsPaginated(int $perPage = self::POST_PAGE_SIZE): LengthAwarePaginator
    {
        return self::filter(request()->only('date_from', 'date_to'))->latest('publication_date')->paginate($perPage);
    }

    /**
     * @return \App\Models\Post[]
     */
    public static function userPostsPaginated(int $perPage = self::POST_PAGE_SIZE)
    {
        return self::where('user_id', auth()->user()->id)->latest('publication_date')->get();
    }

    public function scopeFilter($query, array $filters)
    {
        if ((array_key_exists('date_from', $filters) && isset( $filters['date_from'])) && (array_key_exists('date_to', $filters) && isset( $filters['date_to']))) {
            $query->whereBetween('publication_date', [Carbon::createFromFormat('m/d/Y',  $filters['date_from'])->format('Y-m-d'), Carbon::createFromFormat('m/d/Y',  $filters['date_to'])->format('Y-m-d')]);
        }
    }
}
