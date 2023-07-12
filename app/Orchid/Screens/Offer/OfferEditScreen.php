<?php

namespace App\Orchid\Screens\Offer;


use App\Actions\SaveOffer;
use App\Http\Requests\Offer\SaveOfferRequest;
use App\Models\Offer;
use Exception;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class OfferEditScreen extends AbstractOfferScreen
{
    /**
     * The offer to be edited.
     *
     * @var Offer|null
     */
    public ?Offer $offer = null;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Offer $offer): iterable
    {
        return [
            'offer' => $offer,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Offer Edit';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Edit an investment offer';
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     * @uses \App\Orchid\Screens\Offer\OfferEditScreen::saveOffer()
     * @uses \App\Orchid\Screens\Offer\AbstractOfferScreen::deleteOffer()
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->method('saveOffer'),

            Button::make(__('Delete'))
                ->icon('bs.trash3')
                ->confirm('Want to delete this Offer?')
                ->method('deleteOffer')
                ->canSee($this->offer->exists),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [

            Layout::rows([

                Input::make('offer.name')
                    ->title(__('Name'))
                    ->required()
                    ->minlength(3)
                    ->maxlength(80),

                Group::make([

                    Input::make('offer.min_investment')
                        ->type('number')
                        ->title(__('Minimum Investments'))
                        ->required()
                        ->min(1)
                        ->step(0.01),

                    Input::make('offer.max_investment')
                        ->type('number')
                        ->title(__('Maximum Investments'))
                        ->help(__('Leave blank for fixed investment.'))
                        ->step(0.01),

                ]),

                Group::make([

                    Input::make('offer.min_interest')
                        ->type('number')
                        ->title(__('Minimum Interest'))
                        ->required()
                        ->min(1)
                        ->step(0.01),

                    Input::make('offer.max_interest')
                        ->type('number')
                        ->title(__('Maximum Interest'))
                        ->help(__('Leave blank for fixed interest.'))
                        ->step(0.01),

                ]),

                Input::make('offer.duration_in_hours')
                    ->type('number')
                    ->title(__('Duration (Hours)'))
                    ->required()
                    ->min(1)
                    ->step(1)
                    ->value($this->offer->exists ? $this->offer->duration_in_seconds / 3600 : 24),

                Input::make('offer.position')
                    ->type('number')
                    ->title(__('Position'))
                    ->min(0)
                    ->max(10000)
                    ->step(1)
                    ->value($this->offer->exists ? $this->offer->position : 10),
            ]),
        ];
    }

    /**
     * Save offer
     *
     * @param  Offer  $offer
     * @param  SaveOfferRequest  $request
     * @return RedirectResponse
     */
    public function saveOffer(Offer $offer, SaveOfferRequest $request): RedirectResponse
    {
        $offer->fill($request->validated('offer'));

        try {
            (new SaveOffer($offer))->execute();
        } catch (Exception $exception) {
            Toast::error($exception->getMessage());
        }

        Toast::success(__($this->offer->exists ? 'Offer was updated.' : 'Offer was created.'));

        return redirect()->route('platform.systems.offers');
    }
}
