<?php

/*
 * This file is part of the Eulogix\Cool package.
 *
 * (c) Eulogix <http://www.eulogix.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

namespace Eulogix\Cool\Bundle\CoreBundle\CWidget\Core\Files;

use Eulogix\Cool\Lib\DataSource\ValueMapInterface;
use Eulogix\Cool\Lib\File\FileProperty;
use Eulogix\Cool\Lib\File\FileRepositoryFactory;
use Eulogix\Cool\Lib\File\FileRepositoryInterface;
use Eulogix\Cool\Lib\Form\Field\FieldInterface;
use Eulogix\Cool\Lib\Form\Field\XhrPicker;
use Eulogix\Cool\Lib\Form\Form;
use Eulogix\Cool\Lib\Widget\Message;

/**
 * @author Pietro Baricco <pietro@eulogix.com>
 */

class FilePropertiesForm extends Form {

    /**
     * @var FileRepositoryInterface
     */
    private $repo;

    /**
     * @var FileProperty[]
     */
    private $properties;

    public function build() {
        parent::build();

        $parameters = $this->parameters->all();
        $id = $parameters['repositoryId'];
        $this->repo = FileRepositoryFactory::fromId($id);
        $this->repo->setParameters($parameters);

        $filePaths = explode(';',$parameters['filePaths']);

        if(count($filePaths)>1)
            $this->addMessageWarning("Working on {1} files!",count($filePaths));

        $folders = [];
        $allProperties = [];
        foreach($filePaths as $fp) {
            $allProperties[] = $this->repo->getAvailableFileProperties($fp);

            if(!$this->repo->getUserPermissions()->canSetProperties($fp))
                $this->setReadOnly(true);

            $folders[$this->repo->get($fp)->getParentId()] = 1;
        }
        $this->properties = count($allProperties) == 1 ? array_pop($allProperties) : call_user_func_array('array_intersect_key',$allProperties);

        foreach($this->properties as $prop)
            $this->addField($prop->getName(), $this->fieldFactory($prop->getControlType(), $prop->getValueMap()));

        $this->rawFill( $this->repo->getMergedFileProperties($filePaths) );

        if(!$this->getReadOnly())
            $this->addFieldSubmit('save');

        $this->getAttributes()->set('context', count($folders) !== 1 ? 'MIXED' : $this->repo->getContextFor(array_keys($folders)[0]));

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return "COOL_FILE_PROPERTIES_FORM";
    }

    public function onSubmit() {
        $parameters = $this->request->all();
        $filePaths = explode(';',$this->parameters->get('filePaths'));
        $this->rawFill( $parameters );
        $this->messages = [];

        if($this->validate( array_keys($parameters) ) ) {
            foreach($filePaths as $path)
                $this->repo->setFileProperties($path, array_diff_assoc($parameters,["save"=>'']));
            $this->addMessageInfo("SAVED");
        } else {
            $this->addMessage(Message::TYPE_ERROR, "NOT VALIDATED");
        }
    }

    public function getDefaultLayout() {
        $l = "<FIELDS>\n";
        foreach($this->properties as $prop) {
            $l.=$prop->getName().":250\n";
        }
        $l.= "</FIELDS>\n<FIELDS>save|align=center</FIELDS>";
        return $l;
    }

    /**
     * @inheritdoc
     */
    public function fieldFactory($fieldType, ValueMapInterface $valueMap=null) {
        if($fieldType == FieldInterface::TYPE_SELECT && $valueMap && $valueMap->getValuesNumber() > 50) {
            $field = new XhrPicker($this);
            $field->setValueMap($valueMap);
            return $field;
        }
        return parent::fieldFactory($fieldType, $valueMap);
    }

}