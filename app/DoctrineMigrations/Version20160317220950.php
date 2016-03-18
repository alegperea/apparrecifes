<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160317220950 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE PaginaInicio (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(50) NOT NULL, ruta VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Usuario (id INT AUTO_INCREMENT NOT NULL, perfil_id INT DEFAULT NULL, pagina_inicio_id INT DEFAULT NULL, nombre VARCHAR(40) NOT NULL, apellido VARCHAR(40) NOT NULL, tipo_documento VARCHAR(20) DEFAULT NULL, numero_documento VARCHAR(12) DEFAULT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, salt VARCHAR(50) NOT NULL, lat DOUBLE PRECISION DEFAULT NULL, lon DOUBLE PRECISION DEFAULT NULL, activo TINYINT(1) NOT NULL, fecha_actualizacion DATETIME DEFAULT NULL, telefono VARCHAR(255) DEFAULT NULL, telefono_alternativo VARCHAR(255) DEFAULT NULL, interno VARCHAR(10) DEFAULT NULL, oficina VARCHAR(255) DEFAULT NULL, calle VARCHAR(255) DEFAULT NULL, direccion_nro INT DEFAULT NULL, codigo_postal VARCHAR(50) DEFAULT NULL, eliminado TINYINT(1) NOT NULL, ruta_foto VARCHAR(255) DEFAULT NULL, usuarioActualizacion_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_EDD889C1F85E0677 (username), UNIQUE INDEX UNIQ_EDD889C1E7927C74 (email), INDEX IDX_EDD889C182A0A2E8 (usuarioActualizacion_id), INDEX IDX_EDD889C157291544 (perfil_id), INDEX IDX_EDD889C17BC0A7CC (pagina_inicio_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Rol (id INT AUTO_INCREMENT NOT NULL, usuario_alta_id INT DEFAULT NULL, usuario_baja_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, descripcion LONGTEXT NOT NULL, fecha_alta DATETIME NOT NULL, fecha_baja DATETIME DEFAULT NULL, activo TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_361879D73A909126 (nombre), INDEX IDX_361879D7A0753702 (usuario_alta_id), INDEX IDX_361879D7F2D317A2 (usuario_baja_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Mensaje (id INT AUTO_INCREMENT NOT NULL, usuario_origen_id INT NOT NULL, usuario_destino_id INT NOT NULL, mensaje_respuesta_id INT DEFAULT NULL, texto LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, leido TINYINT(1) NOT NULL, INDEX IDX_54DE249D1A6974DF (usuario_origen_id), INDEX IDX_54DE249D17064CB7 (usuario_destino_id), UNIQUE INDEX UNIQ_54DE249D3CBD83BB (mensaje_respuesta_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Perfil (id INT AUTO_INCREMENT NOT NULL, usuario_baja_id INT DEFAULT NULL, usuario_alta_id INT DEFAULT NULL, pagina_inicio_default_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, fecha_alta DATETIME NOT NULL, fecha_baja DATETIME DEFAULT NULL, activo TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_91C973713A909126 (nombre), INDEX IDX_91C97371F2D317A2 (usuario_baja_id), INDEX IDX_91C97371A0753702 (usuario_alta_id), INDEX IDX_91C97371F67DF3D2 (pagina_inicio_default_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE perfil_rol (perfil_id INT NOT NULL, rol_id INT NOT NULL, INDEX IDX_1467FB3857291544 (perfil_id), INDEX IDX_1467FB384BAB96C (rol_id), PRIMARY KEY(perfil_id, rol_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Usuario ADD CONSTRAINT FK_EDD889C182A0A2E8 FOREIGN KEY (usuarioActualizacion_id) REFERENCES Usuario (id)');
        $this->addSql('ALTER TABLE Usuario ADD CONSTRAINT FK_EDD889C157291544 FOREIGN KEY (perfil_id) REFERENCES Perfil (id)');
        $this->addSql('ALTER TABLE Usuario ADD CONSTRAINT FK_EDD889C17BC0A7CC FOREIGN KEY (pagina_inicio_id) REFERENCES PaginaInicio (id)');
        $this->addSql('ALTER TABLE Rol ADD CONSTRAINT FK_361879D7A0753702 FOREIGN KEY (usuario_alta_id) REFERENCES Usuario (id)');
        $this->addSql('ALTER TABLE Rol ADD CONSTRAINT FK_361879D7F2D317A2 FOREIGN KEY (usuario_baja_id) REFERENCES Usuario (id)');
        $this->addSql('ALTER TABLE Mensaje ADD CONSTRAINT FK_54DE249D1A6974DF FOREIGN KEY (usuario_origen_id) REFERENCES Usuario (id)');
        $this->addSql('ALTER TABLE Mensaje ADD CONSTRAINT FK_54DE249D17064CB7 FOREIGN KEY (usuario_destino_id) REFERENCES Usuario (id)');
        $this->addSql('ALTER TABLE Mensaje ADD CONSTRAINT FK_54DE249D3CBD83BB FOREIGN KEY (mensaje_respuesta_id) REFERENCES Mensaje (id)');
        $this->addSql('ALTER TABLE Perfil ADD CONSTRAINT FK_91C97371F2D317A2 FOREIGN KEY (usuario_baja_id) REFERENCES Usuario (id)');
        $this->addSql('ALTER TABLE Perfil ADD CONSTRAINT FK_91C97371A0753702 FOREIGN KEY (usuario_alta_id) REFERENCES Usuario (id)');
        $this->addSql('ALTER TABLE Perfil ADD CONSTRAINT FK_91C97371F67DF3D2 FOREIGN KEY (pagina_inicio_default_id) REFERENCES PaginaInicio (id)');
        $this->addSql('ALTER TABLE perfil_rol ADD CONSTRAINT FK_1467FB3857291544 FOREIGN KEY (perfil_id) REFERENCES Perfil (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE perfil_rol ADD CONSTRAINT FK_1467FB384BAB96C FOREIGN KEY (rol_id) REFERENCES Rol (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Usuario DROP FOREIGN KEY FK_EDD889C17BC0A7CC');
        $this->addSql('ALTER TABLE Perfil DROP FOREIGN KEY FK_91C97371F67DF3D2');
        $this->addSql('ALTER TABLE Usuario DROP FOREIGN KEY FK_EDD889C182A0A2E8');
        $this->addSql('ALTER TABLE Rol DROP FOREIGN KEY FK_361879D7A0753702');
        $this->addSql('ALTER TABLE Rol DROP FOREIGN KEY FK_361879D7F2D317A2');
        $this->addSql('ALTER TABLE Mensaje DROP FOREIGN KEY FK_54DE249D1A6974DF');
        $this->addSql('ALTER TABLE Mensaje DROP FOREIGN KEY FK_54DE249D17064CB7');
        $this->addSql('ALTER TABLE Perfil DROP FOREIGN KEY FK_91C97371F2D317A2');
        $this->addSql('ALTER TABLE Perfil DROP FOREIGN KEY FK_91C97371A0753702');
        $this->addSql('ALTER TABLE perfil_rol DROP FOREIGN KEY FK_1467FB384BAB96C');
        $this->addSql('ALTER TABLE Mensaje DROP FOREIGN KEY FK_54DE249D3CBD83BB');
        $this->addSql('ALTER TABLE Usuario DROP FOREIGN KEY FK_EDD889C157291544');
        $this->addSql('ALTER TABLE perfil_rol DROP FOREIGN KEY FK_1467FB3857291544');
        $this->addSql('DROP TABLE PaginaInicio');
        $this->addSql('DROP TABLE Usuario');
        $this->addSql('DROP TABLE Rol');
        $this->addSql('DROP TABLE Mensaje');
        $this->addSql('DROP TABLE Perfil');
        $this->addSql('DROP TABLE perfil_rol');
    }
}
