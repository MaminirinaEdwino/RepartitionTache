<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240624110035 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE employes_task (employes_id INT NOT NULL, task_id INT NOT NULL, INDEX IDX_322870E4F971F91F (employes_id), INDEX IDX_322870E48DB60186 (task_id), PRIMARY KEY(employes_id, task_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, admin_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, state VARCHAR(255) NOT NULL, achievement_date DATE NOT NULL, INDEX IDX_527EDB25642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employes_task ADD CONSTRAINT FK_322870E4F971F91F FOREIGN KEY (employes_id) REFERENCES employes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employes_task ADD CONSTRAINT FK_322870E48DB60186 FOREIGN KEY (task_id) REFERENCES task (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employes_task DROP FOREIGN KEY FK_322870E4F971F91F');
        $this->addSql('ALTER TABLE employes_task DROP FOREIGN KEY FK_322870E48DB60186');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25642B8210');
        $this->addSql('DROP TABLE employes_task');
        $this->addSql('DROP TABLE task');
    }
}
