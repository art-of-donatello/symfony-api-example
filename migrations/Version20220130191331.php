<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220130191331 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders CHANGE product_id product_id VARCHAR(255) NOT NULL, CHANGE adress adress VARCHAR(255) DEFAULT NULL, CHANGE shipping_date shipping_date VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E283F8D85CECC7BE ON orders (adress)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E283F8D83B22A178 ON orders (shipping_date)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_E283F8D85CECC7BE ON Orders');
        $this->addSql('DROP INDEX UNIQ_E283F8D83B22A178 ON Orders');
        $this->addSql('ALTER TABLE Orders CHANGE product_id product_id INT NOT NULL, CHANGE adress adress VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE shipping_date shipping_date VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
