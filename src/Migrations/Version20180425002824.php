<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180425002824 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, image INT NOT NULL, name VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, datepost DATETIME NOT NULL, datecreation DATETIME NOT NULL, INDEX IDX_23A0E66DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveis (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, autor INT DEFAULT NULL, categoria INT NOT NULL, texto LONGTEXT NOT NULL, titulo VARCHAR(255) NOT NULL, subtitulo VARCHAR(255) NOT NULL, INDEX IDX_5A8A6C8D31075EBA (autor), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuarios (id INT AUTO_INCREMENT NOT NULL, nivel_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, login VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, INDEX IDX_EF687F2DA3426AE (nivel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66DB38439E FOREIGN KEY (usuario_id) REFERENCES usuarios (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D31075EBA FOREIGN KEY (autor) REFERENCES post (id)');
        $this->addSql('ALTER TABLE usuarios ADD CONSTRAINT FK_EF687F2DA3426AE FOREIGN KEY (nivel_id) REFERENCES niveis (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE usuarios DROP FOREIGN KEY FK_EF687F2DA3426AE');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D31075EBA');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66DB38439E');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE niveis');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE usuarios');
    }
}
