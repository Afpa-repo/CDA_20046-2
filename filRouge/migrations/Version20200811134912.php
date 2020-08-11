<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200811134912 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89355AF43');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F894584665A');
        $this->addSql('DROP INDEX IDX_16DB4F894584665A ON picture');
        $this->addSql('DROP INDEX IDX_16DB4F89355AF43 ON picture');
        $this->addSql('ALTER TABLE picture DROP product_id, DROP suppliers_id');
        $this->addSql('ALTER TABLE product ADD picture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADEE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADEE45BDBF ON product (picture_id)');
        $this->addSql('ALTER TABLE suppliers ADD picture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE suppliers ADD CONSTRAINT FK_AC28B95CEE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id)');
        $this->addSql('CREATE INDEX IDX_AC28B95CEE45BDBF ON suppliers (picture_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture ADD product_id INT DEFAULT NULL, ADD suppliers_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89355AF43 FOREIGN KEY (suppliers_id) REFERENCES suppliers (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F894584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_16DB4F894584665A ON picture (product_id)');
        $this->addSql('CREATE INDEX IDX_16DB4F89355AF43 ON picture (suppliers_id)');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADEE45BDBF');
        $this->addSql('DROP INDEX IDX_D34A04ADEE45BDBF ON product');
        $this->addSql('ALTER TABLE product DROP picture_id');
        $this->addSql('ALTER TABLE suppliers DROP FOREIGN KEY FK_AC28B95CEE45BDBF');
        $this->addSql('DROP INDEX IDX_AC28B95CEE45BDBF ON suppliers');
        $this->addSql('ALTER TABLE suppliers DROP picture_id');
    }
}
