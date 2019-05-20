<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190516211103 extends AbstractMigration
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
        $this->addSql('ALTER TABLE avion CHANGE Kilometrage Kilometrage INT DEFAULT 0 NOT NULL, CHANGE Disponibilite Disponibilite TINYINT(1) DEFAULT \'0\' NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aeroport CHANGE id_Aeroport id_Aeroport VARCHAR(3) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE avion CHANGE Kilometrage Kilometrage INT NOT NULL, CHANGE Disponibilite Disponibilite TINYINT(1) NOT NULL');
    }
}
