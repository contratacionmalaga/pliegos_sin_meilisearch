<?php

namespace App\Enums\ActivityLog;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ActivityLogEvent: string implements HasColor, HasIcon, HasLabel
{

    /*
     * Evento de ActivityLog
     */
    case UPDATED = 'updated';
    case CREATED = 'created';
    case DELETED = 'deleted';
    case VIEWED = 'viewed';

    /*
     * ORDEN CRONOLÓGICO DE LOS EVENTOS:
     *
        Registro:
         -> Registered -> Verified
        Login:
          -> Attempting -> Validated -> Authenticated -> (Login | Failed | Lockout)
        Logout:
          -> Logout | CurrentDeviceLogout | OtherDeviceLogout
        Password Reset:
          -> PasswordResetLinkSent -> PasswordReset
     */

    // Eventos de Registro
    case REGISTERED = 'registered';
    case VERIFIED = 'verified';

    // Eventos de Login
    case ATTEMPTING = 'attempting';
    case VALIDATED = 'validated';
    case AUTHENTICATED = 'authenticated';
    case LOGIN = 'login';
    case FAILED_LOGIN_USER = 'failed_login_user';
    case FAILED_LOGIN_PASSWORD = 'failed_login_password';
    case FAILED_LOGIN_USER_NOT_ENABLED = 'failed_login_user_not_enabled';
    case FAILED_LOGIN_USER_EMAIL_NOT_VERIFIED = 'failed_login_user_email_not_verified';
    case LOCKOUT = 'lockout';

    // Eventos de Logout
    case LOGOUT = 'logout';
    case CURRENT_DEVICE_LOGOUT = 'current_device_logout';
    case OTHER_DEVICE_LOGOUT = 'other_device_logout';

    // Eventos de Password Reset
    case PASSWORD_RESET = 'password_reset';
    case PASSWORD_RESET_LINK_SENT = 'password_reset_submit_link';

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return match ($this) {

            self::UPDATED => 'Actualización de un registro',
            self::CREATED => 'Creación de un registro',
            self::DELETED => 'Borrado de un registro',
            self::VIEWED => 'Visionado de un registro',

            self::REGISTERED => 'Autoregistro de usuario',
            self::VERIFIED => 'Verificación de la dirección de email',

            self::ATTEMPTING => 'Intento de autenticación (justo al iniciar el proceso)',
            self::VALIDATED => 'Verificación de credenciales (después de introducir usuario y clave)',
            self::AUTHENTICATED => 'Usuario autenticado correctamente',
            self::LOGIN => 'Login al sistema',
            self::FAILED_LOGIN_USER => 'El usuario introducido es incorrecto',
            self::FAILED_LOGIN_PASSWORD => 'La clave introducida es incorrecta',
            self::FAILED_LOGIN_USER_NOT_ENABLED => 'El usuario no se encuentra activo',
            self::FAILED_LOGIN_USER_EMAIL_NOT_VERIFIED => 'La dirección de email no ha sido verificada',
            self::LOCKOUT => 'Exceso de intentos de login, el usuario ha sido bloqueado',

            self::LOGOUT => 'Logout del sistema',
            self::CURRENT_DEVICE_LOGOUT => 'Cierre de sesión es el dispositivo actual',
            self::OTHER_DEVICE_LOGOUT => 'Cierre de sesión es otro dispositivo',

            self::PASSWORD_RESET => 'Solicitud de reseteo de contraseña',
            self::PASSWORD_RESET_LINK_SENT => 'Envío de enlace para reseteo de contraseña',

        };
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return match ($this) {

            self::UPDATED => 'Actualización de un registro',
            self::CREATED => 'Creación de un registro',
            self::DELETED => 'Borrado de un registro',
            self::VIEWED => 'Visionado de un registro',

            self::REGISTERED => 'Autoregistro del ususario',
            self::VERIFIED => 'Verificación de la dirección de email',

            self::ATTEMPTING => 'Intento de autenticación',
            self::VALIDATED => 'Validación de credenciales',
            self::AUTHENTICATED => 'Usuario autenticado correctamente',
            self::LOGIN => 'Login correcto',
            self::FAILED_LOGIN_USER => 'Login incorrecto - Usuario incorercto',
            self::FAILED_LOGIN_PASSWORD => 'Login incorrecto - Password incorrecta',
            self::FAILED_LOGIN_USER_NOT_ENABLED => 'Login incorrecto - Usuario inactivo',
            self::FAILED_LOGIN_USER_EMAIL_NOT_VERIFIED => 'Login incorrecto - Usuario no verificado',
            self::LOCKOUT => 'Login incorrecto - Exceso de intentos',

            self::LOGOUT => 'Logout correcto',
            self::CURRENT_DEVICE_LOGOUT => 'Cierre de sesión dispositivo actual',
            self::OTHER_DEVICE_LOGOUT => 'Cierre de sesión es otro dispositivo ',

            self::PASSWORD_RESET => 'Solicitud de cambio password',
            self::PASSWORD_RESET_LINK_SENT => 'Envío de enlace de cambio password',

        };
    }

    /**
     * @return array<int,string>
     */
    public function getColor(): array
    {
        return match ($this) {

            self::UPDATED => Color::Indigo,
            self::CREATED => Color::Teal,
            self::DELETED => Color::Fuchsia,
            self::VIEWED => Color::Lime,

            self::REGISTERED,
            self::VERIFIED => Color::Yellow,

            self::ATTEMPTING,
            self::VALIDATED ,
            self::AUTHENTICATED,
            self::LOGIN => Color::Green,
            self::FAILED_LOGIN_USER,
            self::FAILED_LOGIN_PASSWORD,
            self::FAILED_LOGIN_USER_NOT_ENABLED,
            self::FAILED_LOGIN_USER_EMAIL_NOT_VERIFIED,
            self::LOCKOUT=> Color::Red,

            self::LOGOUT,
            self::CURRENT_DEVICE_LOGOUT,
            self::OTHER_DEVICE_LOGOUT => Color::Amber,

            self::PASSWORD_RESET,
            self::PASSWORD_RESET_LINK_SENT => Color::Emerald,

        };
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {

        return match ($this) {

            self::UPDATED => 'heroicon-o-pencil-square',
            self::CREATED => 'heroicon-o-plus',
            self::DELETED => 'heroicon-o-minus',
            self::VIEWED => 'heroicon-o-eye',

            self::REGISTERED => 'heroicon-o-pencil',
            self::VERIFIED => 'heroicon-o-check',

            self::ATTEMPTING => 'heroicon-o-arrow-right-end-on-rectangle',
            self::VALIDATED => 'heroicon-o-arrow-right-on-rectangle',
            self::AUTHENTICATED => 'heroicon-o-shield-check',
            self::LOGIN => 'heroicon-o-lock-open',
            self::FAILED_LOGIN_USER,
            self::FAILED_LOGIN_PASSWORD,
            self::FAILED_LOGIN_USER_NOT_ENABLED,
            self::FAILED_LOGIN_USER_EMAIL_NOT_VERIFIED,
            self::LOCKOUT=> 'heroicon-o-lock-closed',

            self::LOGOUT,
            self::CURRENT_DEVICE_LOGOUT,
            self::OTHER_DEVICE_LOGOUT => 'heroicon-o-arrow-left-start-on-rectangle',

            self::PASSWORD_RESET,
            self::PASSWORD_RESET_LINK_SENT => 'heroicon-o-exclamation-triangle',

        };
    }

    /**
     * @return array<string, mixed>
     */
    public static function ordenar(): array
    {

        return sortEnumByLabel(self::cases());
    }
}
