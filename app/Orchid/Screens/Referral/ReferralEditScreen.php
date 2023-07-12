<?php

namespace App\Orchid\Screens\Referral;

use App\Actions\SaveReferral;
use App\Enums\ReferralStatus;
use App\Http\Requests\Referral\SaveReferralRequest;
use App\Models\Referral;
use App\Models\ReferralRule;
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

class ReferralEditScreen extends AbstractReferralScreen
{
    /**
     * A reference to an instance of the Referral model, or null
     *
     * @var \App\Models\Referral|null
     */
    public ?Referral $referral = null;

    /**
     * @param  \App\Models\Referral  $referral
     * @return iterable
     */
    public function query(Referral $referral): iterable
    {
        $referral->load('referralRule', 'referrer', 'referral');

        return [
            'referral' => $referral
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->referral->exist ? 'Edit Referral' : 'Create Referral';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     * @uses \App\Orchid\Screens\Referral\AbstractReferralScreen::deleteReferral()
     * @uses \App\Orchid\Screens\Referral\ReferralEditScreen::saveReferral()
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->method('saveReferral'),

            Button::make(__('Delete'))
                ->icon('bs.trash')
                ->method('deleteReferral')
                ->canSee($this->referral->exists),
        ];
    }

    /**
     * @return iterable
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([

                Relation::make('referral.referral_rule_id')
                    ->fromModel(ReferralRule::class, 'name')
                    ->title('Referral Rule')
                    ->required(),

                Relation::make('referral.referrer_id')
                    ->fromModel(User::class, 'name')
                    ->title('Referrer')
                    ->required(),

                Relation::make('referral.referral_id')
                    ->fromModel(User::class, 'name')
                    ->title('Referral')
                    ->required(),

                DateTimer::make('referral.created_at')
                    ->title(__('Date of creation'))
                    ->allowInput()
                    ->format24hr()
                    ->enableTime()
                    ->required()
                    ->value(
                        $this->referral->exists
                            ? $this->referral->created_at->toDateTimeString()
                            : now()->toDateTimeString()
                    ),
        ])];
    }

    /**
     * Handle request for saving transaction.
     *
     * @param  \App\Models\Referral  $referral
     * @param  \App\Http\Requests\Referral\SaveReferralRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveReferral(Referral $referral, SaveReferralRequest $request): RedirectResponse
    {
        $referral->fill($request->validated('referral'));

        try {
            (new SaveReferral($referral))->execute();

            Toast::success($referral->wasRecentlyCreated ? __('Referral was created.') : __('Referral was updated.'));
        } catch (Exception $exception) {
            Toast::error($exception->getMessage());
        }

        return redirect()->route('platform.systems.referrals');
    }
}
