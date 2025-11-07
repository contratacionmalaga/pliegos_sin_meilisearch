<?php

namespace App\Providers\Filament;

use App\Enums\NavigationMenus\MiNavigationGroup;
use App\Enums\NavigationMenus\MiPanel;
use App\Filament\Pages\Auth\MiLogin;
use App\Filament\Pages\MiDashboard;
use App\Filament\Resources\Incidencias\IncidenciaResource;
use App\Filament\Resources\PLACSP\Adjudicaciones\AdjudicacionResource;
use App\Filament\Resources\PLACSP\Anuncios\AnuncioResource;
use App\Filament\Resources\PLACSP\CondicionesEspecialesAdjudicacion\CondicionEspecialEjecucionResource;
use App\Filament\Resources\PLACSP\ContratosMayores\ContratoMayorResource;
use App\Filament\Resources\PLACSP\Cpvs\CpvResource;
use App\Filament\Resources\PLACSP\CriteriosAdjudicacion\CriterioAdjudicacionResource;
use App\Filament\Resources\PLACSP\Documentos\DocumentoResource;
use App\Filament\Resources\PLACSP\Lotes\LoteResource;
use App\Filament\Resources\PLACSP\Modificaciones\ModificacionResource;
use App\Filament\Resources\PLACSP\RequisitosPreviosParticipacion\RequisitoPrevioParticipacionResource;
use App\Filament\Resources\RespuestasIncidencia\RespuestasIncidenciaResource;
use App\Filament\Widgets\EstadisticaCountAdjudicacionesPorEstadoChart;
use App\Filament\Widgets\EstadisticaCountAdjudicacionesPorTipoContratoChart;
use App\Filament\Widgets\EstadisticaCountAdjudicacionesPorTipoOrgContratacionChart;
use App\Filament\Widgets\EstadisticaCountAdjudicacionesPorTipoProcedimientoChart;
use App\Filament\Widgets\EstadisticaCountCondicionesEspecialesPorTipoContratoChart;
use App\Filament\Widgets\EstadisticaCountCriteriosAdjudicacionPorTipoContratoChart;
use App\Filament\Widgets\EstadisticaCountExpedientesPorEstadoChart;
use App\Filament\Widgets\EstadisticaCountExpedientesPorTipoProcedimientoChart2;
use App\Filament\Widgets\EstadisticaCountExpedientesPorTipoContratoChart;
use App\Filament\Widgets\EstadisticaCountExpedientesPorTipoOrgContratacionChart;
use App\Filament\Widgets\EstadisticaCountExpedientesPorTipoProcedimientoChart;
use App\Filament\Widgets\EstadisticaCountRequisitosPreviosPorTipoContratoChart;
use App\Filament\Widgets\EstadisticasPliegosExpedientesWidget;
use App\Filament\Widgets\EstadisticasPliegosRestoWidget;
use App\Filament\Widgets\EstadisticasPliegosAdjudicacionesWidget;
use App\Filament\Widgets\EstadisticaSumAdjudicacionesPorEstadoChart;
use App\Filament\Widgets\EstadisticaSumAdjudicacionesPorTipoContratoChart;
use App\Filament\Widgets\EstadisticaSumAdjudicacionesPorTipoOrgContratacionChart;
use App\Filament\Widgets\EstadisticaSumAdjudicacionesPorTipoProcedimientoChart;
use App\Filament\Widgets\EstadisticaSumExpedientesPorEstadoChart;
use App\Filament\Widgets\EstadisticaSumExpedientesPorTipoContratoChart;
use App\Filament\Widgets\EstadisticaSumExpedientesPorTipoOrgContratacionChart;
use App\Filament\Widgets\EstadisticaSumExpedientesPorTipoProcedimientoChart;
use App\Models\PLACSP\ContratoMayor;
use Devonab\FilamentEasyFooter\EasyFooterPlugin;
use Exception;
use Filament\Auth\MultiFactor\App\AppAuthentication;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Enums\SubNavigationPosition;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Enums\Width;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    /**
     * @throws Exception
     */
    public function panel(Panel $panel): Panel
    {

        $brandName = config('app.name', 'Contratación 360');

        return $panel
            ->default()
//            ->sidebarCollapsibleOnDesktop()
//            ->sidebarWidth('150px')
//            ->multiFactorAuthentication([
//                AppAuthentication::make()
//                    ->recoverable()
//                    ->recoveryCodeCount(10)
//                    ->regenerableRecoveryCodes(false)
//                    ->codeWindow(4)
//                    ->brandName($brandName ),
//            ], isRequired: auth()->check() && auth()->user()?->esObligatorio2FA())
            ->subNavigationPosition(SubNavigationPosition::Top)
            ->topNavigation()
//            ->login(MiLogin::class)
            ->id(MiPanel::ADMIN->getId())
            ->path(MiPanel::ADMIN->getPath())
            ->maxContentWidth(Width::Full)
            ->globalSearch(false)
            ->colors(['primary' => MiPanel::ADMIN->getColor()])
            ->brandLogo('/img/logo.png')
            ->brandLogoHeight('3rem')
            ->favicon('/img/favicon.ico')
            ->pages([MiDashboard::class])
            ->widgets([
                EstadisticasPliegosExpedientesWidget::class,
                EstadisticasPliegosRestoWidget::class,
                EstadisticasPliegosAdjudicacionesWidget::class,
                EstadisticaCountExpedientesPorEstadoChart::class,
//                EstadisticaCountExpedientesPorTipoProcedimientoChart2::class,
                EstadisticaCountExpedientesPorTipoContratoChart::class,
                EstadisticaCountExpedientesPorTipoProcedimientoChart::class,
                EstadisticaCountExpedientesPorTipoOrgContratacionChart::class,
                EstadisticaSumExpedientesPorEstadoChart::class,
                EstadisticaSumExpedientesPorTipoContratoChart::class,
                EstadisticaSumExpedientesPorTipoProcedimientoChart::class,
                EstadisticaSumExpedientesPorTipoOrgContratacionChart::class,
                EstadisticaCountAdjudicacionesPorEstadoChart::class,
                EstadisticaCountAdjudicacionesPorTipoContratoChart::class,
                EstadisticaCountAdjudicacionesPorTipoProcedimientoChart::class,
                EstadisticaCountAdjudicacionesPorTipoOrgContratacionChart::class,
                EstadisticaSumAdjudicacionesPorEstadoChart::class,
                EstadisticaSumAdjudicacionesPorTipoContratoChart::class,
                EstadisticaSumAdjudicacionesPorTipoProcedimientoChart::class,
                EstadisticaSumAdjudicacionesPorTipoOrgContratacionChart::class,
                EstadisticaCountCondicionesEspecialesPorTipoContratoChart::class,
                EstadisticaCountCriteriosAdjudicacionPorTipoContratoChart::class,
                EstadisticaCountRequisitosPreviosPorTipoContratoChart::class,
            ])
            ->resources([
                AdjudicacionResource::class,
                AnuncioResource::class,
                CondicionEspecialEjecucionResource::class,
                CpvResource::class,
                CriterioAdjudicacionResource::class,
                DocumentoResource::class,
                ContratoMayorResource::class,
                IncidenciaResource::class,
                RespuestasIncidenciaResource::class,
                LoteResource::class,
                ModificacionResource::class,
                RequisitoPrevioParticipacionResource::class,
            ])
//            ->userMenuItems(MiMenuItem::getMenuItems(MiPanel::ADMIN))
            ->navigationGroups(MiNavigationGroup::getNavigationGroups())
            ->databaseNotifications()
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
//            ->authMiddleware([
//                Authenticate::class])
            ->plugins([
                EasyFooterPlugin::make()
                    ->withLoadTime('|Tiempo de carga: ')
            ]);
    }
}
