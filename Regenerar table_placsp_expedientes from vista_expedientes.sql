

-- Original

-- `laravel-estructura-administrativa-v4`.placsp_expedientes definition

-- CREATE TABLE `placsp_expedientes` (
--   `tipo_sindicacion` enum('AGR','CPM','EMP','ERROR','MAY','MEN','PRUEBA') DEFAULT NULL,
--   `link_self` varchar(2500) NOT NULL,
--   `summary` text DEFAULT NULL,
--   `title` varchar(2500) DEFAULT NULL,
--   `enlace` varchar(500) DEFAULT NULL,
--   `identificador_placsp` varchar(500) NOT NULL,
--   `updated` datetime(6) DEFAULT NULL,
--   `contract_folder_id` varchar(50) DEFAULT NULL,
--   `contract_folder_status_code` varchar(50) NOT NULL,
--   `contracting_party_type_code` varchar(50) DEFAULT NULL,
--   `organo_contratacion` varchar(500) DEFAULT NULL,
--   `id_plataforma` varchar(50) DEFAULT NULL,
--   `nif` varchar(50) DEFAULT NULL,
--   `objeto_contrato` text DEFAULT NULL,
--   `type_code` varchar(50) DEFAULT NULL,
--   `subtype_code` varchar(50) DEFAULT NULL,
--   `mix_contract_indicator` bit(1) DEFAULT NULL,
--   `description` text DEFAULT NULL,
--   `submission_method_code` varchar(50) DEFAULT NULL,
--   `urgency_code` varchar(50) DEFAULT NULL,
--   `part_presentation_code` varchar(50) DEFAULT NULL,
--   `procedure_code` varchar(50) DEFAULT NULL,
--   `contracting_system_code` varchar(50) DEFAULT NULL,
--   `tender_submission_deadline_period` datetime(6) DEFAULT NULL,
--   `document_availability_period` datetime(6) DEFAULT NULL,
--   `overthreshold_indicator` bit(1) DEFAULT NULL,
--   `maximun_tenderer_awarded_lot_quantity` double DEFAULT NULL,
--   `maximum_lot_presentation_quantity` double DEFAULT NULL,
--   `lots_combination_contracting_authority_rights` text DEFAULT NULL,
--   `price_revision_formula_description` text DEFAULT NULL,
--   `funding_program_code` varchar(2500) DEFAULT NULL,
--   `funding_program` varchar(2500) DEFAULT NULL,
--   `procurement_national_legislation_code` varchar(50) DEFAULT NULL,
--   `procurement_legislation_document_reference` varchar(50) DEFAULT NULL,
--   `variant_constraint_indicator` bit(1) DEFAULT NULL,
--   `required_curricula_indicator` bit(1) DEFAULT NULL,
--   `received_appeal_quantity` double DEFAULT NULL,
--   `epaymentmeans_indicator` bit(1) DEFAULT NULL,
--   `eordering_indicator` bit(1) DEFAULT NULL,
--   `electronic_invoicing_indicator` bit(1) DEFAULT NULL,
--   PRIMARY KEY (`identificador_placsp` DESC) USING BTREE,
--   KEY `expedientes_tipo_sindicacion_index` (`tipo_sindicacion`) USING BTREE,
--   KEY `expedientes_identificador_placsp_index` (`identificador_placsp`) USING HASH,
--   KEY `expedientes_contract_folder_status_code_index` (`contract_folder_status_code`) USING BTREE,
--   KEY `expedientes_contracting_party_type_code_index` (`contracting_party_type_code`) USING BTREE,
--   FULLTEXT KEY `expedientes_summary` (`summary`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-------------------------------------------------------------------------------------------------------

DROP TABLE IF EXISTS placsp_expedientes;

CREATE TABLE placsp_expedientes AS
    SELECT * from `java_importacion_opendata_filter_by_ocs`.`vista_expedientes`;

ALTER TABLE placsp_expedientes
  ADD PRIMARY KEY (`identificador_placsp` DESC) USING BTREE,
  ADD INDEX expedientes_tipo_sindicacion_index (`tipo_sindicacion`) USING BTREE,
  ADD INDEX expedientes_identificador_placsp_index (`identificador_placsp`) USING HASH, -- HASH no válido en InnoDB
  ADD INDEX expedientes_contract_folder_status_code_index (`contract_folder_status_code`) USING BTREE,
  ADD INDEX expedientes_contracting_party_type_code_index (`contracting_party_type_code`) USING BTREE,
  ADD FULLTEXT INDEX expedientes_summary (`summary`);
  

