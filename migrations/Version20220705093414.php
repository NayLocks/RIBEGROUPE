<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220705093414 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customers_sheets ADD ct_dir_name NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD ct_dir_phone NVARCHAR(30)');
        $this->addSql('ALTER TABLE customers_sheets ADD ct_dir_mail NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD ct_compta_name NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD ct_compta_phone NVARCHAR(30)');
        $this->addSql('ALTER TABLE customers_sheets ADD ct_compta_mail NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD ct_com_name NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD ct_com_phone NVARCHAR(30)');
        $this->addSql('ALTER TABLE customers_sheets ADD ct_com_mail NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD ct_qua_name NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD ct_qua_phone NVARCHAR(30)');
        $this->addSql('ALTER TABLE customers_sheets ADD ct_qua_mail NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD ct_sec_name NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD ct_sec_phone NVARCHAR(30)');
        $this->addSql('ALTER TABLE customers_sheets ADD ct_sec_mail NVARCHAR(255)');
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
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN ct_dir_name');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN ct_dir_phone');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN ct_dir_mail');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN ct_compta_name');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN ct_compta_phone');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN ct_compta_mail');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN ct_com_name');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN ct_com_phone');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN ct_com_mail');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN ct_qua_name');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN ct_qua_phone');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN ct_qua_mail');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN ct_sec_name');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN ct_sec_phone');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN ct_sec_mail');
    }
}
