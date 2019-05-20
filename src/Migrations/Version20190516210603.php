<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190516210603 extends AbstractMigration
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
        $this->addSql('ALTER TABLE vol DROP FOREIGN KEY FK_95C97EBAC01957');
        $this->addSql('ALTER TABLE vol ADD CONSTRAINT FK_95C97EBAC01957 FOREIGN KEY (id_Trajet) REFERENCES trajet (id_Trajet) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aeroport CHANGE id_Aeroport id_Aeroport VARCHAR(3) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE vol DROP FOREIGN KEY FK_95C97EBAC01957');
        $this->addSql('ALTER TABLE vol ADD CONSTRAINT FK_95C97EBAC01957 FOREIGN KEY (id_Trajet) REFERENCES trajet (id_Trajet)');
    }
}
