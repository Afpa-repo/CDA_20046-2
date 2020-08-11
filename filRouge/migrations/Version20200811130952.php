<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200811130952 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, supplier_id INT DEFAULT NULL, user_id INT DEFAULT NULL, address_type INT NOT NULL, address_country VARCHAR(25) NOT NULL, address_district VARCHAR(50) NOT NULL, address_postal_code VARCHAR(25) NOT NULL, address_city VARCHAR(25) NOT NULL, address_num_street VARCHAR(5) NOT NULL, address_street VARCHAR(25) NOT NULL, address_complement VARCHAR(50) DEFAULT NULL, INDEX IDX_D4E6F812ADD6D8C (supplier_id), INDEX IDX_D4E6F81A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE format (id INT AUTO_INCREMENT NOT NULL, format_name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE material (id INT AUTO_INCREMENT NOT NULL, material_name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, suppliers_id INT DEFAULT NULL, address_id INT DEFAULT NULL, order_date DATE NOT NULL, order_date_shipping DATE DEFAULT NULL, order_type INT NOT NULL, order_shipping_cost INT NOT NULL, INDEX IDX_F5299398A76ED395 (user_id), INDEX IDX_F5299398355AF43 (suppliers_id), INDEX IDX_F5299398F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_detail (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, orders_id INT DEFAULT NULL, orderdetail_unit_price INT NOT NULL, orderdetail_quantity INT NOT NULL, orderdetail_discount INT DEFAULT NULL, orderdetail_tva INT NOT NULL, INDEX IDX_ED896F464584665A (product_id), INDEX IDX_ED896F46CFFE9AD6 (orders_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, picture VARCHAR(255) NOT NULL, extension VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, material_id INT DEFAULT NULL, format_id INT DEFAULT NULL, pro_name VARCHAR(50) NOT NULL, pro_stock_ale INT NOT NULL, pro_unit_price INT NOT NULL, pro_unit_stock_phy INT NOT NULL, pro_unit_on_order INT NOT NULL, pro_discontinued INT NOT NULL, pro_note INT DEFAULT NULL, pro_lib VARCHAR(25) NOT NULL, pro_description VARCHAR(255) NOT NULL, INDEX IDX_D34A04ADE308AC6F (material_id), INDEX IDX_D34A04ADD629F605 (format_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_theme (product_id INT NOT NULL, theme_id INT NOT NULL, INDEX IDX_36299C544584665A (product_id), INDEX IDX_36299C5459027487 (theme_id), PRIMARY KEY(product_id, theme_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, role VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suppliers (id INT AUTO_INCREMENT NOT NULL, suppli_company_name VARCHAR(255) NOT NULL, suppli_mail VARCHAR(255) NOT NULL, suppli_phone VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, theme_name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, user_titre VARCHAR(50) NOT NULL, user_last_name VARCHAR(50) DEFAULT NULL, user_first_name VARCHAR(50) DEFAULT NULL, user_phone VARCHAR(25) NOT NULL, user_birthday DATE NOT NULL, user_gender VARCHAR(15) DEFAULT NULL, user_email VARCHAR(255) NOT NULL, user_password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F812ADD6D8C FOREIGN KEY (supplier_id) REFERENCES suppliers (id)');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398355AF43 FOREIGN KEY (suppliers_id) REFERENCES suppliers (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT FK_ED896F464584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT FK_ED896F46CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADE308AC6F FOREIGN KEY (material_id) REFERENCES material (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADD629F605 FOREIGN KEY (format_id) REFERENCES format (id)');
        $this->addSql('ALTER TABLE product_theme ADD CONSTRAINT FK_36299C544584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_theme ADD CONSTRAINT FK_36299C5459027487 FOREIGN KEY (theme_id) REFERENCES theme (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398F5B7AF75');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADD629F605');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADE308AC6F');
        $this->addSql('ALTER TABLE order_detail DROP FOREIGN KEY FK_ED896F46CFFE9AD6');
        $this->addSql('ALTER TABLE order_detail DROP FOREIGN KEY FK_ED896F464584665A');
        $this->addSql('ALTER TABLE product_theme DROP FOREIGN KEY FK_36299C544584665A');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F812ADD6D8C');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398355AF43');
        $this->addSql('ALTER TABLE product_theme DROP FOREIGN KEY FK_36299C5459027487');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81A76ED395');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE format');
        $this->addSql('DROP TABLE material');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_detail');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_theme');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE suppliers');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE user');
    }
}
