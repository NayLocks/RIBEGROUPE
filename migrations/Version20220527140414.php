<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220527140414 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE items_sheets ADD date_created DATETIME2(6)');
        $this->addSql('ALTER TABLE items_sheets ADD date_last_change DATETIME2(6)');
        $this->addSql('ALTER TABLE items_sheets ADD date_receipt DATETIME2(6)');
        $this->addSql('ALTER TABLE items_sheets ADD date_validation DATETIME2(6)');
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
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN date_created');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN date_last_change');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN date_receipt');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN date_validation');
    }
}
