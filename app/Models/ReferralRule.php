<?php

namespace App\Models;

use App\Concerns\HasPresenter;
use App\Contracts\Presentable;
use App\Enums\ReferralRuleType;
use App\Orchid\Filters\ReferralRuleTypeFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Orchid\Support\Presenter;

class ReferralRule extends Model implements Presentable
{
    use AsSource;
    use HasFactory;
    use Filterable;
    use HasPresenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'type',
        'interest',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'interest' => 'decimal:2',
        'type' => ReferralRuleType::class,
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        // Direct filters
        'type' => ReferralRuleTypeFilter::class,
    ];

    /**
     * Get the referrals associated with the referral rule.
     *
     * @return HasMany
     */
    public function referrals(): HasMany
    {
        return $this->hasMany(Referral::class);
    }
}
