<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190510141604 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE incident (id INT AUTO_INCREMENT NOT NULL, titre LONGTEXT NOT NULL, description LONGTEXT NOT NULL, date DATETIME NOT NULL, is_resolu TINYINT(1) NOT NULL, id_Avion INT DEFAULT NULL, id_Employe INT DEFAULT NULL, INDEX IDX_3D03A11AC09F30C (id_Avion), INDEX IDX_3D03A11AE9244355 (id_Employe), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE incident ADD CONSTRAINT FK_3D03A11AC09F30C FOREIGN KEY (id_Avion) REFERENCES avion (id_Avion)');
        $this->addSql('ALTER TABLE incident ADD CONSTRAINT FK_3D03A11AE9244355 FOREIGN KEY (id_Employe) REFERENCES employe (id_Employe)');
        $this->addSql('ALTER TABLE aeroport CHANGE id_Aeroport id_Aeroport VARCHAR(3) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE incident');
        $this->addSql('ALTER TABLE aeroport CHANGE id_Aeroport id_Aeroport VARCHAR(3) NOT NULL COLLATE utf8_general_ci');
    }
}
