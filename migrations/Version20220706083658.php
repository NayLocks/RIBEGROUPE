<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220706083658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customers_sheets ADD commercial_director NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD commercial_master NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD commercial NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD telemarketer NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD taux1 NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD taux2 NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD taux3 NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD nature1 NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD nature2 NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD nature3 NVARCHAR(255)');
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
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN commercial_director');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN commercial_master');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN commercial');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN telemarketer');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN taux1');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN taux2');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN taux3');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN nature1');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN nature2');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN nature3');
    }
}
