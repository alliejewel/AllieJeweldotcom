<?php

namespace TylerSommer\Bundle\BlogBundle\DBAL;

use Doctrine\DBAL\Driver\PDOConnection;
use Doctrine\DBAL\Driver\PDOPgSql\Driver;

class PgSqlDriver extends Driver
{
    /** {@inheritDoc} */
    public function connect(array $params, $username = null, $password = null, array $driverOptions = array())
    {
        $schema = isset($driverOptions['schema']) ? $driverOptions['schema'] : 'public';
        unset($driverOptions['schema']);

        $connection = new PDOConnection(
            $this->_constructPdoDsn($params),
            $username,
            $password,
            $driverOptions
        );

        $connection->exec("SET search_path TO {$schema};");

        return $connection;
    }

    /**
     * Constructs the Postgres PDO DSN.
     *
     * @see \Doctrine\DBAL\Driver\PDOPgSql\Driver::_constructPdoDsn
     *
     * @param array $params
     *
     * @return string The DSN.
     */
    private function _constructPdoDsn(array $params)
    {
        $dsn = 'pgsql:';

        if (isset($params['host']) && $params['host'] != '') {
            $dsn .= 'host=' . $params['host'] . ' ';
        }

        if (isset($params['port']) && $params['port'] != '') {
            $dsn .= 'port=' . $params['port'] . ' ';
        }

        if (isset($params['dbname'])) {
            $dsn .= 'dbname=' . $params['dbname'] . ' ';
        } else {
            // Used for temporary connections to allow operations like dropping the database currently connected to.
            // Connecting without an explicit database does not work, therefore "postgres" database is used
            // as it is certainly present in every server setup.
            $dsn .= 'dbname=postgres' . ' ';
        }

        if (isset($params['sslmode'])) {
            $dsn .= 'sslmode=' . $params['sslmode'] . ' ';
        }

        return $dsn;
    }
}