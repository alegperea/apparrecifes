<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160511203436 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Entrega CHANGE descuento_especial descuento_especial INT DEFAULT NULL, CHANGE pago_realizado pago_realizado INT DEFAULT NULL, CHANGE limpieza_realizada limpieza_realizada INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Cliente DROP cantidad_permitida');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Cliente ADD cantidad_permitida INT NOT NULL');
        $this->addSql('ALTER TABLE Entrega CHANGE descuento_especial descuento_especial TINYINT(1) DEFAULT NULL, CHANGE pago_realizado pago_realizado TINYINT(1) DEFAULT NULL, CHANGE limpieza_realizada limpieza_realizada TINYINT(1) DEFAULT NULL');
    }
}
