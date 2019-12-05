<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191205141605 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE rental_type (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE house ADD type_id INT DEFAULT NULL, ADD price DOUBLE PRECISION NOT NULL, ADD bed_number INT NOT NULL');
        $this->addSql('ALTER TABLE house ADD CONSTRAINT FK_67D5399DC54C8C93 FOREIGN KEY (type_id) REFERENCES rental_type (id)');
        $this->addSql('CREATE INDEX IDX_67D5399DC54C8C93 ON house (type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE house DROP FOREIGN KEY FK_67D5399DC54C8C93');
        $this->addSql('DROP TABLE rental_type');
        $this->addSql('DROP INDEX IDX_67D5399DC54C8C93 ON house');
        $this->addSql('ALTER TABLE house DROP type_id, DROP price, DROP bed_number');
    }
}
