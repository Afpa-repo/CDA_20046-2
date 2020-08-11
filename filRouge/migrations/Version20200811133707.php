<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200811133707 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture ADD user_id INT DEFAULT NULL, ADD product_id INT DEFAULT NULL, ADD suppliers_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F894584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89355AF43 FOREIGN KEY (suppliers_id) REFERENCES suppliers (id)');
        $this->addSql('CREATE INDEX IDX_16DB4F89A76ED395 ON picture (user_id)');
        $this->addSql('CREATE INDEX IDX_16DB4F894584665A ON picture (product_id)');
        $this->addSql('CREATE INDEX IDX_16DB4F89355AF43 ON picture (suppliers_id)');
        $this->addSql('ALTER TABLE user ADD role_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649D60322AC ON user (role_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89A76ED395');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F894584665A');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89355AF43');
        $this->addSql('DROP INDEX IDX_16DB4F89A76ED395 ON picture');
        $this->addSql('DROP INDEX IDX_16DB4F894584665A ON picture');
        $this->addSql('DROP INDEX IDX_16DB4F89355AF43 ON picture');
        $this->addSql('ALTER TABLE picture DROP user_id, DROP product_id, DROP suppliers_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D60322AC');
        $this->addSql('DROP INDEX IDX_8D93D649D60322AC ON user');
        $this->addSql('ALTER TABLE user DROP role_id');
    }
}
