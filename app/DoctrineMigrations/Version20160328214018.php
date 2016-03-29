<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160328214018 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Producto ADD entrega_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Producto ADD CONSTRAINT FK_5ECD64437AB91AEC FOREIGN KEY (entrega_id) REFERENCES Entrega (id)');
        $this->addSql('CREATE INDEX IDX_5ECD64437AB91AEC ON Producto (entrega_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Producto DROP FOREIGN KEY FK_5ECD64437AB91AEC');
        $this->addSql('DROP INDEX IDX_5ECD64437AB91AEC ON Producto');
        $this->addSql('ALTER TABLE Producto DROP entrega_id');
    }
}
