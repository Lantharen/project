<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\HttpLog
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $method
 * @property string $path
 * @property string $ip
 * @property array $headers
 * @property array|null $attributes
 * @property int $status_code
 * @property \Illuminate\Support\Carbon $created_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|HttpLog defaultSort(string $column, string $direction = 'asc')
 * @method static \Database\Factories\HttpLogFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|HttpLog filters(?mixed $kit = null, ?\Orchid\Filters\HttpFilter $httpFilter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|HttpLog filtersApply(iterable $filters = [])
 * @method static \Illuminate\Database\Eloquent\Builder|HttpLog filtersApplySelection($class)
 * @method static \Illuminate\Database\Eloquent\Builder|HttpLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HttpLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HttpLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|HttpLog whereAttributes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HttpLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HttpLog whereHeaders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HttpLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HttpLog whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HttpLog whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HttpLog wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HttpLog whereStatusCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HttpLog whereUserId($value)
 */
	class HttpLog extends \Eloquent implements \App\Contracts\Presentable {}
}

namespace App\Models{
/**
 * App\Models\Offer
 *
 * @property int $id
 * @property string $name
 * @property string $min_investment
 * @property string|null $max_investment
 * @property string $min_interest
 * @property string|null $max_interest
 * @property int $duration_in_seconds
 * @property int $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OfferAttribute> $attributes
 * @property-read int|null $attributes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TradingSession> $tradingSessions
 * @property-read int|null $trading_sessions_count
 * @method static \Database\Factories\OfferFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Offer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereDurationInSeconds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereMaxInterest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereMaxInvestment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereMinInterest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereMinInvestment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer withoutTrashed()
 */
	class Offer extends \Eloquent implements \App\Contracts\Presentable {}
}

namespace App\Models{
/**
 * App\Models\OfferAttribute
 *
 * @property int $id
 * @property int $offer_id
 * @property string $code
 * @property string $type
 * @property string $value
 * @property-read \App\Models\Offer $offer
 * @method static \Database\Factories\OfferAttributeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|OfferAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferAttribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferAttribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferAttribute whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferAttribute whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferAttribute whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferAttribute whereValue($value)
 */
	class OfferAttribute extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Option
 *
 * @property int $id
 * @property string $code
 * @property string $type
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Option newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Option newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Option query()
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereValue($value)
 */
	class Option extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Referral
 *
 * @property int $id
 * @property int $referral_rule_id
 * @property int $referrer_id
 * @property int $referral_id
 * @property \App\Enums\ReferralStatus $status
 * @property int $level
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $referral
 * @property-read \App\Models\ReferralRule $referralRule
 * @property-read \App\Models\User $referrer
 * @method static \Database\Factories\ReferralFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Referral newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Referral newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Referral query()
 * @method static \Illuminate\Database\Eloquent\Builder|Referral whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Referral whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Referral whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Referral whereReferralId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Referral whereReferralRuleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Referral whereReferrerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Referral whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Referral whereUpdatedAt($value)
 */
	class Referral extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ReferralRule
 *
 * @property int $id
 * @property string $name
 * @property \App\Enums\ReferralRuleType $type
 * @property string $interest
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Referral> $referrals
 * @property-read int|null $referrals_count
 * @method static \Database\Factories\ReferralRuleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralRule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralRule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralRule query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralRule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralRule whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralRule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralRule whereInterest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralRule whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralRule whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralRule whereUpdatedAt($value)
 */
	class ReferralRule extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TradingSession
 *
 * @property int $id
 * @property int $user_id
 * @property int $offer_id
 * @property \App\Enums\TradingSessionStatus $status
 * @property string|null $investment
 * @property string|null $interest
 * @property \Illuminate\Support\Carbon|null $start_at
 * @property \Illuminate\Support\Carbon|null $end_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Offer $offer
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\TradingSessionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|TradingSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TradingSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TradingSession query()
 * @method static \Illuminate\Database\Eloquent\Builder|TradingSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TradingSession whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TradingSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TradingSession whereInterest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TradingSession whereInvestment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TradingSession whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TradingSession whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TradingSession whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TradingSession whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TradingSession whereUserId($value)
 */
	class TradingSession extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property int $user_id
 * @property \App\Enums\TransactionType $type
 * @property \App\Enums\TransactionStatus $status
 * @property string $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction defaultSort(string $column, string $direction = 'asc')
 * @method static \Database\Factories\TransactionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction filters(?mixed $kit = null, ?\Orchid\Filters\HttpFilter $httpFilter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction filtersApply(iterable $filters = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction filtersApplySelection($class)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUserId($value)
 */
	class Transaction extends \Eloquent implements \App\Contracts\Presentable {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property string $balance
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array|null $permissions
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserAttribute> $attributes
 * @property-read int|null $attributes_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Orchid\Platform\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TradingSession> $tradingSessions
 * @property-read int|null $trading_sessions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Transaction> $transactions
 * @property-read int|null $transactions_count
 * @method static \Illuminate\Database\Eloquent\Builder|User averageByDays(string $value, $startDate = null, $stopDate = null, ?string $dateColumn = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User byAccess(string $permitWithoutWildcard)
 * @method static \Illuminate\Database\Eloquent\Builder|User byAnyAccess($permitsWithoutWildcard)
 * @method static \Illuminate\Database\Eloquent\Builder|User countByDays($startDate = null, $stopDate = null, ?string $dateColumn = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User countForGroup(string $groupColumn)
 * @method static \Illuminate\Database\Eloquent\Builder|User defaultSort(string $column, string $direction = 'asc')
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User filters(?mixed $kit = null, ?\Orchid\Filters\HttpFilter $httpFilter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User filtersApply(iterable $filters = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User filtersApplySelection($class)
 * @method static \Illuminate\Database\Eloquent\Builder|User maxByDays(string $value, $startDate = null, $stopDate = null, ?string $dateColumn = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User minByDays(string $value, $startDate = null, $stopDate = null, ?string $dateColumn = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User sumByDays(string $value, $startDate = null, $stopDate = null, ?string $dateColumn = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User valuesByDays(string $value, $startDate = null, $stopDate = null, string $dateColumn = 'created_at')
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePermissions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \App\Contracts\Presentable {}
}

namespace App\Models{
/**
 * App\Models\UserAttribute
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property string $type
 * @property string $value
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\UserAttributeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|UserAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAttribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAttribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAttribute whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAttribute whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAttribute whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAttribute whereValue($value)
 */
	class UserAttribute extends \Eloquent {}
}

