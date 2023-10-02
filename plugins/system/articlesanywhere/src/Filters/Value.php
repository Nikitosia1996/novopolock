<?php
/**
 * @package         Articles Anywhere
 * @version         14.0.0
 * 
 * @author          Peter van Westen <info@regularlabs.com>
 * @link            https://regularlabs.com
 * @copyright       Copyright © 2023 Regular Labs All Rights Reserved
 * @license         GNU General Public License version 2 or later
 */

namespace RegularLabs\Plugin\System\ArticlesAnywhere\Filters;

defined('_JEXEC') or die;

use RegularLabs\Library\ArrayHelper as RL_Array;
use RegularLabs\Plugin\System\ArticlesAnywhere\DataGroups\DataGroup;
use RegularLabs\Plugin\System\ArticlesAnywhere\DataGroups\Field;
use RegularLabs\Plugin\System\ArticlesAnywhere\Helpers\Data as DataHelper;
use RegularLabs\Plugin\System\ArticlesAnywhere\Helpers\DB;

class Value
{
    /* @var DataGroup */
    private $data_group;
    private $database_name;
    /* @var DataGroup */
    private $key_data_group;
    private $value;

    /**
     * @param string    $value
     * @param DataGroup $key_data_group
     */
    public function __construct($value, $key_data_group, $database_name = '')
    {
        $this->value          = $value;
        $this->key_data_group = $key_data_group;
        $this->database_name  = $database_name;

        $this->setDataGroup();
    }

    /**
     * @return ValuesObject
     */
    public function get()
    {
        if ($this->data_group)
        {
            return new ValuesObject($this->data_group->getOutputRaw());
        }

        $value = DataHelper::getRangeObject($this->value);

        if ($value instanceof ValuesObject)
        {
            return $value;
        }

        $format   = '';
        $is_field = $this->key_data_group instanceof Field;

        if ($is_field)
        {
            $field = $this->key_data_group->getFieldType();

            if ( ! empty($field) && $field->type == 'calendar' && ! ($field->fieldparams->showtime ?? 1))
            {
                $format = 'Y-m-d';
            }
        }

        $value = DataHelper::getDateObject($this->value, ! $is_field, $format);

        if ($value instanceof ValuesObject)
        {
            return $value;
        }

        $operator = DB::getOperator($value);
        $value    = DB::removeOperator($value);

        if (in_array($operator, ['<=', '<', '<>'], true) && $value !== 'NULL')
        {
            return new ValuesObject(
                [
                    $operator . $value,
                    'NULL',
                ],
                'OR'
            );
        }

        return new ValuesObject($operator . $value);
    }

    public function getDataGroup()
    {
        return $this->data_group;
    }

    public function setDataGroup()
    {
        if (strpos($this->value, ':') === false)
        {
            return;
        }

        [$prefix] = RL_Array::toArray($this->value, ':');

        if ( ! in_array($prefix, ['this', 'input', 'user'], true))
        {
            return;
        }

        $this->data_group = DataHelper::getDataGroup($this->value, [], '', $this->database_name);
    }
}
