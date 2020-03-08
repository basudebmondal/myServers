<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200307161114 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE applications CHANGE application_description application_description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE servers ADD server_group_id INT NOT NULL, CHANGE server_name server_name VARCHAR(20) DEFAULT NULL, CHANGE server_ip server_ip VARCHAR(25) DEFAULT NULL');
        $this->addSql('ALTER TABLE servers ADD CONSTRAINT FK_4F8AF5F73CF158FB FOREIGN KEY (server_group_id) REFERENCES server_group (id)');
        $this->addSql('CREATE INDEX IDX_4F8AF5F73CF158FB ON servers (server_group_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE applications CHANGE application_description application_description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE servers DROP FOREIGN KEY FK_4F8AF5F73CF158FB');
        $this->addSql('DROP INDEX IDX_4F8AF5F73CF158FB ON servers');
        $this->addSql('ALTER TABLE servers DROP server_group_id, CHANGE server_name server_name VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE server_ip server_ip VARCHAR(25) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
