<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190510143302 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE employe_maintenance (id_Maintenance INT NOT NULL, id_Employe INT NOT NULL, INDEX IDX_2A066620B10ABAC9 (id_Maintenance), INDEX IDX_2A066620E9244355 (id_Employe), PRIMARY KEY(id_Maintenance, id_Employe)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employe_maintenance ADD CONSTRAINT FK_2A066620B10ABAC9 FOREIGN KEY (id_Maintenance) REFERENCES maintenance (id)');
        $this->addSql('ALTER TABLE employe_maintenance ADD CONSTRAINT FK_2A066620E9244355 FOREIGN KEY (id_Employe) REFERENCES employe (id_Employe)');
        $this->addSql('ALTER TABLE aeroport CHANGE id_Aeroport id_Aeroport VARCHAR(3) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE employe_maintenance');
        $this->addSql('ALTER TABLE aeroport CHANGE id_Aeroport id_Aeroport VARCHAR(3) NOT NULL COLLATE utf8_general_ci');
    }
}
