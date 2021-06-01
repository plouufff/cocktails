<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210601190035 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Make entities timestampable';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE cocktail_ingredient ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE cocktail_ingredient ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE ingredient ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE ingredient ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE ingredient_category ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE ingredient_category ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE cocktail_ingredient DROP created_at');
        $this->addSql('ALTER TABLE cocktail_ingredient DROP updated_at');
        $this->addSql('ALTER TABLE ingredient DROP created_at');
        $this->addSql('ALTER TABLE ingredient DROP updated_at');
        $this->addSql('ALTER TABLE ingredient_category DROP created_at');
        $this->addSql('ALTER TABLE ingredient_category DROP updated_at');
    }
}
