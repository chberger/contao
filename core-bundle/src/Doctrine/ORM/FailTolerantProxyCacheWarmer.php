<?php

declare(strict_types=1);

/*
 * This file is part of Contao.
 *
 * (c) Leo Feyer
 *
 * @license LGPL-3.0-or-later
 */

namespace Contao\CoreBundle\Doctrine\ORM;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException as DoctrineDbalDbalException;
use Doctrine\DBAL\Exception as DoctrineDbalException;
use Symfony\Bridge\Doctrine\CacheWarmer\ProxyCacheWarmer;

class FailTolerantProxyCacheWarmer extends ProxyCacheWarmer
{
    /**
     * @var ProxyCacheWarmer
     */
    private $inner;

    /**
     * @var Connection
     */
    private $connection;

    public function __construct(ProxyCacheWarmer $inner, Connection $connection)
    {
        $this->inner = $inner;
        $this->connection = $connection;
    }

    public function isOptional(): bool
    {
        return (bool) $this->inner->isOptional();
    }

    /**
     * @param string $cacheDir
     *
     * @return array<string>
     */
    public function warmUp($cacheDir)
    {
        // If there are no DB credentials yet (install tool) and the
        // server_version was not configured, we have to skip the ORM warmup to
        // prevent a DBAL exception during the automatic version detection
        try {
            $this->connection->getDatabasePlatform();
        } catch (DoctrineDbalException | DoctrineDbalDbalException | \mysqli_sql_exception $e) {
            return [];
        }

        $this->inner->warmUp($cacheDir);

        return [];
    }
}