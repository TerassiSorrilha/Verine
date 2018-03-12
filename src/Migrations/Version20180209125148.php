<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180209125148 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66DB38439E');
        $this->addSql('CREATE TABLE usuarios (id INT AUTO_INCREMENT NOT NULL, nivel INT NOT NULL, name VARCHAR(255) NOT NULL, login VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66DB38439E');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66DB38439E FOREIGN KEY (usuario_id) REFERENCES usuarios (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66DB38439E');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, nivel INT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, login VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, email VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, password VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE usuarios');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66DB38439E');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
    }
}
