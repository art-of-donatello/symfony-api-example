<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220130212347 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E283F8D8F85E0677');
        $this->addSql('DROP INDEX IDX_E283F8D8F85E0677 ON orders');
        $this->addSql('ALTER TABLE orders CHANGE username userid INT NOT NULL');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E283F8D8F132696E FOREIGN KEY (userid) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_E283F8D8F132696E ON orders (userid)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Orders DROP FOREIGN KEY FK_E283F8D8F132696E');
        $this->addSql('DROP INDEX IDX_E283F8D8F132696E ON Orders');
        $this->addSql('ALTER TABLE Orders CHANGE userid username INT NOT NULL');
        $this->addSql('ALTER TABLE Orders ADD CONSTRAINT FK_E283F8D8F85E0677 FOREIGN KEY (username) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_E283F8D8F85E0677 ON Orders (username)');
    }
}
