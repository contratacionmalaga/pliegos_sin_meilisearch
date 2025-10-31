--  --------------------------------------PLACSP_CONTRATOS_MAYORES---------------------------------------------------------------------------------------------------

-- placsp_contratos_mayores

--             ->columns([
--                 $this->miTextColumn->getSearchableSortableTextColumn('contract_folder_id'),
--                 $this->miTextColumn->getMultilineaTextColumn('party_name_organo_contratacion', 'Órgano de contratación'),
--                 $this->miTextColumn->getLimitableSearchableSortableTextColumn('name_objeto', 'Objeto del contrato'),
--                 $this->miTextColumn->getBadgeTextColumn('contract_folder_status_code'),
--                 $this->miTextColumn->getBadgeTextColumn('type_code'),
--                 $this->miTextColumn->getBadgeTextColumn('procedure_code'),
--             ])

-- Filtros
--            self::PLACSP_CONTRATO_MAYOR => [
--                $enumsSelectFilters->getContractFolderStatusCodeSelectFilter(),
--                $enumsSelectFilters->getTypeCodeSelectFilter(),
--                $enumsSelectFilters->getProcedureCodeSelectFilter(),
--                $miDateRangeFilter->getDateRangeFilterByUpdaded(),
--            ],

			
			
CREATE INDEX idx_contract_folder_id ON placsp_contratos_mayores (contract_folder_id ASC) USING BTREE;
CREATE INDEX idx_party_name_organo_contratacion ON placsp_contratos_mayores (party_name_organo_contratacion(768) ASC) USING BTREE;
CREATE INDEX idx_name_objeto ON placsp_contratos_mayores (name_objeto ASC) USING BTREE;
CREATE INDEX idx_contract_folder_status_code ON placsp_contratos_mayores (contract_folder_status_code ASC) USING BTREE;
CREATE INDEX idx_type_code ON placsp_contratos_mayores (type_code ASC) USING BTREE;
CREATE INDEX idx_procedure_code ON placsp_contratos_mayores (procedure_code ASC) USING BTREE;

CREATE INDEX idx_id_entry ON placsp_contratos_mayores (id_entry ASC) USING BTREE;
CREATE INDEX idx_id_plataforma_organo_contratacion ON placsp_contratos_mayores (id_plataforma_organo_contratacion ASC) USING BTREE;
CREATE INDEX idx_updated ON placsp_contratos_mayores (updated);

--  ---------------------------------------------PLACSP_ADJUDICACIONES--------------------------------------------------------------------------------------------

-- placsp_adjudicaciones

--             ->columns([
--                 $this->miTextColumn->getSearchableSortableTextColumn('contract_folder_id')																			X Search
--                 $this->miTextColumn->getLimitableSearchableSortableTextColumn('name_objeto', 'Objeto del contrato')						X Search
--                 $this->miTextColumn->getBadgeTextColumn('result_code')																													X Filtro
--                 $this->miTextColumn->getBadgeTextColumn('type_code')																														X Filtro
--                 $this->miTextColumn->getBadgeTextColumn('procedure_code')																											X Filtro
--                 $this->miTextColumn->getSortableTextColumn('party_name_adjudicatario', 'Adjudicatario'),												-
--                 $this->miTextColumn->getSearchableSortableTextColumn('nif_adjudicatario', 'Nif adjudicatario'),								X Search
--                 $this->miTextColumn->getSearchableSortableTextColumn('otros_adjudicatario', 'Otro Id. adjudicatario'),					X Search
--                 $this->miTextColumn->getSearchableSortableTextColumn('id_plataforma_adjudicatario', 'Id. EMP adjudicatario'),	X Search
--                 $this->miTextColumn->getBadgeTextColumn('sme_awarded_indicator'),																							X Filtro
--                 $this->miTextColumn->getMoneyTextColumn('total_amount', 'Importe c/iva'),																			-
--             ])

-- Filtros

--           self::PLACSP_ADJUDICACION => [
--               $enumsSelectFilters->getResultCodeSelectFilter(),
--               $enumsSelectFilters->getContractFolderStatusCodeSelectFilter(),
--               $enumsSelectFilters->getTypeCodeSelectFilter(),
--               $enumsSelectFilters->getProcedureCodeSelectFilter(),
--               $enumsTernaryFilters->getPymeTernaryFilter(),
--               $miDateRangeFilter->getDateRangeFilterByUpdaded(),
--           ],


			
-- Se muestran en el Table
CREATE INDEX idx_contract_folder_id ON placsp_adjudicaciones (contract_folder_id ASC) USING BTREE;
CREATE INDEX idx_name_objeto ON placsp_adjudicaciones (name_objeto ASC) USING BTREE;
CREATE INDEX idx_result_code ON placsp_adjudicaciones (result_code ASC) USING BTREE;
CREATE INDEX idx_type_code ON placsp_adjudicaciones (type_code ASC) USING BTREE;
CREATE INDEX idx_procedure_code ON placsp_adjudicaciones (procedure_code ASC) USING BTREE;
CREATE INDEX idx_nif_adjudicatario ON placsp_adjudicaciones (nif_adjudicatario ASC) USING BTREE;
CREATE INDEX idx_otros_adjudicatario ON placsp_adjudicaciones (otros_adjudicatario ASC) USING BTREE;
CREATE INDEX idx_id_plataforma_adjudicatario ON placsp_adjudicaciones (id_plataforma_adjudicatario ASC) USING BTREE;
CREATE INDEX idx_sme_awarded_indicator ON placsp_adjudicaciones (sme_awarded_indicator);

CREATE INDEX idx_contract_folder_status_code ON placsp_adjudicaciones (contract_folder_status_code ASC) USING BTREE;

CREATE INDEX idx_id_entry ON placsp_adjudicaciones (id_entry ASC) USING BTREE;
CREATE INDEX idx_party_name_organo_contratacion ON placsp_adjudicaciones (party_name_organo_contratacion(768) ASC) USING BTREE;
CREATE INDEX idx_id_plataforma_organo_contratacion ON placsp_adjudicaciones (id_plataforma_organo_contratacion ASC) USING BTREE;
CREATE INDEX idx_updated ON placsp_adjudicaciones (updated);
		
		
--  ---------------------------------------------PLACSP_MODIFICACIONES--------------------------------------------------------------------------------------------
		
-- placsp_modificaciones

--             ->columns([
--                 $this->miTextColumn->getSearchableSortableTextColumn('contract_folder_id'),													X Search
--                 $this->miTextColumn->getLimitableSearchableSortableTextColumn('name_objeto','Objeto del contrato'),	X Search
--                 $this->miTextColumn->getBadgeTextColumn('contract_folder_status_code'),															X Filtro
--                 $this->miTextColumn->getBadgeTextColumn('type_code'),																								X Filtro
--                 $this->miTextColumn->getBadgeTextColumn('procedure_code'),																						X Filtro
--             ])

-- Filtros
--            self::PLACSP_MODIFICACION => [
--                $enumsSelectFilters->getContractFolderStatusCodeSelectFilter(),
--                $enumsSelectFilters->getTypeCodeSelectFilter(),
--                $enumsSelectFilters->getProcedureCodeSelectFilter(),
--            ],

-- Table						
CREATE INDEX idx_contract_folder_id ON placsp_modificaciones (contract_folder_id ASC) USING BTREE;
CREATE INDEX idx_name_objeto ON placsp_modificaciones (name_objeto ASC) USING BTREE;
CREATE INDEX idx_contract_folder_status_code ON placsp_modificaciones (contract_folder_status_code ASC) USING BTREE;
CREATE INDEX idx_type_code ON placsp_modificaciones (type_code ASC) USING BTREE;
CREATE INDEX idx_procedure_code ON placsp_modificaciones (procedure_code ASC) USING BTREE;

CREATE INDEX idx_id_entry ON placsp_modificaciones (id_entry ASC) USING BTREE;
CREATE INDEX idx_party_name_organo_contratacion ON placsp_modificaciones (party_name_organo_contratacion(768) ASC) USING BTREE;
CREATE INDEX idx_id_plataforma_organo_contratacion ON placsp_modificaciones (id_plataforma_organo_contratacion ASC) USING BTREE;
CREATE INDEX idx_updated ON placsp_modificaciones (updated);



--  ---------------------------------------------PLACSP_ANUNCIOS--------------------------------------------------------------------------------------------

-- placsp_anuncios

--           ->columns([
--               $this->miTextColumn->getBadgeDateTimeTextColumn('updated', 'Fecha última actualización')
--               $this->miTextColumn->getBadgeTextColumn('notice_type_code', 'Tipo de anuncio'),									X Filtro
--               $this->miTextColumn->getSearchableSortableTextColumn('publication_media_name', 'Medio de publicación'),			X Search
--               $this->miTextColumn->getBadgeDateTextColumn('issue_date', 'Fecha de publicación'),									X Search
--               $this->miTextColumn->getSearchableSortableTextColumn('party_name_organo_contratacion', 'Órgano de contratación')	X Search
--               $this->miTextColumn->getSearchableSortableTextColumn('id_plataforma_organo_contratacion', 'Id. Plataforma')		X Search
--           ])

-- Filtros
--           self::PLACSP_ANUNCIO => [
--               $enumsSelectFilters->getTipoAnuncio(),
--               $miDateRangeFilter->getDateRangeFilterByUpdaded(),
--           ],

CREATE INDEX idx_notice_type_code ON placsp_anuncios (notice_type_code(50));
-- CREATE INDEX idx_publication_media_name ON placsp_anuncios (publication_media_name(50));
-- CREATE INDEX idx_issue_date ON placsp_anuncios (issue_date(50));

-- CREATE INDEX idx_contract_folder_status_code ON placsp_anuncios (contract_folder_status_code ASC) USING BTREE;
-- CREATE INDEX idx_party_name_organo_contratacion ON placsp_anuncios (party_name_organo_contratacion(50));
-- CREATE INDEX idx_id_plataforma_organo_contratacion ON placsp_anuncios (id_plataforma_organo_contratacion(50));
CREATE INDEX idx_updated ON placsp_anuncios (updated);


 ---------------------------------------------PLACSP_DOCUMENTOS--------------------------------------------------------------------------------------------

-- placsp_documentos

--           ->columns([
--               $this->miTextColumn->getBadgeTextColumn('document_reference_type','Tipo de documento'),				X Filtro
--               $this->miTextColumn->getSearchableSortableTextColumn('filename','Nombre del fichero'),					X Search
--               $this->miTextColumn->getSearchableSortableTextColumn('document_hash','Hash'),							X Search
--               $this->miTextColumn->getSearchableSortableTextColumn('id_document_reference','Identificador'),			X Search
--               $this->miTextColumn->getBadgeDateTimeTextColumn('updated','Actualización en PLACSP'),					X Search
--               $this->miTextColumn->getSearchableSortableTextColumn('contract_folder_id', 'Expediente')				X Search
--               $this->miTextColumn->getBadgeTextColumn('contract_folder_status_code', 'Estado expediente')			X Filtro   ¿Añadir en filtros?
--               $this->miTextColumn->getLimitableSearchableSortableTextColumn('party_name_organo_contratacion', 'Órgano de contratación')				X Search
--           ])


-- Filtros

--           self::PLACSP_DOCUMENTO => [
--               $enumsSelectFilters->getTipoDocumento(),
--               $miDateRangeFilter->getDateRangeFilterByUpdaded(),
--           ],



CREATE INDEX idx_document_reference_type ON placsp_documentos (document_reference_type);
-- CREATE INDEX idx_filename ON placsp_documentos (filename);
-- CREATE INDEX idx_document_hash ON placsp_documentos (document_hash);
-- CREATE INDEX idx_id_document_reference ON placsp_documentos (id_document_reference);
CREATE INDEX idx_updated ON placsp_documentos (updated);
-- CREATE INDEX idx_contract_folder_id ON placsp_documentos (contract_folder_id);
-- CREATE INDEX idx_contract_folder_status_code ON placsp_documentos (contract_folder_status_code);
-- CREATE INDEX idx_party_name_organo_contratacion ON placsp_documentos (party_name_organo_contratacion);



--  --------------------------------------------- RESTO -----------------------------------------------------------------------------------


-- placsp_condiciones_especiales_ejecucion
CREATE INDEX idx_updated ON placsp_condiciones_especiales_ejecucion (updated);

-- placsp_cpvs
CREATE INDEX idx_updated ON placsp_cpvs (updated);

-- placsp_criterios_adjudicacion
CREATE INDEX idx_updated ON placsp_criterios_adjudicacion (updated);


-- placsp_lotes
CREATE INDEX idx_updated ON placsp_lotes (updated);


-- placsp_requisitos_previos_participacion
CREATE INDEX idx_updated ON placsp_requisitos_previos_participacion (updated);










