<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240108052250 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fund ADD duplicate_fund_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fund ADD CONSTRAINT FK_DC923E1056265CF9 FOREIGN KEY (duplicate_fund_id) REFERENCES fund (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_DC923E1056265CF9 ON fund (duplicate_fund_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE fund DROP CONSTRAINT FK_DC923E1056265CF9');
        $this->addSql('DROP INDEX IDX_DC923E1056265CF9');
        $this->addSql('ALTER TABLE fund DROP duplicate_fund_id');
    }
}
