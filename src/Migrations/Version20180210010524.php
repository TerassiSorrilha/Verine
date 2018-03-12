<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180210010524 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE niveis (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66DB38439E FOREIGN KEY (usuario_id) REFERENCES usuarios (id)');
        $this->addSql('ALTER TABLE usuarios ADD nivel_id INT DEFAULT NULL, DROP nivel');
        $this->addSql('ALTER TABLE usuarios ADD CONSTRAINT FK_EF687F2DA3426AE FOREIGN KEY (nivel_id) REFERENCES niveis (id)');
        $this->addSql('CREATE INDEX IDX_EF687F2DA3426AE ON usuarios (nivel_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE usuarios DROP FOREIGN KEY FK_EF687F2DA3426AE');
        $this->addSql('DROP TABLE niveis');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66DB38439E');
        $this->addSql('DROP INDEX IDX_EF687F2DA3426AE ON usuarios');
        $this->addSql('ALTER TABLE usuarios ADD nivel INT NOT NULL, DROP nivel_id');
    }
}
