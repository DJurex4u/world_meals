<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200128181423 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_3F207042C2AC5D3 (translatable_id), UNIQUE INDEX category_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_C1A8BF62C2AC5D3 (translatable_id), UNIQUE INDEX ingredient_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_B99343E72C2AC5D3 (translatable_id), UNIQUE INDEX meal_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, locale VARCHAR(5) NOT NULL, INDEX IDX_A8A03F8F2C2AC5D3 (translatable_id), UNIQUE INDEX tag_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_translation ADD CONSTRAINT FK_3F207042C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_translation ADD CONSTRAINT FK_C1A8BF62C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meal_translation ADD CONSTRAINT FK_B99343E72C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES meal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_translation ADD CONSTRAINT FK_A8A03F8F2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category CHANGE meal_id meal_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ingredient CHANGE meal_id meal_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tag CHANGE meal_id meal_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE category_translation');
        $this->addSql('DROP TABLE ingredient_translation');
        $this->addSql('DROP TABLE meal_translation');
        $this->addSql('DROP TABLE tag_translation');
        $this->addSql('ALTER TABLE category CHANGE meal_id meal_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ingredient CHANGE meal_id meal_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tag CHANGE meal_id meal_id INT DEFAULT NULL');
    }
}
