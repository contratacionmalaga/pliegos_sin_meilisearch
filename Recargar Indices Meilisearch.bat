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

@echo on

 REM php artisan scout:import-chunked "App\Models\PLACSP\Adjudicacion"
 REM php artisan scout:import-chunked "App\Models\PLACSP\Anuncio"
 REM php artisan scout:import-chunked "App\Models\PLACSP\CondicionEspecialEjecucion"
 REM php artisan scout:import-chunked "App\Models\PLACSP\ContratoMayor"
 REM php artisan scout:import-chunked "App\Models\PLACSP\Cpv"
 REM php artisan scout:import-chunked "App\Models\PLACSP\CriterioAdjudicacion"
 REM php artisan scout:import-chunked "App\Models\PLACSP\Documento"
 REM php artisan scout:import-chunked "App\Models\PLACSP\Lote"
 REM php artisan scout:import-chunked "App\Models\PLACSP\Modificacion"
 REM php artisan scout:import-chunked "App\Models\PLACSP\RequisitoPrevioParticipacion"



REM echo Comparación de índices entre BD y Meilisearch
REM php artisan scout:comparar-indices
