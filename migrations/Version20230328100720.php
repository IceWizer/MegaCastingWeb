<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230328100720 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX `primary` ON job_job_domain');
        $this->addSql('ALTER TABLE job_job_domain ADD job_id INT NOT NULL');
        $this->addSql('ALTER TABLE job_job_domain ADD CONSTRAINT FK_9DDAA397BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE job_job_domain ADD CONSTRAINT FK_9DDAA397D6EFE1F4 FOREIGN KEY (job_domain_id) REFERENCES job_domain (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_9DDAA397BE04EA9 ON job_job_domain (job_id)');
        $this->addSql('CREATE INDEX IDX_9DDAA397D6EFE1F4 ON job_job_domain (job_domain_id)');
        $this->addSql('ALTER TABLE job_job_domain ADD PRIMARY KEY (job_id, job_domain_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job_job_domain DROP FOREIGN KEY FK_9DDAA397BE04EA9');
        $this->addSql('ALTER TABLE job_job_domain DROP FOREIGN KEY FK_9DDAA397D6EFE1F4');
        $this->addSql('DROP INDEX IDX_9DDAA397BE04EA9 ON job_job_domain');
        $this->addSql('DROP INDEX IDX_9DDAA397D6EFE1F4 ON job_job_domain');
        $this->addSql('DROP INDEX `PRIMARY` ON job_job_domain');
        $this->addSql('ALTER TABLE job_job_domain DROP job_id');
        $this->addSql('ALTER TABLE job_job_domain ADD PRIMARY KEY (job_domain_id)');
    }
}
