-- modificaciones en la base de datos
ALTER TABLE gestion
ADD COLUMN `estado_gestion_acreditacion` ENUM('ACTIVO', 'INACTIVO') NULL DEFAULT NULL AFTER `estado_gestion`;



ALTER TABLE asignacion
ADD COLUMN `nombramiento_archivo_digital` VARCHAR(250) NULL DEFAULT NULL AFTER `nombramiento`;


DROP TABLE IF EXISTS `documento_archivo` ;
DROP TABLE IF EXISTS `documento` ;
DROP TABLE IF EXISTS `documento_tipo` ;






CREATE TABLE IF NOT EXISTS `actividad_academica_tipo` (
  `id_actividad_academica_tipo` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre_actividad_academica_tipo` VARCHAR(45) NULL DEFAULT NULL,
  `descripcion_actividad_academica_tipo` VARCHAR(550) NULL DEFAULT NULL,
  PRIMARY KEY (`id_actividad_academica_tipo`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `actividad_academica` (
  `id_actividad_academica` INT(11) NOT NULL AUTO_INCREMENT,
  `id_docente` INT(11) NOT NULL,
  `id_actividad_academica_tipo` INT(11) NOT NULL,
  `nombre_actividad_academica` VARCHAR(250) NULL DEFAULT NULL,
  `gestion` SMALLINT(6) NULL DEFAULT NULL,
  `archivo_digital` VARCHAR(250) NULL DEFAULT NULL,
  PRIMARY KEY (`id_actividad_academica`),
  INDEX `fk_actividad_academica_docente1_idx` (`id_docente` ASC),
  INDEX `fk_actividad_academica_actividad_academica_tipo1_idx` (`id_actividad_academica_tipo` ASC),
  CONSTRAINT `fk_actividad_academica_docente1`
    FOREIGN KEY (`id_docente`)
    REFERENCES `docente` (`id_docente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_actividad_academica_actividad_academica_tipo1`
    FOREIGN KEY (`id_actividad_academica_tipo`)
    REFERENCES `actividad_academica_tipo` (`id_actividad_academica_tipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `vida_universitaria_tipo` (
  `id_vida_universitaria_tipo` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre_vida_universitaria` VARCHAR(45) NULL DEFAULT NULL,
  `descripcion_vida_universitaria` VARCHAR(550) NULL DEFAULT NULL,
  PRIMARY KEY (`id_vida_universitaria_tipo`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `vida_universitaria` (
  `id_vida_universitaria` INT(11) NOT NULL AUTO_INCREMENT,
  `id_docente` INT(11) NOT NULL,
  `id_vida_universitaria_tipo` INT(11) NOT NULL,
  `descripcion_vida_universitaria` VARCHAR(250) NULL DEFAULT NULL,
  `gestion` SMALLINT(6) NULL DEFAULT NULL,
  `archivo_digital` VARCHAR(250) NULL DEFAULT NULL,
  PRIMARY KEY (`id_vida_universitaria`),
  INDEX `fk_vida_universitaria_docente1_idx` (`id_docente` ASC),
  INDEX `fk_vida_universitaria_vida_universitaria_tipo1_idx` (`id_vida_universitaria_tipo` ASC),
  CONSTRAINT `fk_vida_universitaria_docente1`
    FOREIGN KEY (`id_docente`)
    REFERENCES `docente` (`id_docente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vida_universitaria_vida_universitaria_tipo1`
    FOREIGN KEY (`id_vida_universitaria_tipo`)
    REFERENCES `vida_universitaria_tipo` (`id_vida_universitaria_tipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;



ALTER TABLE `asignacion` 
ADD COLUMN `estado` ENUM('PENDIENTE', 'APROBADO') NULL DEFAULT 'PENDIENTE' AFTER `evaluacion_archivo_digital`;

ALTER TABLE `titulo` 
ADD COLUMN `estado` ENUM('PENDIENTE', 'APROBADO') NULL DEFAULT 'PENDIENTE' AFTER `fecha_registro`;

ALTER TABLE `produccion_intelectual` 
ADD COLUMN `estado` ENUM('PENDIENTE', 'APROBADO') NULL DEFAULT 'PENDIENTE' AFTER `registro_archivo_digital`;

ALTER TABLE `actividad_academica` 
ADD COLUMN `estado` ENUM('PENDIENTE', 'APROBADO') NULL DEFAULT 'PENDIENTE' AFTER `archivo_digital`;

ALTER TABLE `vida_universitaria` 
ADD COLUMN `estado` ENUM('PENDIENTE', 'APROBADO') NULL DEFAULT 'PENDIENTE' AFTER `archivo_digital`;


ALTER TABLE `docente` 
ADD COLUMN `codigo_archivo` SMALLINT(6) NULL DEFAULT NULL AFTER `email`,
ADD UNIQUE INDEX `codigo_archivo_UNIQUE` (`codigo_archivo` ASC);
;

