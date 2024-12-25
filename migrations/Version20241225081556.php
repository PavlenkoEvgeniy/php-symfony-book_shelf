<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241225081556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE author_book DROP FOREIGN KEY FK_2F0A2BEE16A2B381');
        $this->addSql('DROP INDEX `primary` ON author_book');
        $this->addSql('ALTER TABLE author_book ADD CONSTRAINT FK_2F0A2BEE16A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE author_book ADD PRIMARY KEY (author_id, book_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE author_book DROP FOREIGN KEY FK_2F0A2BEE16A2B381');
        $this->addSql('DROP INDEX `PRIMARY` ON author_book');
        $this->addSql('ALTER TABLE author_book ADD CONSTRAINT FK_2F0A2BEE16A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE author_book ADD PRIMARY KEY (book_id, author_id)');
    }
}
