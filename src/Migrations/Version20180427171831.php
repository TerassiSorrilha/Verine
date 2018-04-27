<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180427171831 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE todocartoes (id INT AUTO_INCREMENT NOT NULL, listas_id INT DEFAULT NULL, descricao VARCHAR(255) NOT NULL, nome VARCHAR(255) NOT NULL, INDEX IDX_816090459A111542 (listas_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE todolistas (id INT AUTO_INCREMENT NOT NULL, quadros_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_C221FE2F9E8F979F (quadros_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE todocartoes ADD CONSTRAINT FK_816090459A111542 FOREIGN KEY (listas_id) REFERENCES todolistas (id)');
        $this->addSql('ALTER TABLE todolistas ADD CONSTRAINT FK_C221FE2F9E8F979F FOREIGN KEY (quadros_id) REFERENCES todoquadros (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE todocartoes DROP FOREIGN KEY FK_816090459A111542');
        $this->addSql('DROP TABLE todocartoes');
        $this->addSql('DROP TABLE todolistas');
    }
}
