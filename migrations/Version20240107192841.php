<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240107192841 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE fund_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE manager_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE fund (id INT NOT NULL, manager_id INT NOT NULL, name VARCHAR(255) NOT NULL, start_year DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DC923E10783E3463 ON fund (manager_id)');
        $this->addSql('CREATE TABLE manager (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE fund ADD CONSTRAINT FK_DC923E10783E3463 FOREIGN KEY (manager_id) REFERENCES manager (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE fund_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE manager_id_seq CASCADE');
        $this->addSql('ALTER TABLE fund DROP CONSTRAINT FK_DC923E10783E3463');
        $this->addSql('DROP TABLE fund');
        $this->addSql('DROP TABLE manager');
    }
}
