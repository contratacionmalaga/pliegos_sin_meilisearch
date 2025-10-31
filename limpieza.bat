@echo off
echo ***********************************************************
echo CLEAR-COMPILED
echo ***********************************************************
echo php artisan clear-compiled
php artisan clear-compiled

echo ***********************************************************
echo ACTIVITYLOG
echo ***********************************************************
echo php artisan activitylog:clean
php artisan activitylog:clean

echo ***********************************************************
echo AUTH
echo ***********************************************************
echo php artisan auth:clear-resets
php artisan auth:clear-resets

echo ***********************************************************
echo CACHE
echo ***********************************************************
echo php artisan cache:clear
php artisan cache:clear

echo ***********************************************************
echo CONFIG
echo ***********************************************************
echo php artisan config:clear
php artisan config:clear

echo php artisan config:cache
php artisan config:cache

echo ***********************************************************
echo DB
echo ***********************************************************
echo php artisan db:monitor
php artisan db:monitor

echo php artisan db:show

echo ***********************************************************
echo DEBUGBAR
echo ***********************************************************
echo php artisan debugbar:clear

echo ***********************************************************
echo EVENT
echo ***********************************************************
echo php artisan event:clear
php artisan event:clear

echo php artisan event:cache
php artisan event:cache

echo php artisan event:list
php artisan event:list

echo ***********************************************************
echo FILAMENT
echo ***********************************************************
echo php artisan filament:clear-cached-components
php artisan filament:clear-cached-components

echo php artisan filament:optimize-clear
php artisan filament:optimize-clear

echo ***********************************************************
echo ICONS
echo ***********************************************************
echo php artisan icons:clear
php artisan icons:clear

echo php artisan icons:cache
php artisan icons:cache

echo ***********************************************************
echo LANG
echo ***********************************************************
echo php artisan lang:publish
php artisan lang:publish

echo ***********************************************************
echo MEDIA LIBRARY
echo ***********************************************************
echo php artisan media-library:clear
echo php artisan media-library:clear

echo ***********************************************************
echo MIGRATE STATUS
echo ***********************************************************
echo php artisan migrate:status
php artisan migrate:status

echo ***********************************************************
echo OPTIMIZE
echo ***********************************************************
echo php artisan optimize:clear
php artisan optimize:clear

echo ***********************************************************
echo QUEUE
echo ***********************************************************
echo php artisan queue:clear
php artisan queue:clear

echo ***********************************************************
echo ROUTE
echo ***********************************************************
echo php artisan route:clear
php artisan route:clear

echo php artisan route:cache
php artisan route:cache

echo php artisan route:list
php artisan route:list

echo ***********************************************************
echo SCHELUDE
echo ***********************************************************
echo php artisan schedule:clear-cache
php artisan schedule:clear-cache

echo ***********************************************************
echo VENDOR
echo ***********************************************************
echo php artisan vendor:publish
echo php artisan vendor:publish

echo ***********************************************************
echo VIEW
echo ***********************************************************
echo php artisan view:clear
php artisan view:clear

echo php artisan view:cache
php artisan view:cache

echo ***********************************************************
echo CACHE DE LOS DIFERENTES ELEMENTOS DE LA APLICACIÓN
echo ***********************************************************
echo php artisan schedule:clear-cache
php artisan schedule:clear-cache

echo php artisan filament:cache-components
php artisan filament:cache-components

echo php artisan filament:optimize
php artisan filament:optimize

echo php artisan package:discover
php artisan package:discover

echo composer dump-autoload
composer dump-autoload

echo composer install --optimize-autoloader --no-dev
composer install --optimize-autoloader --no-dev

echo ***********************************************************
echo ENLACE AL STORAGE
echo ***********************************************************
echo php artisan storage:link
php artisan storage:link

echo ***********************************************************
echo INFORMACIÓN DEL ESTADO GENERAL
echo ***********************************************************
echo php artisan about
php artisan about
