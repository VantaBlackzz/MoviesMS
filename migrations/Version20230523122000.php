<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230523122000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE movie_to_genres (movie_id INT NOT NULL, genres_id INT NOT NULL, PRIMARY KEY(movie_id, genres_id))');
        $this->addSql('CREATE INDEX IDX_1DECE08D8F93B6FC ON movie_to_genres (movie_id)');
        $this->addSql('CREATE INDEX IDX_1DECE08D6A3B2603 ON movie_to_genres (genres_id)');
        $this->addSql('ALTER TABLE movie_to_genres ADD CONSTRAINT FK_1DECE08D8F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE movie_to_genres ADD CONSTRAINT FK_1DECE08D6A3B2603 FOREIGN KEY (genres_id) REFERENCES genres (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE movie DROP genres');
        $this->addSql('ALTER TABLE movie ALTER description TYPE TEXT');
        $this->addSql('ALTER TABLE movie ALTER description TYPE TEXT');
        $this->addSql('ALTER TABLE movie ALTER tagline DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE movie_to_genres DROP CONSTRAINT FK_1DECE08D8F93B6FC');
        $this->addSql('ALTER TABLE movie_to_genres DROP CONSTRAINT FK_1DECE08D6A3B2603');
        $this->addSql('DROP TABLE movie_to_genres');
        $this->addSql('ALTER TABLE movie ADD genres VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE movie ALTER description TYPE VARCHAR(1000)');
        $this->addSql('ALTER TABLE movie ALTER tagline SET NOT NULL');
    }
}
