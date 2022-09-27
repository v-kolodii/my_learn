<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220920202056 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statistic CHANGE the_reversed_text the_reversed_text  LONGTEXT DEFAULT NULL, CHANGE run_time run_time  DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE text_entity DROP text');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE text_entity ADD text VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE statistic CHANGE the_reversed_text  the_reversed_text LONGTEXT DEFAULT NULL, CHANGE run_time  run_time DOUBLE PRECISION DEFAULT NULL');
    }
}
