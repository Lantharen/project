<?php

namespace App\Models;

use App\Concerns\HasPresenter;
use App\Contracts\Presentable;
use App\Orchid\Filters\IpAddressFilter;
use App\Orchid\Filters\PathFilter;
use App\Orchid\Filters\RelationalUserNameFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class HttpLog extends Model implements Presentable
{
    use AsSource, Filterable, HasFactory, HasPresenter;

    /**
     * The name of the "updated at" column.
     *
     * @var string|null
     */
    public const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'method',
        'path',
        'ip',
        'headers',
        'attributes',
        'status_code',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'headers' => 'array',
        'attributes' => 'array',
        'status_code' => 'integer',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        // Direct filters
        'path' => PathFilter::class,
        'ip' => IpAddressFilter::class,

        // Relational filters
        'name' => RelationalUserNameFilter::class,
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'created_at',
    ];

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 100;

    /**
     * Get the user associated with the HTTP log.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => __('Unknown'),
        ]);
    }
}
