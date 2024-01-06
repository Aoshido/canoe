<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240106225702 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fund (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, manager_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, start_year DATE NOT NULL, CONSTRAINT FK_DC923E10783E3463 FOREIGN KEY (manager_id) REFERENCES manager (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_DC923E10783E3463 ON fund (manager_id)');
        $this->addSql('CREATE TABLE manager (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE fund');
        $this->addSql('DROP TABLE manager');
    }
}
