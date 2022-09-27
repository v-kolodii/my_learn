<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220920201259 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE statistic (id INT AUTO_INCREMENT NOT NULL, text_entity_id INT DEFAULT NULL, number_of_character SMALLINT DEFAULT NULL, number_of_words SMALLINT DEFAULT NULL, number_of_sentences SMALLINT DEFAULT NULL, frequency_of_characters LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', distribution_of_characters_as_apercentage_of_total LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', average_word_length DOUBLE PRECISION DEFAULT NULL, the_average_number_of_words_in_sentence DOUBLE PRECISION DEFAULT NULL, top10most_used_words LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', top10longest_words LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', top10shortest_words LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', top10longest_sentences LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', top10shortest_sentences LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', number_of_palindrome_words SMALLINT DEFAULT NULL, top10longest_palindrome_words LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', is_the_whole_text_palindrome TINYINT(1) NOT NULL, the_reversed_text  LONGTEXT DEFAULT NULL, the_reversed_text_but_the_character_order_in_words_kept_intact LONGTEXT DEFAULT NULL, run_time  DOUBLE PRECISION DEFAULT NULL, UNIQUE INDEX UNIQ_649B469C722A4E99 (text_entity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE text_entity (id INT AUTO_INCREMENT NOT NULL, text VARCHAR(255) NOT NULL, text_hash VARCHAR(255) DEFAULT NULL, created_date DATETIME DEFAULT NULL, INDEX idx_text_hash (text_hash), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469C722A4E99 FOREIGN KEY (text_entity_id) REFERENCES text_entity (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469C722A4E99');
        $this->addSql('DROP TABLE statistic');
        $this->addSql('DROP TABLE text_entity');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
