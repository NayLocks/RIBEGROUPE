<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220527085251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE items_sheets ADD company_id INT');
        $this->addSql('ALTER TABLE items_sheets ADD username_id INT');
        $this->addSql('ALTER TABLE items_sheets ADD CONSTRAINT FK_93AC600979B1AD6 FOREIGN KEY (company_id) REFERENCES companies (id)');
        $this->addSql('ALTER TABLE items_sheets ADD CONSTRAINT FK_93AC600ED766068 FOREIGN KEY (username_id) REFERENCES [user] (id)');
        $this->addSql('CREATE INDEX IDX_93AC600979B1AD6 ON items_sheets (company_id)');
        $this->addSql('CREATE INDEX IDX_93AC600ED766068 ON items_sheets (username_id)');
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
        $this->addSql('ALTER TABLE items_sheets DROP CONSTRAINT FK_93AC600979B1AD6');
        $this->addSql('ALTER TABLE items_sheets DROP CONSTRAINT FK_93AC600ED766068');
        $this->addSql('DROP INDEX IDX_93AC600979B1AD6 ON items_sheets');
        $this->addSql('DROP INDEX IDX_93AC600ED766068 ON items_sheets');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN company_id');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN username_id');
    }
}
