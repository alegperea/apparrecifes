<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160328211517 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Entrega (id INT AUTO_INCREMENT NOT NULL, cliente_id INT DEFAULT NULL, fecha DATE NOT NULL, descuento_especial TINYINT(1) DEFAULT NULL, pago_realizado TINYINT(1) DEFAULT NULL, limpieza_realizada TINYINT(1) DEFAULT NULL, cambio_c02 TINYINT(1) DEFAULT NULL, INDEX IDX_2AD060F7DE734E51 (cliente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Entrega ADD CONSTRAINT FK_2AD060F7DE734E51 FOREIGN KEY (cliente_id) REFERENCES Cliente (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE Entrega');
    }
}
