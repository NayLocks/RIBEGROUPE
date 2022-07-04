<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220629093416 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE steps (id INT IDENTITY NOT NULL, name NVARCHAR(255), color_code NVARCHAR(255), PRIMARY KEY (id))');
        $this->addSql('ALTER TABLE customers_sheets ADD step_id INT');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN step');
        $this->addSql('ALTER TABLE customers_sheets ADD CONSTRAINT FK_1EBA44EA73B21E9C FOREIGN KEY (step_id) REFERENCES steps (id)');
        $this->addSql('CREATE INDEX IDX_1EBA44EA73B21E9C ON customers_sheets (step_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA db_accessadmin');
        $this->addSql('CREATE SCHEMA db_backupoperator');
        $this->addSql('CREATE SCHEMA db_datareader');
        $this->addSql('CREATE SCHEMA db_datawriter');
        $this->addSql('CREATE SCHEMA db_ddladmin');
        $this->addSql('CREATE SCHEMA db_denydatareader');
        $this->addSql('CREATE SCHEMA db_denydatawriter');
        $this->addSql('CREATE SCHEMA db_owner');
        $this->addSql('CREATE SCHEMA db_securityadmin');
        $this->addSql('CREATE SCHEMA dbo');
        $this->addSql('ALTER TABLE customers_sheets DROP CONSTRAINT FK_1EBA44EA73B21E9C');
        $this->addSql('DROP TABLE steps');
        $this->addSql('DROP INDEX IDX_1EBA44EA73B21E9C ON customers_sheets');
        $this->addSql('ALTER TABLE customers_sheets ADD step NVARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN step_id');
    }
}
