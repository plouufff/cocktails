<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260227090807 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'New recipe_steps field on cocktail table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE cocktail ADD recipe_steps JSON NOT NULL');
        $this->addSql('ALTER TABLE cocktail DROP recipe');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE cocktail ADD recipe TEXT NOT NULL');
        $this->addSql('ALTER TABLE cocktail DROP recipe_steps');
    }
}
