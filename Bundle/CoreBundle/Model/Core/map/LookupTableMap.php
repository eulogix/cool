<?php

namespace Eulogix\Cool\Bundle\CoreBundle\Model\Core\map;

use \RelationMap;


/**
 * This class defines the structure of the 'core.lookup' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.vendor.eulogix.cool-core-bundle.Bundle.CoreBundle.Model.Core.map
 */
class LookupTableMap extends \Eulogix\Cool\Lib\Database\Propel\CoolTableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'vendor.eulogix.cool-core-bundle.Bundle.CoreBundle.Model.Core.map.LookupTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('core.lookup');
        $this->setPhpName('Lookup');
        $this->setClassname('Eulogix\\Cool\\Bundle\\CoreBundle\\Model\\Core\\Lookup');
        $this->setPackage('vendor.eulogix.cool-core-bundle.Bundle.CoreBundle.Model.Core');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('core.lookup_lookup_id_seq');
        // columns
        $this->addPrimaryKey('lookup_id', 'LookupId', 'INTEGER', true, null, null);
        $this->addColumn('domain_name', 'DomainName', 'VARCHAR', false, 50, null);
        $this->addColumn('value', 'Value', 'VARCHAR', false, 50, null);
        $this->addColumn('dec_it', 'DecIt', 'LONGVARCHAR', false, null, null);
        $this->addColumn('dec_en', 'DecEn', 'LONGVARCHAR', false, null, null);
        $this->addColumn('dec_es', 'DecEs', 'LONGVARCHAR', false, null, null);
        $this->addColumn('dec_pt', 'DecPt', 'LONGVARCHAR', false, null, null);
        $this->addColumn('dec_el', 'DecEl', 'LONGVARCHAR', false, null, null);
        $this->addColumn('sort_order', 'SortOrder', 'INTEGER', false, null, null);
        $this->addColumn('schema_filter', 'SchemaFilter', 'LONGVARCHAR', false, null, null);
        $this->addColumn('filter', 'Filter', 'LONGVARCHAR', false, null, null);
        $this->addColumn('ext', 'Ext', 'LONGVARCHAR', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'extendable' =>  array (
  'container_column' => 'ext',
),
            'notifier' =>  array (
  'channel' => NULL,
  'per_row' => false,
  'schema' => 'core',
  'target' => 'EulogixCoolCoreBundle/core',
),
        );
    } // getBehaviors()

} // LookupTableMap
