<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220130191511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_E283F8D83B22A178 ON orders');
        $this->addSql('DROP INDEX UNIQ_E283F8D85CECC7BE ON orders');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E283F8D83AE40A8F ON orders (order_code)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_E283F8D83AE40A8F ON Orders');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E283F8D83B22A178 ON Orders (shipping_date)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E283F8D85CECC7BE ON Orders (adress)');
    }
}
