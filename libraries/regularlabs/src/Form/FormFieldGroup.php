<?php
/**
 * @package         Regular Labs Library
 * @version         23.6.17636
 * 
 * @author          Peter van Westen <info@regularlabs.com>
 * @link            https://regularlabs.com
 * @copyright       Copyright © 2023 Regular Labs All Rights Reserved
 * @license         GNU General Public License version 2 or later
 */

namespace RegularLabs\Library\Form;

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text as JText;
use Joomla\Registry\Registry as JRegistry;

class FormFieldGroup extends FormField
{
    public $default_group = 'Categories';
    public $type          = 'Field';

    function getAjaxRaw(JRegistry $attributes)
    {
        $this->params = $attributes;

        $name     = $attributes->get('name', $this->type);
        $id       = $attributes->get('id', strtolower($name));
        $value    = $attributes->get('value', []);
        $size     = $attributes->get('size');
        $multiple = $attributes->get('multiple');
        $simple   = $attributes->get('simple');

        $options = $this->getOptions(
            $attributes->get('group')
        );

        return $this->selectList($options, $name, $value, $id, $size, $multiple, $simple);
    }

    public function getGroup()
    {
        $this->params = $this->element->attributes();

        return $this->get('group', $this->default_group ?: $this->type);
    }

    public function getOptions($group = false)
    {
        $group = $group ?: $this->getGroup();
        $id    = $this->type . '_' . $group;

        if ( ! isset($data[$id]))
        {
            $data[$id] = $this->{'get' . $group}();
        }

        return $data[$id];
    }

    public function getSelectList($group = '')
    {
        if ( ! is_array($this->value))
        {
            $this->value = explode(',', $this->value);
        }

        $size     = (int) $this->get('size');
        $multiple = $this->get('multiple');

        $group = $group ?: $this->getGroup();

        $simple = $this->get('simple', ! in_array($group, ['categories'], true));

        return $this->treeSelectListAjax(
            $this->type, $this->name, $this->value, $this->id,
            compact('group', 'size', 'multiple', 'simple'),
            $simple
        );
    }

    public function missingFilesOrTables($tables = ['categories', 'items'], $component = '', $table_prefix = '')
    {
        $component = $component ?: $this->type;

        if ( ! Extension::isInstalled($component))
        {
            return '<fieldset class="alert alert-danger">' . JText::_('ERROR') . ': ' . JText::sprintf('RL_FILES_NOT_FOUND', JText::_('RL_' . strtoupper($component))) . '</fieldset>';
        }

        $group = $this->getGroup();

        if ( ! in_array($group, $tables, true) && ! in_array($group, array_keys($tables), true))
        {
            // no need to check database table for this group
            return false;
        }

        $table_list = $this->db->getTableList();

        $table = $tables[$group] ?? $group;
        $table = $this->db->getPrefix() . strtolower($table_prefix ?: $component) . '_' . $table;

        if (in_array($table, $table_list, true))
        {
            // database table exists, so no error
            return false;
        }

        return '<fieldset class="alert alert-danger">' . JText::_('ERROR') . ': ' . JText::sprintf('RL_TABLE_NOT_FOUND', JText::_('RL_' . strtoupper($component))) . '</fieldset>';
    }

    protected function getInput()
    {
        $this->params = $this->element->attributes();

        return $this->getSelectList();
    }
}
