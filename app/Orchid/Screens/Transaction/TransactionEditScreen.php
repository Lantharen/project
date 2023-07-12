<?php

namespace App\Orchid\Screens\Transaction;

use App\Actions\SaveTransaction;
use App\Enums\TransactionType;
use App\Http\Requests\Transaction\SaveTransactionRequest;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class TransactionEditScreen extends AbstractTransactionScreen
{
    /**
     * A reference to an instance of the Transaction model, or null
     *
     * @var \App\Models\Transaction|null
     */
    public ?Transaction $transaction = null;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Transaction $transaction): iterable
    {
        $transaction->load('user');

        return [
            'transaction' => $transaction,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->transaction->exists ? 'Edit Transaction' : 'Create Transaction';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     * @uses \App\Orchid\Screens\Transaction\AbstractTransactionScreen::deleteTransaction()
     * @uses \App\Orchid\Screens\Transaction\TransactionEditScreen::saveTransaction()
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->method('saveTransaction'),

            Button::make(__('Delete'))
                ->icon('bs.trash3')
                ->confirm('Want to delete this Transaction?')
                ->method('deleteTransaction')
                ->canSee($this->transaction->exists),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function layout(): iterable
    {
        return [

            Layout::rows([

                Relation::make('transaction.user')
                    ->fromModel(User::class, 'name')
                    ->title(__('User'))
                    ->required(),

                Select::make('transaction.type.value')
                    ->title(__('Transaction Type'))
                    ->options(TransactionType::forDropdown())
                    ->required()
                    ->value($this->transaction->exists ? $this->transaction->type->value : null),

                Input::make('transaction.amount')
                    ->type('number')
                    ->title(__('Amount'))
                    ->autocomplete(false)
                    ->min(1)
                    ->step(0.1)
                    ->required(),

                DateTimer::make('transaction.created_at')
                    ->title(__('Date of creation'))
                    ->allowInput()
                    ->format24hr()
                    ->enableTime()
                    ->required(),

            ]),
        ];
    }

    /**
     * Handle request for saving transaction.
     *
     * @param  \App\Models\Transaction  $transaction
     * @param  \App\Http\Requests\Transaction\SaveTransactionRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveTransaction(Transaction $transaction, SaveTransactionRequest $request): RedirectResponse
    {
        $transaction->fill($request->validated('transaction'));

        try {
            (new SaveTransaction($transaction))->execute();

            Toast::success($transaction->exists ? __('Transaction was updated.') : __('Transaction was created.'));
        } catch (Exception $exception) {
            Toast::error($exception->getMessage());
        }

        return redirect()->route('platform.systems.transactions');
    }
}
