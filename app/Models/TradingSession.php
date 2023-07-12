<?php

namespace App\Models;

use App\Concerns\HasPresenter;
use App\Contracts\Presentable;
use App\Enums\TradingSessionStatus;
use App\Orchid\Filters\RelationalOfferNameFilter;
use App\Orchid\Filters\RelationalUserNameFilter;
use App\Orchid\Filters\TradingSessionStatusFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class TradingSession extends Model implements Presentable
{
    use HasFactory;
    use AsSource;
    use Filterable;
    use HasPresenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'offer_id',
        'status',
        'investment',
        'interest',
        'start_at',
        'end_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'offer_id' => 'integer',
        'status' => TradingSessionStatus::class,
        'investment' => 'decimal:2',
        'interest' => 'decimal:2',
        'start_at' => 'date',
        'end_at' => 'date',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        // Direct filters
        'status' => TradingSessionStatusFilter::class,

        // Relational filters
        'name' => RelationalUserNameFilter::class,
        'offer' => RelationalOfferNameFilter::class,
    ];

    /**
     * Get the user that owns the attribute.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => __('Deleted')
        ]);
    }

    /**
     * Get the offer that owns the attribute.
     *
     * @return BelongsTo
     */
    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class)->withDefault([
            'name' => __('Deleted')
        ]);
    }
}
