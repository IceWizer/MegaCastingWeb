<?php

namespace App\Purger;

use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;

class MySQLPurger extends ORMPurger
{
    /**
     * {@inheritDoc}
     */
    public function __construct(private readonly EntityManagerInterface $entityManager, array $excluded = [])
    {
        parent::__construct($this->entityManager, $excluded);
    }

    /**
     * Purges the MySQL database with temporarily disabled foreign key checks.
     *
     * {@inheritDoc}
     */
    public function purge(): void
    {
        $connection = $this->entityManager->getConnection();

        try {
            $connection->executeStatement('SET FOREIGN_KEY_CHECKS = 0');

            $statements = [
                'DELETE FROM `broadcast_partner`;',
                'DELETE FROM `casting_number`;',
                'DELETE FROM `casting_offer`;',
                'DELETE FROM `casting_offer_job`;',
                'DELETE FROM `casting_pack_offer`;',
                'DELETE FROM `contract_type`;',
                'DELETE FROM `coordonate`;',
                'DELETE FROM `customer`;',
                'DELETE FROM `customer_packs`;',
                'DELETE FROM `duration`;',
                'DELETE FROM `job`;',
                'DELETE FROM `job_domain`;',
                'DELETE FROM `job_job_domain`;',
                'DELETE FROM `observer`;',
                'DELETE FROM `user`;',
                // Reset auto_increment
                'ALTER TABLE `broadcast_partner` AUTO_INCREMENT 1;',
                'ALTER TABLE `casting_number` AUTO_INCREMENT 1;',
                'ALTER TABLE `casting_offer` AUTO_INCREMENT 1;',
                'ALTER TABLE `casting_offer_job` AUTO_INCREMENT 1;',
                'ALTER TABLE `casting_pack_offer` AUTO_INCREMENT 1;',
                'ALTER TABLE `contract_type` AUTO_INCREMENT 1;',
                'ALTER TABLE `coordonate` AUTO_INCREMENT 1;',
                'ALTER TABLE `customer` AUTO_INCREMENT 1;',
                'ALTER TABLE `customer_packs` AUTO_INCREMENT 1;',
                'ALTER TABLE `duration` AUTO_INCREMENT 1;',
                'ALTER TABLE `job` AUTO_INCREMENT 1;',
                'ALTER TABLE `job_domain` AUTO_INCREMENT 1;',
                'ALTER TABLE `job_job_domain` AUTO_INCREMENT 1;',
                'ALTER TABLE `observer` AUTO_INCREMENT 1;',
                'ALTER TABLE `user` AUTO_INCREMENT 1;',
            ];

            // Print the statements
            foreach ($statements as $statement) {
                $connection->executeStatement($statement);
            }

            $connection->executeStatement('SET FOREIGN_KEY_CHECKS = 1');

            parent::purge();
        } finally {

        }
    }
}
