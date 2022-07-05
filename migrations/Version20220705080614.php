<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220705080614 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customers_sheets ADD pay_advanced INT');
        $this->addSql('ALTER TABLE customers_sheets ADD pay_bank_check INT');
        $this->addSql('ALTER TABLE customers_sheets ADD pay_payment INT');
        $this->addSql('ALTER TABLE customers_sheets ADD pay_sampling INT');
        $this->addSql('ALTER TABLE customers_sheets ADD ext_kbis NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD ext_cgv NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD ext_authprev NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD ext_rib NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD ext_orther_docu NVARCHAR(255)');
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
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN pay_advanced');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN pay_bank_check');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN pay_payment');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN pay_sampling');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN ext_kbis');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN ext_cgv');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN ext_authprev');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN ext_rib');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN ext_orther_docu');
    }
}
