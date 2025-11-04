<?php

namespace App\Enums\Acciones;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use phpDocumentor\Reflection\Types\Self_;
use function Laravel\Prompts\select;
use function Symfony\Component\String\s;

enum MiAccionEnum: string implements HasColor, HasDescription, HasIcon, HasLabel
{
    case VolverAlListado = 'VolverAlListado';
    case View = 'view';
    case Associate = 'associate';
    case Dissociate = 'dissociate';
    case Edit = 'edit';
    case Deleted = 'deleted';
    case Create = 'created';
    case Restore = 'restore';
    case ForceDelete = 'force-delete';
    case BulkActionDelete = 'bulka-delete';
    case BulkActionRestore = 'bulk-restore';
    case BulkActionForceDelete = 'bulk-force-delete';
    case DissociateBulkAction = 'dissociate-bulk';
    case Enable = 'enable';
    case Disable = 'disable';
    case Enable2fa = 'enable-2fa';
    case Disable2fa = 'disable-2fa';
    case AsignarLectura = 'asignar-lectura';
    case RetirarLectura = 'retirar-lectura';
    case AsignarSuperAdmin = 'asignar-super-admin';
    case RetirarSuperAdmin = 'retirar-super-admin';
    case SendEmailResetPassword = 'send-email-reset-password';
    case AbrirEnlacePlacsp = 'abrir-enlace-placsp';
    case AbrirEnlaceInvente = 'abrir-enlace-invente';
    case AbrirEnlaceDocumento = 'abrir-enlace-documento';
    case ExportarExcel = 'exportar-excel';
    case VerExpediente = 'ver-expediente';

//    public function getRolByAccion(): Roles
//    {
//        return match ($this) {
//            self::VolverAlListado,
//            self::View,
//            self::VerExpediente,
//            self::AbrirEnlacePlacsp,
//            self::AbrirEnlaceInvente,
//            self::AbrirEnlaceDocumento,
//
//            self::Associate,
//            self::Dissociate,
//            self::Edit,
//            self::Deleted,
//            self::Create,
//            self::BulkActionDelete,
//            self::Enable,
//            self::Disable => Roles::ESCRIBIR,
//
//            self::DissociateBulkAction,
//            self::AsignarSuperAdmin,
//            self::RetirarSuperAdmin,
//            self::SendEmailResetPassword,
//            self::BulkActionRestore,
//            self::BulkActionForceDelete,
//            self::Restore,
//            self::ForceDelete,
//            self::AsignarLectura,
//            self::RetirarLectura,
//            self::Enable2fa,
//            self::Disable2fa => Roles::ADMINISTRAR,
//        };
//    }

    public function getLabel(): string
    {
        return match ($this) {
            self::VolverAlListado => 'Volver al Listado',
            self::View => 'Ver',
            self::VerExpediente => 'Ver Expediente',
            self::Associate => 'Asociar',
            self::Dissociate => 'Desasociar',
            self::Edit => 'Editar',
            self::Deleted => 'Borrar',
            self::Create => 'Crear',
            self::Restore => 'Restaurar',
            self::ForceDelete => 'Forzar borrado',
            self::BulkActionDelete => 'Borrado en masa',
            self::BulkActionRestore => 'Restauración en masa',
            self::BulkActionForceDelete => 'Forzar borrado en masa',
            self::DissociateBulkAction => 'Forzar desasociado en masa',
            self::Enable => 'Activar',
            self::Disable => 'Desactivar',
            self::Enable2fa => 'Activar doble factor',
            self::Disable2fa => 'Desactivar doble factor',
            self::AsignarLectura => 'Permiso de Lectura',
            self::RetirarLectura => 'Permiso de Escritura',
            self::AsignarSuperAdmin => 'Asignar super admin',
            self::RetirarSuperAdmin => 'Retirar super admin',
            self::SendEmailResetPassword => 'Enviar email password',
            self::AbrirEnlacePlacsp => 'Abrir enlace Placsp',
            self::AbrirEnlaceInvente => 'Abrir enalce INVENTE',
            self::AbrirEnlaceDocumento => 'Abrir enlace documento',
            self::ExportarExcel => 'Exportar a Excel',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::VolverAlListado => 'heroicon-o-arrow-left',
            self::VerExpediente => 'heroicon-o-document-magnifying-glass',
            self::View => 'heroicon-o-eye',
            self::Associate => 'heroicon-o-document-plus',
            self::Dissociate => 'heroicon-o-document-minus',
            self::Edit => 'heroicon-o-pencil-square',
            self::Deleted, self::BulkActionDelete => 'heroicon-o-trash',
            self::Create => 'heroicon-o-plus',
            self::Restore, self::BulkActionRestore => 'heroicon-o-arrow-uturn-left',
            self::ForceDelete, self::BulkActionForceDelete => 'heroicon-m-archive-box-x-mark',
            self::Enable => 'heroicon-o-check-circle',
            self::Enable2fa => 'heroicon-o-device-phone-mobile',
            self::Disable2fa,
            self::Disable,
            self::AsignarLectura => 'heroicon-o-no-symbol',
            self::RetirarLectura => 'heroicon-o-pencil',
            self::AsignarSuperAdmin => 'heroicon-o-user-plus',
            self::RetirarSuperAdmin => 'heroicon-o-user-minus',
            self::SendEmailResetPassword => 'heroicon-o-envelope',
//            self::DissociateBulkAction => 'heroicon-o-no-symbol',
            self::AbrirEnlacePlacsp => 'heroicon-o-link',
            self::AbrirEnlaceInvente => 'heroicon-o-arrow-top-right-on-square',
            self::AbrirEnlaceDocumento => 'heroicon-o-document-arrow-up',
            self::ExportarExcel => 'heroicon-o-cloud-arrow-down',
        };
    }

    /**
     * @return array<int,string>
     */
    public function getColor(): array
    {
        return match ($this) {

            self::VolverAlListado => Color::Slate,
            self::VerExpediente,
            self::View => Color::Amber,
            self::Associate => Color::Fuchsia,
            self::Edit => Color::Indigo,

            self::Create => Color::Emerald,
            self::Enable, self::Disable => Color::Sky,
            self::AsignarSuperAdmin => Color::Pink,
            self::Restore, self::BulkActionRestore => Color::Green,
            self::SendEmailResetPassword => Color::Teal,
            self::AbrirEnlacePlacsp, self::AbrirEnlaceInvente, self::AbrirEnlaceDocumento => Color::Blue,
            self::AsignarLectura => Color::Violet,
            self::Enable2fa => Color::Orange,
            self::ExportarExcel => Color::Sky,

            self::Deleted,
            self::BulkActionDelete,
            self::ForceDelete,
            self::BulkActionForceDelete,
            self::Dissociate,
            self::DissociateBulkAction,
            self::RetirarSuperAdmin,
            self::Disable2fa,
            self::RetirarLectura => Color::Red,

        };
    }

    public function getTooltip(): string
    {
        return match ($this) {
            self::VolverAlListado => 'Volver al Listado',
            self::VerExpediente => 'Ver el expediente asociado',
            self::View => 'Ver detalle del registro actual',
            self::Associate => 'Asociar al registro actual',
            self::Dissociate => 'Desasociar del registro actual',
            self::Edit => 'Editar registro actual',
            self::Deleted => 'Borrar registro actual',
            self::Create => 'Crear nuevo registro',
            self::Restore => 'Restaurar registro actual',
            self::ForceDelete => 'Forzar borrado del registro actual',
            self::BulkActionDelete => 'Borrado en masa de los registros seleccionados',
            self::BulkActionRestore => 'Restauración en masa de los registros seleccionados',
            self::BulkActionForceDelete => 'Forzar borrado en masa de los registros seleccionados',
            self::DissociateBulkAction => 'Forzar el desasociado en masa de los regsitros seleccionados',
            self::Enable => 'Activar registro actual',
            self::Disable => 'Desactivar registro actual',
            self::Enable2fa => 'Activar la obligación de que el usuario utilice el doble factor durante el inicio de sesión',
            self::Disable2fa => 'Desactivar la obligación de que el usuario utilice el doble factor durante el inicio de sesión',
            self::AsignarSuperAdmin => 'Asignar el rol Super admin al registro actual',
            self::RetirarSuperAdmin => 'Retirar el rol Super admin al registro actual',
            self::SendEmailResetPassword => 'Enviar email para cambio de contraseña',
            self::AbrirEnlacePlacsp => 'Abrir enlace al perfil de contratante en PLACSP',
            self::AbrirEnlaceInvente => 'Abrir enlace al perfil en INVENTE',
            self::AbrirEnlaceDocumento => 'Abrir enlace al Documento',
            self::AsignarLectura => 'Asignar permiso de lectura',
            self::RetirarLectura => 'Asignar permiso de escritura',
            self::ExportarExcel => 'Exportar Excel',
        };
    }

    public function getDescription(): string
    {
        return match ($this) {
            self::Deleted => '¿Desea borrar el registro?',
            self::Restore => '¿Desea restaurar el registro?',
            self::ForceDelete => '¿Desea forzar el borrado del registro?',
            self::BulkActionDelete => '¿Desea borrar los registros seleccionados?',
            self::BulkActionRestore => '¿Desea restaurar los registros seleccionados?',
            self::BulkActionForceDelete => '¿Desea forzar el borrado de los registros seleccionados?',
            self::Enable => '¿Desea activar el registro actual?',
            self::Disable => '¿Desea desactivar el registro actual?',
            self::AsignarSuperAdmin => '¿Desea asignar el rol Super Admin al usuario?',
            self::RetirarSuperAdmin => '¿Desea retirar el rol Super Admin al usuario?',
            self::SendEmailResetPassword => '¿Desea enviar un email para resetear la contraseña al usuario actual?',

            default => 'getDescription() - no implementado',
        };
    }
}


