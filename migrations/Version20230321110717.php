<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230321110717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE broadcast_partner (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE casting_number (id INT AUTO_INCREMENT NOT NULL, casting_number INT NOT NULL, price NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE casting_offer (id INT AUTO_INCREMENT NOT NULL, coordonate_id INT NOT NULL, customer_id INT NOT NULL, contract_type_id INT NOT NULL, label VARCHAR(255) NOT NULL, reference VARCHAR(255) NOT NULL, start_publish_date DATETIME NOT NULL, publication_duration INT NOT NULL, contract_start_date DATE NOT NULL, job_number INT NOT NULL, location VARCHAR(4096) NOT NULL, job_description VARCHAR(4096) NOT NULL, profil_description VARCHAR(4096) NOT NULL, INDEX IDX_FE44FC795ED4E0D4 (coordonate_id), INDEX IDX_FE44FC799395C3F3 (customer_id), INDEX IDX_FE44FC79CD1DF15B (contract_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE casting_offer_job (casting_offer_id INT NOT NULL, job_id INT NOT NULL, INDEX IDX_D24AC9BAF4D9BD29 (casting_offer_id), INDEX IDX_D24AC9BABE04EA9 (job_id), PRIMARY KEY(casting_offer_id, job_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE casting_pack_offer (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, price NUMERIC(10, 2) NOT NULL, duration INT NOT NULL, casting_number INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contract_type (id INT AUTO_INCREMENT NOT NULL, label_long VARCHAR(255) NOT NULL, label_short VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coordonate (id INT AUTO_INCREMENT NOT NULL, web_site VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(20) NOT NULL, fax_number VARCHAR(20) NOT NULL, postal_line1 VARCHAR(34) NOT NULL, postal_line2 VARCHAR(34) NOT NULL, postal_line3 VARCHAR(34) NOT NULL, postal_line4 VARCHAR(34) NOT NULL, postal_line5 VARCHAR(34) NOT NULL, postal_line6 VARCHAR(34) NOT NULL, postal_line7 VARCHAR(34) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_packs (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, casting_pack_offer_id INT NOT NULL, price NUMERIC(10, 2) NOT NULL, INDEX IDX_77CB151C9395C3F3 (customer_id), INDEX IDX_77CB151CDB056BDB (casting_pack_offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE duration (id INT AUTO_INCREMENT NOT NULL, duration INT NOT NULL, price NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_job_domain (job_domain_id INT NOT NULL, PRIMARY KEY(job_domain_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_domain (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE observer (casting_offer_id INT NOT NULL, broadcast_partner_id INT NOT NULL, view_count INT NOT NULL, detail_count INT NOT NULL, INDEX IDX_9B6F44E7F4D9BD29 (casting_offer_id), INDEX IDX_9B6F44E7175ED9C0 (broadcast_partner_id), PRIMARY KEY(casting_offer_id, broadcast_partner_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE casting_offer ADD CONSTRAINT FK_FE44FC795ED4E0D4 FOREIGN KEY (coordonate_id) REFERENCES coordonate (id)');
        $this->addSql('ALTER TABLE casting_offer ADD CONSTRAINT FK_FE44FC799395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE casting_offer ADD CONSTRAINT FK_FE44FC79CD1DF15B FOREIGN KEY (contract_type_id) REFERENCES contract_type (id)');
        $this->addSql('ALTER TABLE casting_offer_job ADD CONSTRAINT FK_D24AC9BAF4D9BD29 FOREIGN KEY (casting_offer_id) REFERENCES casting_offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE casting_offer_job ADD CONSTRAINT FK_D24AC9BABE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customer_packs ADD CONSTRAINT FK_77CB151C9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE customer_packs ADD CONSTRAINT FK_77CB151CDB056BDB FOREIGN KEY (casting_pack_offer_id) REFERENCES casting_pack_offer (id)');
        $this->addSql('ALTER TABLE observer ADD CONSTRAINT FK_9B6F44E7F4D9BD29 FOREIGN KEY (casting_offer_id) REFERENCES casting_offer (id)');
        $this->addSql('ALTER TABLE observer ADD CONSTRAINT FK_9B6F44E7175ED9C0 FOREIGN KEY (broadcast_partner_id) REFERENCES broadcast_partner (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE casting_offer DROP FOREIGN KEY FK_FE44FC795ED4E0D4');
        $this->addSql('ALTER TABLE casting_offer DROP FOREIGN KEY FK_FE44FC799395C3F3');
        $this->addSql('ALTER TABLE casting_offer DROP FOREIGN KEY FK_FE44FC79CD1DF15B');
        $this->addSql('ALTER TABLE casting_offer_job DROP FOREIGN KEY FK_D24AC9BAF4D9BD29');
        $this->addSql('ALTER TABLE casting_offer_job DROP FOREIGN KEY FK_D24AC9BABE04EA9');
        $this->addSql('ALTER TABLE customer_packs DROP FOREIGN KEY FK_77CB151C9395C3F3');
        $this->addSql('ALTER TABLE customer_packs DROP FOREIGN KEY FK_77CB151CDB056BDB');
        $this->addSql('ALTER TABLE observer DROP FOREIGN KEY FK_9B6F44E7F4D9BD29');
        $this->addSql('ALTER TABLE observer DROP FOREIGN KEY FK_9B6F44E7175ED9C0');
        $this->addSql('DROP TABLE broadcast_partner');
        $this->addSql('DROP TABLE casting_number');
        $this->addSql('DROP TABLE casting_offer');
        $this->addSql('DROP TABLE casting_offer_job');
        $this->addSql('DROP TABLE casting_pack_offer');
        $this->addSql('DROP TABLE contract_type');
        $this->addSql('DROP TABLE coordonate');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE customer_packs');
        $this->addSql('DROP TABLE duration');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE job_job_domain');
        $this->addSql('DROP TABLE job_domain');
        $this->addSql('DROP TABLE observer');
    }
}
