<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220130210946 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E283F8D892E700E1');
        $this->addSql('DROP INDEX IDX_E283F8D892E700E1 ON orders');
        $this->addSql('ALTER TABLE orders CHANGE order_codee username INT NOT NULL');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E283F8D8F85E0677 FOREIGN KEY (username) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_E283F8D8F85E0677 ON orders (username)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Orders DROP FOREIGN KEY FK_E283F8D8F85E0677');
        $this->addSql('DROP INDEX IDX_E283F8D8F85E0677 ON Orders');
        $this->addSql('ALTER TABLE Orders CHANGE username order_codee INT NOT NULL');
        $this->addSql('ALTER TABLE Orders ADD CONSTRAINT FK_E283F8D892E700E1 FOREIGN KEY (order_codee) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_E283F8D892E700E1 ON Orders (order_codee)');
    }
}
