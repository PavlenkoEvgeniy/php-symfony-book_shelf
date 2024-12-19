<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241219182355 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create table author, book, publisher and relations between';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE author (
            id INT AUTO_INCREMENT NOT NULL, 
            family_name VARCHAR(255) NOT NULL, 
            firts_name VARCHAR(255) NOT NULL, 
            is_enabled TINYINT(1) DEFAULT 1 NOT NULL, 
            created_at DATETIME NOT NULL, 
            updated_at DATETIME NOT NULL, 
            deleted_at DATETIME DEFAULT NULL, 
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE author_book (
            author_id INT NOT NULL, book_id INT NOT NULL, 
            INDEX IDX_2F0A2BEEF675F31B (author_id), 
            INDEX IDX_2F0A2BEE16A2B381 (book_id), 
            PRIMARY KEY(author_id, book_id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE book (
            id INT AUTO_INCREMENT NOT NULL, 
            publisher_id INT DEFAULT NULL, 
            title VARCHAR(255) NOT NULL, 
            description VARCHAR(255) NOT NULL, 
            content LONGTEXT NOT NULL, 
            is_published TINYINT(1) DEFAULT 1 NOT NULL, 
            created_at DATETIME NOT NULL, 
            updated_at DATETIME NOT NULL, 
            deleted_at DATETIME DEFAULT NULL, 
            INDEX IDX_CBE5A33140C86FCE (publisher_id), 
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE publisher (
            id INT AUTO_INCREMENT NOT NULL, 
            title VARCHAR(255) NOT NULL, 
            address VARCHAR(255) NOT NULL, 
            created_at DATETIME NOT NULL, 
            updated_at DATETIME NOT NULL, 
            deleted_at DATETIME DEFAULT NULL, 
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('ALTER TABLE author_book 
            ADD CONSTRAINT FK_2F0A2BEEF675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON DELETE CASCADE');

        $this->addSql('ALTER TABLE author_book 
            ADD CONSTRAINT FK_2F0A2BEE16A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');

        $this->addSql('ALTER TABLE book 
            ADD CONSTRAINT FK_CBE5A33140C86FCE FOREIGN KEY (publisher_id) REFERENCES publisher (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE author_book DROP FOREIGN KEY FK_2F0A2BEEF675F31B');
        $this->addSql('ALTER TABLE author_book DROP FOREIGN KEY FK_2F0A2BEE16A2B381');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A33140C86FCE');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE author_book');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE publisher');
    }
}
