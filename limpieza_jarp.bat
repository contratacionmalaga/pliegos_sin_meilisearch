@echo off
:: -----------------------------------------------------------
:: Script de mantenimiento Laravel - Optimizado para Windows 11
:: -----------------------------------------------------------

echo ***********************************************************
echo INICIANDO PROCESO DE MANTENIMIENTO DEL PROYECTO LARAVEL
echo ***********************************************************

:: -----------------------------------------
:: DESCUBRIMIENTO Y SOPORTE DE DESARROLLO
:: -----------------------------------------
echo 🔍 DESCUBRIENDO PAQUETES DE LARAVEL...
php artisan package:discover

:: -----------------------------------------
:: LIMPIEZA DE CACHÉS Y COMPONENTES
:: -----------------------------------------
echo 🧹 LIMPIANDO CACHÉS DE CONFIGURACIÓN, RUTAS, EVENTOS Y VISTAS...
php artisan config:clear
php artisan route:clear
php artisan event:clear
php artisan view:clear

echo 🗑️ LIMPIEZA DE CACHÉ GENERAL Y OPTIMIZACIONES...
php artisan cache:clear
php artisan optimize:clear
php artisan schedule:clear-cache

echo 🧼 LIMPIEZA DE COMPONENTES FILAMENT...
php artisan filament:clear-cached-components
php artisan filament:optimize-clear

echo 🧽 LIMPIEZA DE ICONOS Y MEDIA LIBRARY...
php artisan icons:clear
echo php artisan media-library:clear

:: -----------------------------------------
:: LIMPIEZA DE LOGS Y RESETES
:: -----------------------------------------
echo 🔐 LIMPIANDO RESETES DE CONTRASEÑAS Y LOGS...
php artisan auth:clear-resets
php artisan activitylog:clean

:: -----------------------------------------
:: BASE DE DATOS Y ENLACES
:: -----------------------------------------
echo 🧱 REVISANDO ESTADO DE LA BASE DE DATOS...
php artisan migrate:status
php artisan db:monitor

echo 🔗 CREANDO ENLACE A STORAGE...
echo php artisan storage:link

:: -----------------------------------------
:: CACHE FINAL (SIEMPRE DESPUÉS DE LIMPIAR)
:: -----------------------------------------
echo 🗃️ GENERANDO CACHÉS DEFINITIVAS...
php artisan config:cache
php artisan route:cache
php artisan event:cache
php artisan view:cache
php artisan filament:cache-components
php artisan filament:optimize
php artisan icons:cache

:: -----------------------------------------
:: FORMATEO Y ANÁLISIS DE CÓDIGO
:: -----------------------------------------
echo 🎨 FORMATEANDO CÓDIGO CON LARAVEL PINT...
call vendor\bin\pint
if %errorlevel% neq 0 (
    echo ⚠️  Laravel Pint ha devuelto un error. Continuando...
)

echo 🧼 REFACTORIZANDO CÓDIGO CON RECTOR...
call vendor\bin\rector process
if %errorlevel% neq 0 (
    echo ⚠️  Rector ha encontrado errores o advertencias. Continuando...
)

echo 🧠 ANALIZANDO CÓDIGO CON PHPSTAN...
call vendor\bin\phpstan analyse -c phpstan.neon
if %errorlevel% neq 0 (
    echo ⚠️  PHPStan ha detectado problemas. Continuando...
)

echo 📦 ACTUALIZANDO AUTOLOAD DE COMPOSER...
call composer dump-autoload
if %errorlevel% neq 0 (
    echo ⚠️  Composer ha fallado al regenerar el autoload. Continuando...
)

:: -----------------------------------------
:: COMPROBACIÓN FINAL
:: -----------------------------------------
echo ♻️ COMPROBANDO ESTADO DE CACHE...
php artisan about

echo ***********************************************************
echo ✅ FINALIZADO. EL PROYECTO ESTÁ LIMPIO Y OPTIMIZADO.
echo ***********************************************************
pause
