<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220527090556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE items_sheets ADD brand NVARCHAR(255)');
        $this->addSql('ALTER TABLE items_sheets ADD origin NVARCHAR(255)');
        $this->addSql('ALTER TABLE items_sheets ADD diameter NVARCHAR(255)');
        $this->addSql('ALTER TABLE items_sheets ADD packaging NVARCHAR(255)');
        $this->addSql('ALTER TABLE items_sheets ADD category NVARCHAR(255)');
        $this->addSql('ALTER TABLE items_sheets ADD group_item NVARCHAR(10)');
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
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN brand');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN origin');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN diameter');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN packaging');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN category');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN group_item');
    }
}
