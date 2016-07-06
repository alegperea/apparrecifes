<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160706002218 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Entrega ADD co2_cambio TINYINT(1) DEFAULT NULL, CHANGE co2_entregados co2_entregados TINYINT(1) DEFAULT NULL, CHANGE co2_retirados co2_retirados TINYINT(1) DEFAULT NULL, CHANGE co2_backup co2_backup TINYINT(1) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Entrega DROP co2_cambio, CHANGE co2_entregados co2_entregados INT DEFAULT NULL, CHANGE co2_retirados co2_retirados INT DEFAULT NULL, CHANGE co2_backup co2_backup INT DEFAULT NULL');
    }
}
