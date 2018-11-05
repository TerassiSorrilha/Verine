<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181105155446 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mssql', 'Migration can only be executed safely on \'mssql\'.');

        $this->addSql('ALTER TABLE todocartoes DROP CONSTRAINT DF_81609045_9B80C31A');
        $this->addSql('ALTER TABLE todocartoes ALTER COLUMN posicao INT NOT NULL');
        $this->addSql('ALTER TABLE todocartoes DROP CONSTRAINT DF_81609045_1B5771DD');
        $this->addSql('ALTER TABLE todocartoes ALTER COLUMN is_active BIT NOT NULL');
        $this->addSql('ALTER TABLE todolistas DROP CONSTRAINT DF_C221FE2F_9B80C31A');
        $this->addSql('ALTER TABLE todolistas ALTER COLUMN posicao INT NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mssql', 'Migration can only be executed safely on \'mssql\'.');

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
        $this->addSql('ALTER TABLE todocartoes ALTER COLUMN posicao INT NOT NULL');
        $this->addSql('ALTER TABLE todocartoes ADD CONSTRAINT DF_81609045_9B80C31A DEFAULT 1 FOR posicao');
        $this->addSql('ALTER TABLE todocartoes ALTER COLUMN is_active BIT NOT NULL');
        $this->addSql('ALTER TABLE todocartoes ADD CONSTRAINT DF_81609045_1B5771DD DEFAULT \'0\' FOR is_active');
        $this->addSql('ALTER TABLE todolistas ALTER COLUMN posicao INT NOT NULL');
        $this->addSql('ALTER TABLE todolistas ADD CONSTRAINT DF_C221FE2F_9B80C31A DEFAULT 1 FOR posicao');
    }
}
