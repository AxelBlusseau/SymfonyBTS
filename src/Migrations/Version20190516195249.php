<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190516195249 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aeroport CHANGE id_Aeroport id_Aeroport VARCHAR(3) NOT NULL');
        $this->addSql('ALTER TABLE maintenance DROP FOREIGN KEY FK_2F84F8E941F7F24E');
        $this->addSql('DROP INDEX IDX_2F84F8E941F7F24E ON maintenance');
        $this->addSql('ALTER TABLE maintenance CHANGE id_incident_id id_Incident INT NOT NULL');
        $this->addSql('ALTER TABLE maintenance ADD CONSTRAINT FK_2F84F8E994AE2FD9 FOREIGN KEY (id_Incident) REFERENCES incident (id)');
        $this->addSql('CREATE INDEX IDX_2F84F8E994AE2FD9 ON maintenance (id_Incident)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aeroport CHANGE id_Aeroport id_Aeroport VARCHAR(3) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE maintenance DROP FOREIGN KEY FK_2F84F8E994AE2FD9');
        $this->addSql('DROP INDEX IDX_2F84F8E994AE2FD9 ON maintenance');
        $this->addSql('ALTER TABLE maintenance CHANGE id_incident id_incident_id INT NOT NULL');
        $this->addSql('ALTER TABLE maintenance ADD CONSTRAINT FK_2F84F8E941F7F24E FOREIGN KEY (id_incident_id) REFERENCES incident (id)');
        $this->addSql('CREATE INDEX IDX_2F84F8E941F7F24E ON maintenance (id_incident_id)');
    }
}
