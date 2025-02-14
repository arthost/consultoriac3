<?php

namespace App\Filament\Pages\Forms;

use App\Actions\SaveSimulation;
use App\Enums\FormTypeEnum;
use App\Filament\Resources\SimulationResource;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Illuminate\Contracts\Support\Htmlable;
use Webbingbrasil\FilamentCopyActions\Pages\Actions\CopyAction;

class CreditPropertyGuaranteeForm extends Page
{
    use BaseCreditPropertyGuaranteeForm;
    use InteractsWithFormActions;

    protected static string $resource = SimulationResource::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.simulation-form-admin';

    public function generateResults(): void
    {
        $this->calculoResults = [];
        $inputs = $this->form->getState();
        $data = $this->getData();
        $data['created_by'] = Filament::auth()->id();
        SaveSimulation::run($data);
        Notification::make()
            ->title('Simulação concluída com sucesso!')
            ->success()
            ->send();

        $this->calculoResults = $this->calculateValues($inputs);
    }

    public function getFormActions(): array
    {
        return $this->formActions();
    }

    public function hasLogo(): bool
    {
        return true;
    }

    public function getBreadcrumbs(): array
    {
        /** @var Resource $resource */
        $resource = static::getResource();

        return [
            $resource::getUrl() => $resource::getBreadcrumb(),
            0 => 'Nova Simulação',
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return FormTypeEnum::CREDIT_PROPERTY_GUARANTEE->getLabel();
    }

    public function getFormType(): FormTypeEnum
    {
        return FormTypeEnum::CREDIT_PROPERTY_GUARANTEE;
    }

    protected function getHeaderActions(): array
    {
        $route = route('partner.simulations.credit-property-guarantee', [
            'partner_code' => Filament::auth()->user()->partner_code,
        ]);

        return [
            Action::make('public-link')
                ->label('Formulário Publico')
                ->url($route, true)
                ->icon('heroicon-c-link'),
            CopyAction::make('public-copyable')
                ->copyable($route)
                ->label('Copiar Link')
                ->successNotificationTitle('Link copiado com sucesso!')
                ->link()
        ];
    }
}
