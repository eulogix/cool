<?php

namespace Eulogix\Cool\Bundle\CoreBundle\Model\Core\om;

use \BasePeer;
use \Criteria;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelException;
use \PropelPDO;
use Eulogix\Cool\Bundle\CoreBundle\Model\Core\PgListenerHook;
use Eulogix\Cool\Bundle\CoreBundle\Model\Core\PgListenerHookPeer;
use Eulogix\Cool\Bundle\CoreBundle\Model\Core\PgListenerHookQuery;
use Eulogix\Cool\Lib\Database\Propel\CoolPropelObject;

abstract class BasePgListenerHook extends CoolPropelObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Eulogix\\Cool\\Bundle\\CoreBundle\\Model\\Core\\PgListenerHookPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        PgListenerHookPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the pg_listener_hook_id field.
     * @var        int
     */
    protected $pg_listener_hook_id;

    /**
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the channels_regex field.
     * @var        string
     */
    protected $channels_regex;

    /**
     * The value for the description field.
     * @var        string
     */
    protected $description;

    /**
     * The value for the exec_sql_statements field.
     * @var        string
     */
    protected $exec_sql_statements;

    /**
     * The value for the exec_sf_command field.
     * @var        string
     */
    protected $exec_sf_command;

    /**
     * The value for the exec_shell_command field.
     * @var        string
     */
    protected $exec_shell_command;

    /**
     * The value for the exec_php_code field.
     * @var        string
     */
    protected $exec_php_code;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * Get the [pg_listener_hook_id] column value.
     *
     * @return int
     */
    public function getPgListenerHookId()
    {

        return $this->pg_listener_hook_id;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {

        return $this->name;
    }

    /**
     * Get the [channels_regex] column value.
     *
     * @return string
     */
    public function getChannelsRegex()
    {

        return $this->channels_regex;
    }

    /**
     * Get the [description] column value.
     *
     * @return string
     */
    public function getDescription()
    {

        return $this->description;
    }

    /**
     * Get the [exec_sql_statements] column value.
     *
     * @return string
     */
    public function getExecSqlStatements()
    {

        return $this->exec_sql_statements;
    }

    /**
     * Get the [exec_sf_command] column value.
     *
     * @return string
     */
    public function getExecSfCommand()
    {

        return $this->exec_sf_command;
    }

    /**
     * Get the [exec_shell_command] column value.
     *
     * @return string
     */
    public function getExecShellCommand()
    {

        return $this->exec_shell_command;
    }

    /**
     * Get the [exec_php_code] column value.
     *
     * @return string
     */
    public function getExecPhpCode()
    {

        return $this->exec_php_code;
    }

    /**
     * Set the value of [pg_listener_hook_id] column.
     *
     * @param  int $v new value
     * @return PgListenerHook The current object (for fluent API support)
     */
    public function setPgListenerHookId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->pg_listener_hook_id !== $v) {
            $this->pg_listener_hook_id = $v;
            $this->modifiedColumns[] = PgListenerHookPeer::PG_LISTENER_HOOK_ID;
        }


        return $this;
    } // setPgListenerHookId()

    /**
     * Set the value of [name] column.
     *
     * @param  string $v new value
     * @return PgListenerHook The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = PgListenerHookPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [channels_regex] column.
     *
     * @param  string $v new value
     * @return PgListenerHook The current object (for fluent API support)
     */
    public function setChannelsRegex($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->channels_regex !== $v) {
            $this->channels_regex = $v;
            $this->modifiedColumns[] = PgListenerHookPeer::CHANNELS_REGEX;
        }


        return $this;
    } // setChannelsRegex()

    /**
     * Set the value of [description] column.
     *
     * @param  string $v new value
     * @return PgListenerHook The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[] = PgListenerHookPeer::DESCRIPTION;
        }


        return $this;
    } // setDescription()

    /**
     * Set the value of [exec_sql_statements] column.
     *
     * @param  string $v new value
     * @return PgListenerHook The current object (for fluent API support)
     */
    public function setExecSqlStatements($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->exec_sql_statements !== $v) {
            $this->exec_sql_statements = $v;
            $this->modifiedColumns[] = PgListenerHookPeer::EXEC_SQL_STATEMENTS;
        }


        return $this;
    } // setExecSqlStatements()

    /**
     * Set the value of [exec_sf_command] column.
     *
     * @param  string $v new value
     * @return PgListenerHook The current object (for fluent API support)
     */
    public function setExecSfCommand($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->exec_sf_command !== $v) {
            $this->exec_sf_command = $v;
            $this->modifiedColumns[] = PgListenerHookPeer::EXEC_SF_COMMAND;
        }


        return $this;
    } // setExecSfCommand()

    /**
     * Set the value of [exec_shell_command] column.
     *
     * @param  string $v new value
     * @return PgListenerHook The current object (for fluent API support)
     */
    public function setExecShellCommand($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->exec_shell_command !== $v) {
            $this->exec_shell_command = $v;
            $this->modifiedColumns[] = PgListenerHookPeer::EXEC_SHELL_COMMAND;
        }


        return $this;
    } // setExecShellCommand()

    /**
     * Set the value of [exec_php_code] column.
     *
     * @param  string $v new value
     * @return PgListenerHook The current object (for fluent API support)
     */
    public function setExecPhpCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->exec_php_code !== $v) {
            $this->exec_php_code = $v;
            $this->modifiedColumns[] = PgListenerHookPeer::EXEC_PHP_CODE;
        }


        return $this;
    } // setExecPhpCode()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->pg_listener_hook_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->channels_regex = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->description = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->exec_sql_statements = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->exec_sf_command = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->exec_shell_command = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->exec_php_code = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 8; // 8 = PgListenerHookPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating PgListenerHook object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(PgListenerHookPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = PgListenerHookPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(PgListenerHookPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = PgListenerHookQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(PgListenerHookPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                PgListenerHookPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = PgListenerHookPeer::PG_LISTENER_HOOK_ID;
        if (null !== $this->pg_listener_hook_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PgListenerHookPeer::PG_LISTENER_HOOK_ID . ')');
        }
        if (null === $this->pg_listener_hook_id) {
            try {
                $stmt = $con->query("SELECT nextval('core.pg_listener_hook_pg_listener_hook_id_seq')");
                $row = $stmt->fetch(PDO::FETCH_NUM);
                $this->pg_listener_hook_id = $row[0];
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PgListenerHookPeer::PG_LISTENER_HOOK_ID)) {
            $modifiedColumns[':p' . $index++]  = 'pg_listener_hook_id';
        }
        if ($this->isColumnModified(PgListenerHookPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(PgListenerHookPeer::CHANNELS_REGEX)) {
            $modifiedColumns[':p' . $index++]  = 'channels_regex';
        }
        if ($this->isColumnModified(PgListenerHookPeer::DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'description';
        }
        if ($this->isColumnModified(PgListenerHookPeer::EXEC_SQL_STATEMENTS)) {
            $modifiedColumns[':p' . $index++]  = 'exec_sql_statements';
        }
        if ($this->isColumnModified(PgListenerHookPeer::EXEC_SF_COMMAND)) {
            $modifiedColumns[':p' . $index++]  = 'exec_sf_command';
        }
        if ($this->isColumnModified(PgListenerHookPeer::EXEC_SHELL_COMMAND)) {
            $modifiedColumns[':p' . $index++]  = 'exec_shell_command';
        }
        if ($this->isColumnModified(PgListenerHookPeer::EXEC_PHP_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'exec_php_code';
        }

        $sql = sprintf(
            'INSERT INTO core.pg_listener_hook (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'pg_listener_hook_id':
                        $stmt->bindValue($identifier, $this->pg_listener_hook_id, PDO::PARAM_INT);
                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'channels_regex':
                        $stmt->bindValue($identifier, $this->channels_regex, PDO::PARAM_STR);
                        break;
                    case 'description':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case 'exec_sql_statements':
                        $stmt->bindValue($identifier, $this->exec_sql_statements, PDO::PARAM_STR);
                        break;
                    case 'exec_sf_command':
                        $stmt->bindValue($identifier, $this->exec_sf_command, PDO::PARAM_STR);
                        break;
                    case 'exec_shell_command':
                        $stmt->bindValue($identifier, $this->exec_shell_command, PDO::PARAM_STR);
                        break;
                    case 'exec_php_code':
                        $stmt->bindValue($identifier, $this->exec_php_code, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggregated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objects otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            if (($retval = PgListenerHookPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }



            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = PgListenerHookPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getPgListenerHookId();
                break;
            case 1:
                return $this->getName();
                break;
            case 2:
                return $this->getChannelsRegex();
                break;
            case 3:
                return $this->getDescription();
                break;
            case 4:
                return $this->getExecSqlStatements();
                break;
            case 5:
                return $this->getExecSfCommand();
                break;
            case 6:
                return $this->getExecShellCommand();
                break;
            case 7:
                return $this->getExecPhpCode();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
    {
        if (isset($alreadyDumpedObjects['PgListenerHook'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['PgListenerHook'][$this->getPrimaryKey()] = true;
        $keys = PgListenerHookPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getPgListenerHookId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getChannelsRegex(),
            $keys[3] => $this->getDescription(),
            $keys[4] => $this->getExecSqlStatements(),
            $keys[5] => $this->getExecSfCommand(),
            $keys[6] => $this->getExecShellCommand(),
            $keys[7] => $this->getExecPhpCode(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }


        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = PgListenerHookPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setPgListenerHookId($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setChannelsRegex($value);
                break;
            case 3:
                $this->setDescription($value);
                break;
            case 4:
                $this->setExecSqlStatements($value);
                break;
            case 5:
                $this->setExecSfCommand($value);
                break;
            case 6:
                $this->setExecShellCommand($value);
                break;
            case 7:
                $this->setExecPhpCode($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = PgListenerHookPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setPgListenerHookId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setChannelsRegex($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setDescription($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setExecSqlStatements($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setExecSfCommand($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setExecShellCommand($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setExecPhpCode($arr[$keys[7]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(PgListenerHookPeer::DATABASE_NAME);

        if ($this->isColumnModified(PgListenerHookPeer::PG_LISTENER_HOOK_ID)) $criteria->add(PgListenerHookPeer::PG_LISTENER_HOOK_ID, $this->pg_listener_hook_id);
        if ($this->isColumnModified(PgListenerHookPeer::NAME)) $criteria->add(PgListenerHookPeer::NAME, $this->name);
        if ($this->isColumnModified(PgListenerHookPeer::CHANNELS_REGEX)) $criteria->add(PgListenerHookPeer::CHANNELS_REGEX, $this->channels_regex);
        if ($this->isColumnModified(PgListenerHookPeer::DESCRIPTION)) $criteria->add(PgListenerHookPeer::DESCRIPTION, $this->description);
        if ($this->isColumnModified(PgListenerHookPeer::EXEC_SQL_STATEMENTS)) $criteria->add(PgListenerHookPeer::EXEC_SQL_STATEMENTS, $this->exec_sql_statements);
        if ($this->isColumnModified(PgListenerHookPeer::EXEC_SF_COMMAND)) $criteria->add(PgListenerHookPeer::EXEC_SF_COMMAND, $this->exec_sf_command);
        if ($this->isColumnModified(PgListenerHookPeer::EXEC_SHELL_COMMAND)) $criteria->add(PgListenerHookPeer::EXEC_SHELL_COMMAND, $this->exec_shell_command);
        if ($this->isColumnModified(PgListenerHookPeer::EXEC_PHP_CODE)) $criteria->add(PgListenerHookPeer::EXEC_PHP_CODE, $this->exec_php_code);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(PgListenerHookPeer::DATABASE_NAME);
        $criteria->add(PgListenerHookPeer::PG_LISTENER_HOOK_ID, $this->pg_listener_hook_id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getPgListenerHookId();
    }

    /**
     * Generic method to set the primary key (pg_listener_hook_id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setPgListenerHookId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getPgListenerHookId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of PgListenerHook (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setChannelsRegex($this->getChannelsRegex());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setExecSqlStatements($this->getExecSqlStatements());
        $copyObj->setExecSfCommand($this->getExecSfCommand());
        $copyObj->setExecShellCommand($this->getExecShellCommand());
        $copyObj->setExecPhpCode($this->getExecPhpCode());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setPgListenerHookId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return PgListenerHook Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return PgListenerHookPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new PgListenerHookPeer();
        }

        return self::$peer;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->pg_listener_hook_id = null;
        $this->name = null;
        $this->channels_regex = null;
        $this->description = null;
        $this->exec_sql_statements = null;
        $this->exec_sf_command = null;
        $this->exec_shell_command = null;
        $this->exec_php_code = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PgListenerHookPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}