<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180831163950 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mssql', 'Migration can only be executed safely on \'mssql\'.');

        $this->addSql('CREATE TABLE symfony_demo_post (id INT IDENTITY NOT NULL, author_id INT NOT NULL, title NVARCHAR(255) NOT NULL, subtitle NVARCHAR(255) NOT NULL, slug NVARCHAR(255) NOT NULL, summary NVARCHAR(255) NOT NULL, content VARCHAR(MAX) NOT NULL, is_active BIT NOT NULL, published_at DATETIME NOT NULL, expired_at DATETIME NOT NULL, insert_at DATETIME NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_58A92E65F675F31B ON symfony_demo_post (author_id)');
        $this->addSql('CREATE TABLE symfony_demo_post_tag (post_id INT NOT NULL, tag_id INT NOT NULL, PRIMARY KEY (post_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_6ABC1CC44B89032C ON symfony_demo_post_tag (post_id)');
        $this->addSql('CREATE INDEX IDX_6ABC1CC4BAD26311 ON symfony_demo_post_tag (tag_id)');
        $this->addSql('CREATE TABLE symfony_demo_comment (id INT IDENTITY NOT NULL, post_id INT NOT NULL, author_id INT NOT NULL, content VARCHAR(MAX) NOT NULL, published_at DATETIME NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_53AD8F834B89032C ON symfony_demo_comment (post_id)');
        $this->addSql('CREATE INDEX IDX_53AD8F83F675F31B ON symfony_demo_comment (author_id)');
        $this->addSql('CREATE TABLE niveis (id INT IDENTITY NOT NULL, name NVARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE symfony_demo_tag (id INT IDENTITY NOT NULL, name NVARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4D5855405E237E06 ON symfony_demo_tag (name) WHERE name IS NOT NULL');
        $this->addSql('CREATE TABLE todocartoes (id INT IDENTITY NOT NULL, listas_id INT, descricao NVARCHAR(255) NOT NULL, nome NVARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_816090459A111542 ON todocartoes (listas_id)');
        $this->addSql('CREATE TABLE todolistas (id INT IDENTITY NOT NULL, quadros_id INT, nome NVARCHAR(255) NOT NULL, is_active BIT NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_C221FE2F9E8F979F ON todolistas (quadros_id)');
        $this->addSql('CREATE TABLE todoquadros (id INT IDENTITY NOT NULL, usuario_id INT, nome NVARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_702E3F4BDB38439E ON todoquadros (usuario_id)');
        $this->addSql('CREATE TABLE usuarios (id INT IDENTITY NOT NULL, nivel_id INT, name NVARCHAR(255) NOT NULL, username NVARCHAR(255) NOT NULL, email NVARCHAR(255) NOT NULL, password NVARCHAR(255) NOT NULL, is_active BIT NOT NULL, roles VARCHAR(MAX) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_EF687F2DA3426AE ON usuarios (nivel_id)');
        $this->addSql('EXEC sp_addextendedproperty N\'MS_Description\', N\'(DC2Type:json)\', N\'SCHEMA\', dbo, N\'TABLE\', usuarios, N\'COLUMN\', roles');
        $this->addSql('ALTER TABLE symfony_demo_post ADD CONSTRAINT FK_58A92E65F675F31B FOREIGN KEY (author_id) REFERENCES usuarios (id)');
        $this->addSql('ALTER TABLE symfony_demo_post_tag ADD CONSTRAINT FK_6ABC1CC44B89032C FOREIGN KEY (post_id) REFERENCES symfony_demo_post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE symfony_demo_post_tag ADD CONSTRAINT FK_6ABC1CC4BAD26311 FOREIGN KEY (tag_id) REFERENCES symfony_demo_tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE symfony_demo_comment ADD CONSTRAINT FK_53AD8F834B89032C FOREIGN KEY (post_id) REFERENCES symfony_demo_post (id)');
        $this->addSql('ALTER TABLE symfony_demo_comment ADD CONSTRAINT FK_53AD8F83F675F31B FOREIGN KEY (author_id) REFERENCES usuarios (id)');
        $this->addSql('ALTER TABLE todocartoes ADD CONSTRAINT FK_816090459A111542 FOREIGN KEY (listas_id) REFERENCES todolistas (id)');
        $this->addSql('ALTER TABLE todolistas ADD CONSTRAINT FK_C221FE2F9E8F979F FOREIGN KEY (quadros_id) REFERENCES todoquadros (id)');
        $this->addSql('ALTER TABLE todoquadros ADD CONSTRAINT FK_702E3F4BDB38439E FOREIGN KEY (usuario_id) REFERENCES usuarios (id)');
        $this->addSql('ALTER TABLE usuarios ADD CONSTRAINT FK_EF687F2DA3426AE FOREIGN KEY (nivel_id) REFERENCES niveis (id)');
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
        $this->addSql('ALTER TABLE symfony_demo_post_tag DROP CONSTRAINT FK_6ABC1CC44B89032C');
        $this->addSql('ALTER TABLE symfony_demo_comment DROP CONSTRAINT FK_53AD8F834B89032C');
        $this->addSql('ALTER TABLE usuarios DROP CONSTRAINT FK_EF687F2DA3426AE');
        $this->addSql('ALTER TABLE symfony_demo_post_tag DROP CONSTRAINT FK_6ABC1CC4BAD26311');
        $this->addSql('ALTER TABLE todocartoes DROP CONSTRAINT FK_816090459A111542');
        $this->addSql('ALTER TABLE todolistas DROP CONSTRAINT FK_C221FE2F9E8F979F');
        $this->addSql('ALTER TABLE symfony_demo_post DROP CONSTRAINT FK_58A92E65F675F31B');
        $this->addSql('ALTER TABLE symfony_demo_comment DROP CONSTRAINT FK_53AD8F83F675F31B');
        $this->addSql('ALTER TABLE todoquadros DROP CONSTRAINT FK_702E3F4BDB38439E');
        $this->addSql('DROP TABLE symfony_demo_post');
        $this->addSql('DROP TABLE symfony_demo_post_tag');
        $this->addSql('DROP TABLE symfony_demo_comment');
        $this->addSql('DROP TABLE niveis');
        $this->addSql('DROP TABLE symfony_demo_tag');
        $this->addSql('DROP TABLE todocartoes');
        $this->addSql('DROP TABLE todolistas');
        $this->addSql('DROP TABLE todoquadros');
        $this->addSql('DROP TABLE usuarios');
    }
}
