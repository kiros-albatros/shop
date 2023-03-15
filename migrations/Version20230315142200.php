<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230315142200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP review_id');
        $this->addSql('ALTER TABLE review ADD author_name VARCHAR(255) NOT NULL, DROP product_id, DROP user_id, CHANGE text content LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE review ADD product_id INT NOT NULL, ADD user_id INT NOT NULL, DROP author_name, CHANGE content text LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE product ADD review_id INT NOT NULL');
    }
}
