<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200819144922 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE material ADD supplier_id INT NOT NULL');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE75952ADD6D8C FOREIGN KEY (supplier_id) REFERENCES suppliers (id)');
        $this->addSql('CREATE INDEX IDX_7CBE75952ADD6D8C ON material (supplier_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE material DROP FOREIGN KEY FK_7CBE75952ADD6D8C');
        $this->addSql('DROP INDEX IDX_7CBE75952ADD6D8C ON material');
        $this->addSql('ALTER TABLE material DROP supplier_id');
    }
}
