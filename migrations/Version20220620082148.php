<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220620082148 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE fiche_article');
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
        $this->addSql('CREATE TABLE fiche_article (id INT IDENTITY NOT NULL, company_id INT, username_id INT, etape_fiche NVARCHAR(50) COLLATE French_CI_AS NOT NULL, date DATETIME2(6) NOT NULL, generique NVARCHAR(255) COLLATE French_CI_AS, esp_var NVARCHAR(255) COLLATE French_CI_AS, marque NVARCHAR(255) COLLATE French_CI_AS, origine NVARCHAR(255) COLLATE French_CI_AS, calibre NVARCHAR(255) COLLATE French_CI_AS, conditionnement NVARCHAR(255) COLLATE French_CI_AS, categorie NVARCHAR(255) COLLATE French_CI_AS, grp_article NVARCHAR(255) COLLATE French_CI_AS, nom_latin NVARCHAR(255) COLLATE French_CI_AS, zone_peche NVARCHAR(255) COLLATE French_CI_AS, poids_colis NVARCHAR(255) COLLATE French_CI_AS, poids_colis_variable INT, piece_colis NVARCHAR(255) COLLATE French_CI_AS, piece_colis_variable INT, stat1 NVARCHAR(255) COLLATE French_CI_AS, stat2 NVARCHAR(255) COLLATE French_CI_AS, stat3 NVARCHAR(255) COLLATE French_CI_AS, stat4 NVARCHAR(255) COLLATE French_CI_AS, dlc INT, dlc_jour NVARCHAR(255) COLLATE French_CI_AS, unite_achat NVARCHAR(255) COLLATE French_CI_AS, unite_vente NVARCHAR(255) COLLATE French_CI_AS, unite_stock NVARCHAR(255) COLLATE French_CI_AS, men_val NVARCHAR(255) COLLATE French_CI_AS, localisation NVARCHAR(255) COLLATE French_CI_AS, rup NVARCHAR(255) COLLATE French_CI_AS, siqo NVARCHAR(255) COLLATE French_CI_AS, code_article NVARCHAR(255) COLLATE French_CI_AS, code_sodexo NVARCHAR(255) COLLATE French_CI_AS, code_sxo NVARCHAR(255) COLLATE French_CI_AS, date_created DATETIME2(6) NOT NULL, text_refus NVARCHAR(255) COLLATE French_CI_AS, PRIMARY KEY (id))');
        $this->addSql('CREATE NONCLUSTERED INDEX IDX_1A3B55BC979B1AD6 ON fiche_article (company_id)');
        $this->addSql('CREATE NONCLUSTERED INDEX IDX_1A3B55BCED766068 ON fiche_article (username_id)');
        $this->addSql('ALTER TABLE fiche_article ADD CONSTRAINT FK_1A3B55BC979B1AD6 FOREIGN KEY (company_id) REFERENCES companies (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE fiche_article ADD CONSTRAINT FK_1A3B55BCED766068 FOREIGN KEY (username_id) REFERENCES [user] (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
