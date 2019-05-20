<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190510142507 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE maintenance (id INT AUTO_INCREMENT NOT NULL, id_incident_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, date_fin_reelle DATETIME DEFAULT NULL, is_finished TINYINT(1) NOT NULL, INDEX IDX_2F84F8E941F7F24E (id_incident_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE maintenance ADD CONSTRAINT FK_2F84F8E941F7F24E FOREIGN KEY (id_incident_id) REFERENCES incident (id)');
        $this->addSql('ALTER TABLE aeroport CHANGE id_Aeroport id_Aeroport VARCHAR(3) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE maintenance');
        $this->addSql('ALTER TABLE aeroport CHANGE id_Aeroport id_Aeroport VARCHAR(3) NOT NULL COLLATE utf8_general_ci');
    }
}
