
-- Schema tcc
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema tcc
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tcc` DEFAULT CHARACTER SET utf8 ;
USE `tcc` ;

-- -----------------------------------------------------
-- Table `tcc`.`Marca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc`.`Marca` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc`.`Categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc`.`Categoria` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc`.`Situacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc`.`Situacao` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc`.`Andamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc`.`Andamento` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc`.`Produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc`.`Produto` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  `marca_codigo` INT NOT NULL,
  `valor` FLOAT NULL,
  `categoria_codigo` INT NOT NULL,
  `situacao_codigo` INT NOT NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_Produto_Marca1_idx` (`Marca_codigo` ASC) ,
  INDEX `fk_Produto_Categoria1_idx` (`Categoria_codigo` ASC) ,
  INDEX `fk_Produto_Situacao1_idx` (`Situacao_codigo` ASC) ,
  CONSTRAINT `fk_Produto_Marca1`
    FOREIGN KEY (`marca_codigo`)
    REFERENCES `tcc`.`Marca` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Produto_Categoria1`
    FOREIGN KEY (`categoria_codigo`)
    REFERENCES `tcc`.`Categoria` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Produto_Situacao1`
    FOREIGN KEY (`situacao_codigo`)
    REFERENCES `tcc`.`Situacao` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc`.`Operacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc`.`Operacao` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc`.`Cidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc`.`Cidade` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `estado` VARCHAR(2) NOT NULL,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc`.`Cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc`.`Cliente` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `cpf` VARCHAR(45) NULL,
  `dataNascimento` DATE NULL,
  `email` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `cep` INT NULL,
  `endereco` VARCHAR(45) NULL,
  `bairro` VARCHAR(45) NULL,
  `telefone` INT NULL,
  `celular` INT NULL,
  `cidade_codigo` INT NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
  INDEX `fk_Cliente_Cidade1_idx` (`Cidade_codigo` ASC) ,
  CONSTRAINT `fk_Cliente_Cidade1`
    FOREIGN KEY (`cidade_codigo`)
    REFERENCES `tcc`.`Cidade` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc`.`Colaborador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc`.`Colaborador` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `login` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NULL,
  `situacao_codigo` INT NOT NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_Colaborador_Situacao1_idx` (`Situacao_codigo` ASC),
  CONSTRAINT `fk_Colaborador_Situacao1`
    FOREIGN KEY (`situacao_codigo`)
    REFERENCES `tcc`.`Situacao` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc`.`Ordem`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc`.`Ordem` (
  `codigo` INT GENERATED ALWAYS AS () VIRTUAL,
  `subTotal` FLOAT NOT NULL,
  `descTotal` FLOAT NOT NULL DEFAULT 0,00,
  `total` FLOAT NOT NULL,
  `operacao_codigo` INT NOT NULL,
  `observacao` VARCHAR(100) NULL,
  `cliente_codigo` INT NOT NULL,
  `colaborador_codigo` INT NOT NULL,
  `situacao_codigo` INT NOT NULL,
  `andamento_codigo` INT NOT NULL,
  PRIMARY KEY (`codigo`),
  INDEX `fk_Venda_Operacao1_idx` (`Operacao_codigo` ASC) ,
  INDEX `fk_Ordem_Cliente1_idx` (`Cliente_codigo` ASC) ,
  INDEX `fk_Ordem_Colaborador1_idx` (`Colaborador_codigo` ASC) ,
  INDEX `fk_Ordem_Situacao1_idx` (`Situacao_codigo` ASC),
  CONSTRAINT `fk_Venda_Operacao1`
    FOREIGN KEY (`operacao_codigo`)
    REFERENCES `tcc`.`Operacao` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ordem_Cliente1`
    FOREIGN KEY (`cliente_codigo`)
    REFERENCES `tcc`.`Cliente` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ordem_Colaborador1`
    FOREIGN KEY (`colaborador_codigo`)
    REFERENCES `tcc`.`Colaborador` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ordem_Situacao1`
    FOREIGN KEY (`situacao_codigo`)
    REFERENCES `tcc`.`Situacao` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ordem_Andamento1`
    FOREIGN KEY (`andamento_codigo`)
    REFERENCES `tcc`.`Andamento` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc`.`OrdemProduto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc`.`OrdemProduto` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `produto_codigo` INT NOT NULL,
  `ordem_codigo` INT NOT NULL,
  `qtde` FLOAT NOT NULL DEFAULT 1,
  `valorUnit` FLOAT NOT NULL,
  `valorTotal` FLOAT NOT NULL,
  `valorDesc` FLOAT NULL,
  INDEX `fk_Produto_has_Venda_Venda1_idx` (`Ordem_codigo` ASC) ,
  INDEX `fk_Produto_has_Venda_Produto_idx` (`Produto_codigo` ASC) ,
  PRIMARY KEY (`codigo`),
  CONSTRAINT `fk_Produto_has_Venda_Produto`
    FOREIGN KEY (`produto_codigo`)
    REFERENCES `tcc`.`Produto` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Produto_has_Venda_Venda1`
    FOREIGN KEY (`ordem_codigo`)
    REFERENCES `tcc`.`Ordem` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc`.`Servico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc`.`Servico` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc`.`OrdemServico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc`.`OrdemServico` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `servico_codigo` INT NOT NULL,
  `ordem_codigo` INT NOT NULL,
  `qtde` FLOAT NOT NULL DEFAULT 1,
  `valorUnit` FLOAT NOT NULL,
  `valorTotal` FLOAT NOT NULL,
  `valorDesc` FLOAT NULL,
  INDEX `fk_Servico_has_Venda_Venda1_idx` (`Ordem_codigo` ASC) ,
  INDEX `fk_Servico_has_Venda_Servico1_idx` (`Servico_codigo` ASC) ,
  PRIMARY KEY (`codigo`),
  CONSTRAINT `fk_Servico_has_Venda_Servico1`
    FOREIGN KEY (`servico_codigo`)
    REFERENCES `tcc`.`Servico` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Servico_has_Venda_Venda1`
    FOREIGN KEY (`ordem_codigo`)
    REFERENCES `tcc`.`Ordem` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
