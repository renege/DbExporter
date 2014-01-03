<?php
/**
 * DbExporter.
 *
 * @User nicolaswidart
 * @Date 3/01/14
 * @Time 12:55
 *
 */

namespace Nwidart\DbExporter;

class DbExportHandler extends DbExporter
{
    /**
     * @var DbMigrations
     */
    protected $migrator;
    /**
     * @var DbSeeding
     */
    protected $seeder;

    /**
     * Inject the DbMigrations class
     * @param DbMigrations $DbMigrations
     * @param DbSeeding $DbSeeding
     */
    function __construct(DbMigrations $DbMigrations, DbSeeding $DbSeeding)
    {
        $this->migrator = $DbMigrations;
        $this->seeder = $DbSeeding;
    }

    /**
     * Create migrations from the given DB
     * @param String null $database
     * @return $this
     */
    public function migrate($database = null)
    {
        $this->migrator->convert($database)->write();

        return $this;
    }

    /**
     * @param null $database
     * @return $this
     */
    public function seed($database = null)
    {
        $this->seeder->convert($database)->write();

        return $this;
    }

    public function migrateAndSeed($database = null)
    {
        // Run the migrator generator
        $this->migrator->convert($database)->write();

        // Run the seeder generator
        $this->seeder->convert($database)->write();

        return $this;
    }

    /**
     * Add tables to the ignore array
     * @param $tables
     * @return $this
     */
    public function ignore($tables)
    {
        self::$ignore = array_merge(self::$ignore, (array)$tables);
/**/
        return $this;
    }
}