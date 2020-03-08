<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200307130742 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE applications (id INT AUTO_INCREMENT NOT NULL, application_name VARCHAR(15) NOT NULL, application_version VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `group` (id INT AUTO_INCREMENT NOT NULL, group_name VARCHAR(20) NOT NULL, group_owner_email VARCHAR(20) NOT NULL, group_description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE servers CHANGE server_name server_name VARCHAR(20) DEFAULT NULL, CHANGE server_group server_group VARCHAR(20) DEFAULT NULL, CHANGE server_ip server_ip VARCHAR(25) DEFAULT NULL, CHANGE group_name group_name VARCHAR(20) DEFAULT NULL, CHANGE group_owner_email group_owner_email VARCHAR(25) DEFAULT NULL, CHANGE application_version application_version VARCHAR(10) DEFAULT NULL, CHANGE application_name application_name VARCHAR(20) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE applications');
        $this->addSql('DROP TABLE `group`');
        $this->addSql('ALTER TABLE servers CHANGE server_name server_name VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE server_group server_group VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE server_ip server_ip VARCHAR(25) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE group_name group_name VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE group_owner_email group_owner_email VARCHAR(25) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE application_version application_version VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE application_name application_name VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
