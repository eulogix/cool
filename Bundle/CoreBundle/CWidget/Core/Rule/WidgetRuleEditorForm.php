<?php

/*
 * This file is part of the Eulogix\Cool package.
 *
 * (c) Eulogix <http://www.eulogix.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

namespace Eulogix\Cool\Bundle\CoreBundle\CWidget\Core\Rule;

use Eulogix\Cool\Lib\DataSource\Classes\Rules\WidgetRulesDataSource;
use Eulogix\Cool\Lib\Form\DSCRUDForm;
use Eulogix\Cool\Lib\Widget\WidgetSlot;

/**
 * @author Pietro Baricco <pietro@eulogix.com>
 */

class WidgetRuleEditorForm extends DSCRUDForm {

    public function __construct($parameters = [])
    {
        parent::__construct($parameters);
        $ds = new WidgetRulesDataSource();
        $this->setDataSource($ds->build());
    }

    public function build() {

        parent::build();

        //since the fk has two values, this avoids an error. to arrange rules, use the d&d
        $this->removeField('parent_widget_rule_id');

        if(!$this->getDSRecord()->isNew()) {

            $filter = json_encode(['rule_id'=> $this->getDSRecord()->get('rule_id')]);

            $this->setSlot("Variables", new WidgetSlot('EulogixCoolCore/Core/Rule/WidgetRuleCodeLister', [
                'databaseName' => 'core',
                'tableName' => 'core.rule_code',
                '_logKey' => $this->getParameters()->get('_logKey'),
                '_rule_name' => $this->getDSRecord()->get('name'),
                '_filter'=>$filter
            ]));
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return "COOL_WIDGET_RULE_EDITOR";
    }
                                                                                                                                        
}