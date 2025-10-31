
-- vista_expedientes
-- vista_modificaciones
-- vista_adjudicaciones
-- vista_anuncios
-- vista_condiciones_especiales_ejecucion
-- vista_criterios_adjudicacion
-- vista_cpvs
-- vista_documentos
-- vista_lotes
-- vista_requisitos_previos_participacion

-- DROP TABLE IF EXISTS placsp_expedientes;
-- CREATE TABLE placsp_expedientes AS
--     SELECT * from `java-importacion-opendata`.`vista_expedientes`;

DROP TABLE IF EXISTS placsp_contratos_mayores;
CREATE TABLE placsp_contratos_mayores AS
    SELECT * from `java-importacion-opendata`.`vista_expedientes` v where v.tipo_sindicacion = 'MAY';

DROP TABLE IF EXISTS placsp_modificaciones;
CREATE TABLE placsp_modificaciones AS
    SELECT * from `java-importacion-opendata`.`vista_modificaciones` v where v.tipo_sindicacion = 'MAY';

DROP TABLE IF EXISTS placsp_adjudicaciones;
CREATE TABLE placsp_adjudicaciones AS
    SELECT * from `java-importacion-opendata`.`vista_adjudicaciones` v where v.tipo_sindicacion = 'MAY';




DROP TABLE IF EXISTS placsp_anuncios ;
CREATE TABLE placsp_anuncios AS
    SELECT * from `java-importacion-opendata`.`vista_anuncios` v where v.tipo_sindicacion = 'MAY';

DROP TABLE IF EXISTS placsp_condiciones_especiales_ejecucion ;
CREATE TABLE placsp_condiciones_especiales_ejecucion AS
    SELECT * from `java-importacion-opendata`.`vista_condiciones_especiales_ejecucion` v where v.tipo_sindicacion = 'MAY';

DROP TABLE IF EXISTS placsp_criterios_adjudicacion ;
CREATE TABLE placsp_criterios_adjudicacion AS
    SELECT * from `java-importacion-opendata`.`vista_criterios_adjudicacion` v where v.tipo_sindicacion = 'MAY';

DROP TABLE IF EXISTS placsp_cpvs ;
CREATE TABLE placsp_cpvs AS
    SELECT * from `java-importacion-opendata`.`vista_cpvs` v where v.tipo_sindicacion = 'MAY';

DROP TABLE IF EXISTS placsp_documentos ;
CREATE TABLE placsp_documentos AS
    SELECT * from `java-importacion-opendata`.`vista_documentos` v where v.tipo_sindicacion = 'MAY';

DROP TABLE IF EXISTS placsp_lotes ;
CREATE TABLE placsp_lotes AS
    SELECT * from `java-importacion-opendata`.`vista_lotes` v where v.tipo_sindicacion = 'MAY';

DROP TABLE IF EXISTS placsp_requisitos_previos_participacion ;
CREATE TABLE placsp_requisitos_previos_participacion AS
    SELECT * from `java-importacion-opendata`.`vista_requisitos_previos_participacion` v where v.tipo_sindicacion = 'MAY';
