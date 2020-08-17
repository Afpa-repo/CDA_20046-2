<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200817135419 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE suppliers ADD picture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE suppliers ADD CONSTRAINT FK_AC28B95CEE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id)');
        $this->addSql('CREATE INDEX IDX_AC28B95CEE45BDBF ON suppliers (picture_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE suppliers DROP FOREIGN KEY FK_AC28B95CEE45BDBF');
        $this->addSql('DROP INDEX IDX_AC28B95CEE45BDBF ON suppliers');
        $this->addSql('ALTER TABLE suppliers DROP picture_id');
    }
}
