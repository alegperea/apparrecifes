<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160511210429 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Entrega ADD deuda INT DEFAULT NULL, ADD co2_entregados INT NOT NULL, ADD co2_retirados INT NOT NULL, ADD co2_backup INT NOT NULL, ADD barriles_entregados INT NOT NULL, ADD barriles_retirados INT NOT NULL, ADD barriles_cliente INT NOT NULL, DROP cambio_c02, CHANGE observacion observacion LONGTEXT DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Entrega ADD cambio_c02 TINYINT(1) DEFAULT NULL, DROP deuda, DROP co2_entregados, DROP co2_retirados, DROP co2_backup, DROP barriles_entregados, DROP barriles_retirados, DROP barriles_cliente, CHANGE observacion observacion LONGTEXT NOT NULL');
    }
}
