<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220123160600 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE albums ADD is_promoted TINYINT(1) NOT NULL, CHANGE title title VARCHAR(255) NOT NULL, CHANGE year year YEAR(4) NOT NULL');
        $this->addSql('ALTER TABLE bands CHANGE band_name band_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE tracks CHANGE title title VARCHAR(255) NOT NULL, CHANGE url url VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE albums DROP is_promoted, CHANGE title title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE year year DATE NOT NULL');
        $this->addSql('ALTER TABLE bands CHANGE band_name band_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE tracks CHANGE title title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE url url VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
