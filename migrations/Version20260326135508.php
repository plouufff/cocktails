<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260326135508 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add slug to ingredient';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE ingredient ADD slug VARCHAR(255)');
        $this->addSql('UPDATE ingredient SET slug = name');
        $this->addSql('ALTER TABLE ingredient ALTER COLUMN slug SET NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6BAF7870989D9B62 ON ingredient (slug)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX UNIQ_6BAF7870989D9B62');
        $this->addSql('ALTER TABLE ingredient DROP slug');
    }
}
