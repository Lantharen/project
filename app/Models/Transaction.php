<?php

namespace App\Models;

use App\Concerns\HasPresenter;
use App\Contracts\Presentable;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Orchid\Filters\RelationalUserNameFilter;
use App\Orchid\Filters\TransactionTypeFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Transaction extends Model implements Presentable
{
    use AsSource;
    use Filterable;
    use HasFactory;
    use HasPresenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'type',
        'status',
        'amount',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'status' => TransactionStatus::class,
        'type' => TransactionType::class,
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        // Direct filters
        'type' => TransactionTypeFilter::class,

        // Relational filters
        'name' => RelationalUserNameFilter::class,
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var string[]
     */
    protected $allowedSorts = [
        'created_at'
    ];

    /**
     * Construct default value for Transaction status
     *
     * @param  array  $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setAttribute('status', TransactionStatus::Approved);
    }
    
    /**
     * Get the user that owns transaction.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
