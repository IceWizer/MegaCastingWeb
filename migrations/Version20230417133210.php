<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230417133210 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE emergency_level (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, level INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE casting_offer ADD emergency_level_id INT DEFAULT NULL, DROP emergency_level');
        $this->addSql('ALTER TABLE casting_offer ADD CONSTRAINT FK_FE44FC79870E1EFA FOREIGN KEY (emergency_level_id) REFERENCES emergency_level (id)');
        $this->addSql('CREATE INDEX IDX_FE44FC79870E1EFA ON casting_offer (emergency_level_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE casting_offer DROP FOREIGN KEY FK_FE44FC79870E1EFA');
        $this->addSql('DROP TABLE emergency_level');
        $this->addSql('DROP INDEX IDX_FE44FC79870E1EFA ON casting_offer');
        $this->addSql('ALTER TABLE casting_offer ADD emergency_level VARCHAR(255) NOT NULL, DROP emergency_level_id');
    }
}
