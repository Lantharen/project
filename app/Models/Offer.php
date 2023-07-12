<?php

namespace App\Models;


use App\Concerns\HasPresenter;
use App\Contracts\Presentable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Screen\AsSource;

class Offer extends Model implements Presentable
{
    use AsSource, SoftDeletes, HasFactory, HasPresenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'min_investment',
        'max_investment',
        'min_interest',
        'max_interest',
        'duration_in_seconds',
        'position',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'min_investment' => 'decimal:2',
        'max_investment' => 'decimal:2',
        'min_interest' => 'decimal:2',
        'max_interest' => 'decimal:2',
        'duration_in_seconds' => 'integer',
        'position' => 'integer',
    ];

    /**
     * Global scope visibility for the Offer model and automatic sorting on EVERY request
     *
     * {@inheritDoc}
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('ordering', static function (Builder $builder) {
            $builder->orderBy('position');
        });
    }

    /**
     * Get the attributes for the offer.
     *
     * @return HasMany
     */
    public function attributes(): HasMany
    {
        return $this->hasMany(OfferAttribute::class);
    }

    /**
     * Get the trading sessions for the offer.
     *
     * @return HasMany
     */
    public function tradingSessions(): HasMany
    {
        return $this->hasMany(TradingSession::class);
    }
}
