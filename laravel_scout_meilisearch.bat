@echo off
echo ***********************************************************
echo BORRADO Y ACTUALIZACIÓN DE INDICES DE LOS MODELOS
echo ***********************************************************
echo Adjudicacion
php artisan scout:flush "App\Models\ImportacionPlacsp\Adjudicacion"
php artisan scout:import "App\Models\ImportacionPlacsp\Adjudicacion"

echo ConsultaPreliminarMercado
php artisan scout:flush "App\Models\InformacionContratacion\ConsultaPreliminarMercado"
php artisan scout:import "App\Models\InformacionContratacion\ConsultaPreliminarMercado"

echo ContratoMayor
php artisan scout:flush "App\Models\InformacionContratacion\ContratoMayor"
php artisan scout:import "App\Models\InformacionContratacion\ContratoMayor"

echo ContratoMenor
php artisan scout:flush "App\Models\InformacionContratacion\ContratoMenor"
php artisan scout:import "App\Models\InformacionContratacion\ContratoMenor"

echo EncargoMedioPropio
php artisan scout:flush "App\Models\InformacionContratacion\EncargoMedioPropio"
php artisan scout:import "App\Models\InformacionContratacion\EncargoMedioPropio"

echo OrganoContratacion
php artisan scout:flush "App\Models\EstructuraAdministrativa\OrganoContratacion"
php artisan scout:import "App\Models\EstructuraAdministrativa\OrganoContratacion"

echo Comparación de índices entre DB y Meilisearch
php artisan scout:comparar-indices
