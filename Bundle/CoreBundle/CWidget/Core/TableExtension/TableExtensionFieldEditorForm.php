<?php

/*
 * This file is part of the Eulogix\Cool package.
 *
 * (c) Eulogix <http://www.eulogix.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

namespace Eulogix\Cool\Bundle\CoreBundle\CWidget\Core\TableExtension;

use Eulogix\Cool\Lib\DataSource\Classes\TableExtension\TableExtensionFieldDataSource;
use Eulogix\Cool\Lib\Form\CoolForm;

/**
 * @author Pietro Baricco <pietro@eulogix.com>
 */

class TableExtensionFieldEditorForm extends CoolForm  {

    public function __construct($parameters = [])
    {
        parent::__construct($parameters);
        $ds = new TableExtensionFieldDataSource();
        $this->setDataSource($ds->build());
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return "COOL_TABLE_EXTENSION_FIELD_EDITOR";
    }

}