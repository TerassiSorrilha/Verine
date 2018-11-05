<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181105154848 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mssql', 'Migration can only be executed safely on \'mssql\'.');

        $this->addSql('CREATE TABLE market (id INT IDENTITY NOT NULL, jogador_id INT, preco_venda DOUBLE PRECISION NOT NULL, data DATETIME2(6) NOT NULL, is_active BIT NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_6BAC85CB814B85AC ON market (jogador_id)');
        $this->addSql('ALTER TABLE market ADD CONSTRAINT FK_6BAC85CB814B85AC FOREIGN KEY (jogador_id) REFERENCES pessoa (id)');
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
        $this->addSql('DROP TABLE market');
        $this->addSql('ALTER TABLE todocartoes ALTER COLUMN posicao INT NOT NULL');
        $this->addSql('ALTER TABLE todocartoes ADD CONSTRAINT DF_81609045_9B80C31A DEFAULT 1 FOR posicao');
        $this->addSql('ALTER TABLE todocartoes ALTER COLUMN is_active BIT NOT NULL');
        $this->addSql('ALTER TABLE todocartoes ADD CONSTRAINT DF_81609045_1B5771DD DEFAULT \'0\' FOR is_active');
        $this->addSql('ALTER TABLE todolistas ALTER COLUMN posicao INT NOT NULL');
        $this->addSql('ALTER TABLE todolistas ADD CONSTRAINT DF_C221FE2F_9B80C31A DEFAULT 1 FOR posicao');
    }
}
