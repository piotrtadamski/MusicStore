<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220121121249 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE albums (id INT AUTO_INCREMENT NOT NULL, band_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, year YEAR(4) NOT NULL, INDEX IDX_F4E2474F49ABEB17 (band_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bands (id INT AUTO_INCREMENT NOT NULL, band_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tracks (id INT AUTO_INCREMENT NOT NULL, album_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_246D2A2E1137ABCF (album_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE albums ADD CONSTRAINT FK_F4E2474F49ABEB17 FOREIGN KEY (band_id) REFERENCES bands (id)');
        $this->addSql('ALTER TABLE tracks ADD CONSTRAINT FK_246D2A2E1137ABCF FOREIGN KEY (album_id) REFERENCES albums (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tracks DROP FOREIGN KEY FK_246D2A2E1137ABCF');
        $this->addSql('ALTER TABLE albums DROP FOREIGN KEY FK_F4E2474F49ABEB17');
        $this->addSql('DROP TABLE albums');
        $this->addSql('DROP TABLE bands');
        $this->addSql('DROP TABLE tracks');
    }
}
