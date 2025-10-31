@echo off
echo ***********************************************************
echo BORRADO Y ACTUALIZACI�N DE INDICES DE LOS MODELOS
echo ***********************************************************
php artisan scout:flush "App\Models\PLACSP\Adjudicacion"
php artisan scout:flush "App\Models\PLACSP\Anuncio"
php artisan scout:flush "App\Models\PLACSP\CondicionEspecialEjecucion"
php artisan scout:flush "App\Models\PLACSP\ContratoMayor"
php artisan scout:flush "App\Models\PLACSP\Cpv"
php artisan scout:flush "App\Models\PLACSP\CriterioAdjudicacion"
php artisan scout:flush "App\Models\PLACSP\Documento"
php artisan scout:flush "App\Models\PLACSP\Lote"
php artisan scout:flush "App\Models\PLACSP\Modificacion"
php artisan scout:flush "App\Models\PLACSP\RequisitoPrevioParticipacion"

php artisan scout:import-chunked "App\Models\PLACSP\Adjudicacion"
php artisan scout:import-chunked "App\Models\PLACSP\Anuncio"
php artisan scout:import-chunked "App\Models\PLACSP\CondicionEspecialEjecucion"
php artisan scout:import-chunked "App\Models\PLACSP\ContratoMayor"
php artisan scout:import-chunked "App\Models\PLACSP\Cpv"
php artisan scout:import-chunked "App\Models\PLACSP\CriterioAdjudicacion"
php artisan scout:import-chunked "App\Models\PLACSP\Documento"
php artisan scout:import-chunked "App\Models\PLACSP\Lote"
php artisan scout:import-chunked "App\Models\PLACSP\Modificacion"
php artisan scout:import-chunked "App\Models\PLACSP\RequisitoPrevioParticipacion"


echo Comparaci�n de �ndices entre DB y Meilisearch
php artisan scout:comparar-indices

