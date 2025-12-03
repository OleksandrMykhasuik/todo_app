<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251114132601 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE network_device_entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE network_device_summary (id INT AUTO_INCREMENT NOT NULL, network_device_id_id INT NOT NULL, temperature_c INT DEFAULT NULL, cpuload_percent SMALLINT NOT NULL, fetched_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ramusage INT NOT NULL, uptime INT NOT NULL, INDEX IDX_F10D7C54DCB3A958 (network_device_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE network_device_traffic (id INT AUTO_INCREMENT NOT NULL, network_device_id_id INT NOT NULL, ethernet_interface_name VARCHAR(255) NOT NULL, traffic_in BIGINT DEFAULT NULL, traffic_out BIGINT DEFAULT NULL, fetched_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_6A453C07DCB3A958 (network_device_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE network_device_summary ADD CONSTRAINT FK_F10D7C54DCB3A958 FOREIGN KEY (network_device_id_id) REFERENCES network_device_entity (id)');
        $this->addSql('ALTER TABLE network_device_traffic ADD CONSTRAINT FK_6A453C07DCB3A958 FOREIGN KEY (network_device_id_id) REFERENCES network_device_entity (id)');
        $this->addSql('DROP TABLE network_load_data');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE network_load_data (id INT AUTO_INCREMENT NOT NULL, datetime DATETIME NOT NULL, net_interface_name VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, traffic_in BIGINT NOT NULL, traffic_out BIGINT NOT NULL, net_device_name VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE network_device_summary DROP FOREIGN KEY FK_F10D7C54DCB3A958');
        $this->addSql('ALTER TABLE network_device_traffic DROP FOREIGN KEY FK_6A453C07DCB3A958');
        $this->addSql('DROP TABLE network_device_entity');
        $this->addSql('DROP TABLE network_device_summary');
        $this->addSql('DROP TABLE network_device_traffic');
    }
}
