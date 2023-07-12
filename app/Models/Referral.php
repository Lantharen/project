<?php

namespace App\Models;

use App\Enums\ReferralStatus;
use App\Orchid\Filters\ReferralStatusFilter;
use App\Orchid\Filters\RelationalReferralRuleFilter;
use App\Orchid\Filters\RelationalReferrerFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Referral extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'referral_rule_id',
        'referrer_id',
        'referral_id',
        'status',
        'level',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'referral_rule_id' => 'integer',
        'referrer_id' => 'integer',
        'referral_id' => 'integer',
        'status' => ReferralStatus::class,
        'level' => 'integer',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        // Direct filters
        'status' => ReferralStatusFilter::class,

        // Relation filters
        'referral_rule_id' => RelationalReferralRuleFilter::class,
        'referrer_id' => RelationalReferrerFilter::class
    ];

    /**
     * Construct default value for Referral status
     *
     * @param  array  $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setAttribute('status', ReferralStatus::Pending);
    }

    /**
     * Get the referral rule related with the referral.
     *
     * @return BelongsTo
     */
    public function referralRule(): BelongsTo
    {
        return $this->belongsTo(ReferralRule::class, 'referral_rule_id');
    }

    /**
     * Get the referrer user related with the referral.
     *
     *
     * @return BelongsTo
     */
    public function referrer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    /**
     * Get the referral user related with the referral.
     *
     * @return BelongsTo
     */
    public function referral(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referral_id');
    }
}
