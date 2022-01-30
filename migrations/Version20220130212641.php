<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220130212641 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E283F8D8F132696E');
        $this->addSql('DROP INDEX IDX_E283F8D8F132696E ON orders');
        $this->addSql('ALTER TABLE orders DROP userid');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Orders ADD userid INT NOT NULL');
        $this->addSql('ALTER TABLE Orders ADD CONSTRAINT FK_E283F8D8F132696E FOREIGN KEY (userid) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_E283F8D8F132696E ON Orders (userid)');
    }
}
