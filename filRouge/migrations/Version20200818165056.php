<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200818165056 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock ADD product_detail_id INT NOT NULL');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660B670B536 FOREIGN KEY (product_detail_id) REFERENCES product_detail (id)');
        $this->addSql('CREATE INDEX IDX_4B365660B670B536 ON stock (product_detail_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660B670B536');
        $this->addSql('DROP INDEX IDX_4B365660B670B536 ON stock');
        $this->addSql('ALTER TABLE stock DROP product_detail_id');
    }
}
