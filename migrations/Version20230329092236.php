<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329092236 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_casting_offer (user_id INT NOT NULL, casting_offer_id INT NOT NULL, INDEX IDX_10CA5129A76ED395 (user_id), INDEX IDX_10CA5129F4D9BD29 (casting_offer_id), PRIMARY KEY(user_id, casting_offer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_casting_offer ADD CONSTRAINT FK_10CA5129A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_casting_offer ADD CONSTRAINT FK_10CA5129F4D9BD29 FOREIGN KEY (casting_offer_id) REFERENCES casting_offer (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_casting_offer DROP FOREIGN KEY FK_10CA5129A76ED395');
        $this->addSql('ALTER TABLE user_casting_offer DROP FOREIGN KEY FK_10CA5129F4D9BD29');
        $this->addSql('DROP TABLE user_casting_offer');
    }
}
