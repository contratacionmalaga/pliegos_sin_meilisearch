<?php

namespace App\Filament\Components\Filters\Admin;

use App\Enums\Acciones\AccionesImportarEntry;
use App\Enums\MunicipiosSegunPoblacion;
use App\Enums\Placsp\PLACSP_AwardingCriteriaCode;
use App\Enums\Placsp\PLACSP_AwardingCriteriaSubtypeCode;
use App\Enums\Placsp\PLACSP_ContractCode;
use App\Enums\Placsp\PLACSP_ContractFolderStatusCode;
use App\Enums\Placsp\PLACSP_ContractingAuthorityCode;
use App\Enums\Placsp\PLACSP_DeclarationTypeCode;
use App\Enums\Placsp\PLACSP_PreliminaryMarketConsultationStatusCode;
use App\Enums\Placsp\PLACSP_PreliminaryMarketConsultationTypeCode;
use App\Enums\Placsp\PLACSP_ResultCode;
use App\Enums\Placsp\PLACSP_SyndicationTenderingProcessCode;
use App\Enums\Placsp\PLACSP_TenderingNoticeTypeCode;
use App\Enums\Placsp\PLACSP_TenderResultCode;
use App\Enums\Placsp\TipoDocumento;
use App\Enums\Placsp\TipoSindicacion;
use App\Enums\RegistroContratos\RC_TiposDeAdministraciones;
use App\Enums\RegistroContratos\RC_TiposDeAdministracionesLocales;
use App\Enums\RegistroContratos\RC_TiposDeOrganosContratacion;
use App\Filament\Components\Filters\MiSelectFilter;
use Exception;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;

class EnumsSelectFilters
{


    /**
     * Filtro para obtener los usuarios según el valor del flag es_activo
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getResultCodeSelectFilter(): SelectFilter
    {

        $params = [
            'make' => 'result_code',
            'label' => 'Filtrar por el resultado adjudicación',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options($this->enumToArray(PLACSP_TenderResultCode::ordenar()));
    }
    /**
     * Filtro para obtener los usuarios según el valor del flag es_activo
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getContractFolderStatusCodeSelectFilter(): SelectFilter
    {

        $params = [
            'make' => 'contract_folder_status_code',
            'label' => 'Filtrar por el estado del contrato',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options($this->enumToArray(PLACSP_ContractFolderStatusCode::ordenar()));
    }

    /**
     * Filtro para obtener los usuarios según el valor del flag es_activo
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getTipoSindicacion(): SelectFilter
    {

        $params = [
            'make' => 'tipo_sindicacion',
            'label' => 'Filtrar por tipo de expediente',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options($this->enumToArray(TipoSindicacion::class::ordenar()));
    }

    /**
     * Filtro para obtener los usuarios según el valor del flag es_activo
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getTipoDocumento(): SelectFilter
    {

        $params = [
            'make' => 'document_reference_type',
            'label' => 'Filtrar por tipo de documento',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options($this->enumToArray(TipoDocumento::class::ordenar()));
    }


    /**
     * Filtro para obtener los usuarios según el valor del flag es_activo
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getTipoRequisitoPrevioParticipacion(): SelectFilter
    {

        $params = [
            'make' => 'requirement_type_code',
            'label' => 'Filtrar por tipo de requisito previo participación',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options($this->enumToArray(PLACSP_DeclarationTypeCode::class::ordenar()));
    }


    /**
     * Filtro para obtener los usuarios según el valor del flag es_activo
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getTipoCriterio(): SelectFilter
    {

        $params = [
            'make' => 'awarding_criteria_type_code',
            'label' => 'Filtrar por tipo de criterio',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options($this->enumToArray(PLACSP_AwardingCriteriaCode::class::ordenar()));
    }


    /**
     * Filtro para obtener los usuarios según el valor del flag es_activo
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getSubtipoCriterio(): SelectFilter
    {

        $params = [
            'make' => 'awarding_criteria_subtype_code',
            'label' => 'Filtrar por subtipo de criterio',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options($this->enumToArray(PLACSP_AwardingCriteriaSubtypeCode::class::ordenar()));
    }

    /**
     * Filtro para obtener los usuarios según el valor del flag es_activo
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getTipoAnuncio(): SelectFilter
    {

        $params = [
            'make' => 'notice_type_code',
            'label' => 'Filtrar por tipo de anuncio',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options($this->enumToArray(PLACSP_TenderingNoticeTypeCode::class::ordenar()));
    }

    /**
     * Filtro para obtener los usuarios según el valor del flag es_activo
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getMunicipioSegunPoblacion(): SelectFilter
    {

        $params = [
            'make' => 'municipio_segun_poblacion_id',
            'label' => 'Filtrar por intervalo de población del municipio',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options($this->enumToArray(MunicipiosSegunPoblacion::ordenar()));
    }

    /**
     * Filtro para obtener los usuarios según el valor del flag es_activo
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getAccionesImportarSelectFilter(): SelectFilter
    {

        $params = [
            'make' => 'accion',
            'label' => 'Filtrar por acción',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options($this->enumToArray(AccionesImportarEntry::ordenar()));
    }

    /**
     * Filtro para obtener los usuarios según el valor del flag es_activo
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getTypeCodeSelectFilter(): SelectFilter
    {

        $params = [
            'make' => 'type_code',
            'label' => 'Filtrar por tipo de contrato',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options($this->enumToArray(PLACSP_ContractCode::ordenar()));
    }

    /**
     * Filtro para obtener los usuarios según el valor del flag es_activo
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getContractingPartyTypeCodeSelectFilter(): SelectFilter
    {

        $params = [
            'make' => 'contracting_party_type_code',
            'label' => 'Filtrar por tipo de consulta',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options($this->enumToArray(PLACSP_ContractingAuthorityCode::ordenar()));
    }

    /**
     * Filtro para obtener los usuarios según el valor del flag es_activo
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getPreliminaryMarketConsultationTypeCodeSelectFilter(): SelectFilter
    {

        $params = [
            'make' => 'condition_type_code',
            'label' => 'Filtrar por tipo de consulta',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options($this->enumToArray(PLACSP_PreliminaryMarketConsultationTypeCode::ordenar()));
    }

    /**
     * Filtro para obtener los usuarios según el valor del flag es_activo
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getPreliminaryMarketConsultationStatusCodeSelectFilter(): SelectFilter
    {

        $params = [
            'make' => 'preliminary_market_consultation_status_code',
            'label' => 'Filtrar por el estado de la consulta',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options($this->enumToArray(PLACSP_PreliminaryMarketConsultationStatusCode::ordenar()));
    }

    /**
     * Filtro para obtener los usuarios según el valor del flag es_activo
     *
     * @return TernaryFilter
     * @throws Exception
     */
    public function getProcedureCodeSelectFilter(): SelectFilter
    {

        $params = [
            'make' => 'procedure_code',
            'label' => 'Filtrar por procedimiento de contratación',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options($this->enumToArray(PLACSP_SyndicationTenderingProcessCode::ordenar()));
    }

    /**
     * Filtro para obtener los usuarios según el valor del flag es_activo
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getTipoOrganoContratacionSelectFilter(): SelectFilter
    {

        $params = [
            'make' => 'tipo_organo_contratacion_rc_id',
            'label' => 'Filtrar por el tipo de órgano de contratación',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options($this->enumToArray(RC_TiposDeOrganosContratacion::ordenar()));
    }

    /**
     * Filtro para obtener los usuarios según el valor del flag es_activo
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getTipoAdminSelectFilter(): SelectFilter
    {

        $params = [
            'make' => 'tipo_admin_id',
            'label' => 'Filtrar por el tipo de administración',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options($this->enumToArray(RC_TiposDeAdministraciones::ordenar()));
    }

    /**
     * Filtro para obtener los usuarios según el valor del flag es_activo
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getTipoAdminLocalSelectFilter(): SelectFilter
    {

        $params = [
            'make' => 'tipo_admin_local_id',
            'label' => 'Filtrar por el tipo de administración local',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options($this->enumToArray(RC_TiposDeAdministracionesLocales::ordenar()));
    }

    private function enumToArray(array $opciones): array
    {
        return array_combine(
            array_map(static fn ($case) => $case->value, $opciones),          // Valor
            array_map(static fn ($case) => $case->getLabel(), $opciones)      // Etiqueta
        );
    }
}
