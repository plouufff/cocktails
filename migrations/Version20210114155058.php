<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210114155058 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Initialize database';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE cocktail (id BIGINT GENERATED ALWAYS AS IDENTITY, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, recipe TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7B4914D4989D9B62 ON cocktail (slug)');
        $this->addSql('CREATE TABLE cocktail_ingredient (id BIGINT GENERATED ALWAYS AS IDENTITY, cocktail_id INT NOT NULL, ingredient_id INT NOT NULL, quantity INT NOT NULL, measure VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1A2C0A39CD6F76C6 ON cocktail_ingredient (cocktail_id)');
        $this->addSql('CREATE INDEX IDX_1A2C0A39933FE08C ON cocktail_ingredient (ingredient_id)');
        $this->addSql('CREATE TABLE ingredient (id BIGINT GENERATED ALWAYS AS IDENTITY, ingredient_category_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6BAF7870AA35537B ON ingredient (ingredient_category_id)');
        $this->addSql('CREATE TABLE ingredient_category (id BIGINT GENERATED ALWAYS AS IDENTITY, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE cocktail_ingredient ADD CONSTRAINT FK_1A2C0A39CD6F76C6 FOREIGN KEY (cocktail_id) REFERENCES cocktail (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cocktail_ingredient ADD CONSTRAINT FK_1A2C0A39933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF7870AA35537B FOREIGN KEY (ingredient_category_id) REFERENCES ingredient_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE cocktail_ingredient DROP CONSTRAINT FK_1A2C0A39CD6F76C6');
        $this->addSql('ALTER TABLE cocktail_ingredient DROP CONSTRAINT FK_1A2C0A39933FE08C');
        $this->addSql('ALTER TABLE ingredient DROP CONSTRAINT FK_6BAF7870AA35537B');
        $this->addSql('DROP TABLE cocktail');
        $this->addSql('DROP TABLE cocktail_ingredient');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE ingredient_category');
    }
}
