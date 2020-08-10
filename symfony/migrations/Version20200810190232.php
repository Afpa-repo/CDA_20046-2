<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200810190232 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pictures (id INT AUTO_INCREMENT NOT NULL, picture VARCHAR(255) NOT NULL, extension VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme_products (theme_id INT NOT NULL, products_id INT NOT NULL, INDEX IDX_1184482D59027487 (theme_id), INDEX IDX_1184482D6C8A81A9 (products_id), PRIMARY KEY(theme_id, products_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE theme_products ADD CONSTRAINT FK_1184482D59027487 FOREIGN KEY (theme_id) REFERENCES theme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE theme_products ADD CONSTRAINT FK_1184482D6C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE products_format');
        $this->addSql('DROP TABLE products_material');
        $this->addSql('DROP TABLE products_theme');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939817E8A46A');
        $this->addSql('DROP INDEX IDX_F529939817E8A46A ON `order`');
        $this->addSql('ALTER TABLE `order` ADD user_id INT NOT NULL, DROP orderdetail_id');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F5299398A76ED395 ON `order` (user_id)');
        $this->addSql('ALTER TABLE orders_details ADD orders_id INT NOT NULL, ADD product_id INT NOT NULL');
        $this->addSql('ALTER TABLE orders_details ADD CONSTRAINT FK_835379F1CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE orders_details ADD CONSTRAINT FK_835379F14584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('CREATE INDEX IDX_835379F1CFFE9AD6 ON orders_details (orders_id)');
        $this->addSql('CREATE INDEX IDX_835379F14584665A ON orders_details (product_id)');
        $this->addSql('ALTER TABLE products ADD material_id INT DEFAULT NULL, ADD format_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5AE308AC6F FOREIGN KEY (material_id) REFERENCES material (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5AD629F605 FOREIGN KEY (format_id) REFERENCES format (id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5AE308AC6F ON products (material_id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5AD629F605 ON products (format_id)');
        $this->addSql('ALTER TABLE user ADD password VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE products_format (products_id INT NOT NULL, format_id INT NOT NULL, INDEX IDX_5889F9F5D629F605 (format_id), INDEX IDX_5889F9F56C8A81A9 (products_id), PRIMARY KEY(products_id, format_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE products_material (products_id INT NOT NULL, material_id INT NOT NULL, INDEX IDX_69BF6526E308AC6F (material_id), INDEX IDX_69BF65266C8A81A9 (products_id), PRIMARY KEY(products_id, material_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE products_theme (products_id INT NOT NULL, theme_id INT NOT NULL, INDEX IDX_772C19D859027487 (theme_id), INDEX IDX_772C19D86C8A81A9 (products_id), PRIMARY KEY(products_id, theme_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE products_format ADD CONSTRAINT FK_5889F9F56C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE products_format ADD CONSTRAINT FK_5889F9F5D629F605 FOREIGN KEY (format_id) REFERENCES format (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE products_material ADD CONSTRAINT FK_69BF65266C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE products_material ADD CONSTRAINT FK_69BF6526E308AC6F FOREIGN KEY (material_id) REFERENCES material (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE products_theme ADD CONSTRAINT FK_772C19D859027487 FOREIGN KEY (theme_id) REFERENCES theme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE products_theme ADD CONSTRAINT FK_772C19D86C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE pictures');
        $this->addSql('DROP TABLE theme_products');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('DROP INDEX IDX_F5299398A76ED395 ON `order`');
        $this->addSql('ALTER TABLE `order` ADD orderdetail_id INT DEFAULT NULL, DROP user_id');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939817E8A46A FOREIGN KEY (orderdetail_id) REFERENCES orders_details (id)');
        $this->addSql('CREATE INDEX IDX_F529939817E8A46A ON `order` (orderdetail_id)');
        $this->addSql('ALTER TABLE orders_details DROP FOREIGN KEY FK_835379F1CFFE9AD6');
        $this->addSql('ALTER TABLE orders_details DROP FOREIGN KEY FK_835379F14584665A');
        $this->addSql('DROP INDEX IDX_835379F1CFFE9AD6 ON orders_details');
        $this->addSql('DROP INDEX IDX_835379F14584665A ON orders_details');
        $this->addSql('ALTER TABLE orders_details DROP orders_id, DROP product_id');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5AE308AC6F');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5AD629F605');
        $this->addSql('DROP INDEX IDX_B3BA5A5AE308AC6F ON products');
        $this->addSql('DROP INDEX IDX_B3BA5A5AD629F605 ON products');
        $this->addSql('ALTER TABLE products DROP material_id, DROP format_id');
        $this->addSql('ALTER TABLE user DROP password, DROP email');
    }
}
