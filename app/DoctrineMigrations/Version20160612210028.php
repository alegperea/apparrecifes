<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160612210028 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Entrega CHANGE co2_entregados co2_entregados INT DEFAULT NULL, CHANGE co2_retirados co2_retirados INT DEFAULT NULL, CHANGE co2_backup co2_backup INT DEFAULT NULL, CHANGE barriles_entregados barriles_entregados INT DEFAULT NULL, CHANGE barriles_retirados barriles_retirados INT DEFAULT NULL, CHANGE barriles_cliente barriles_cliente INT DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Entrega CHANGE co2_entregados co2_entregados INT NOT NULL, CHANGE co2_retirados co2_retirados INT NOT NULL, CHANGE co2_backup co2_backup INT NOT NULL, CHANGE barriles_entregados barriles_entregados INT NOT NULL, CHANGE barriles_retirados barriles_retirados INT NOT NULL, CHANGE barriles_cliente barriles_cliente INT NOT NULL');
    }
}
