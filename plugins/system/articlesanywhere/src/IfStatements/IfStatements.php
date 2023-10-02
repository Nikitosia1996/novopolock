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

namespace RegularLabs\Plugin\System\ArticlesAnywhere\IfStatements;

defined('_JEXEC') or die;

use RegularLabs\Library\RegEx as RL_RegEx;
use RegularLabs\Plugin\System\ArticlesAnywhere\Helpers\Params;
use RegularLabs\Plugin\System\ArticlesAnywhere\Numbers\Numbers;

class IfStatements
{
    private $database_name;
    /**
     * @var IfStatement[]
     */
    private array $statements = [];

    /**
     * @param string $string
     */
    public function __construct($string, $database_name = '', $include_rows = false)
    {
        $this->database_name = $database_name;
        $this->setStatements($string, $include_rows);
    }

    /**
     * @return array
     */
    public function getDataGroups()
    {
        $data_groups = [];

        foreach ($this->statements as $if_statement)
        {
            $data_groups = array_merge($data_groups, $if_statement->getDataGroups());
        }

        return $data_groups;
    }

    /**
     * @return IfStatement[]
     */
    public function getStatements()
    {
        return $this->statements;
    }

    /**
     * @param $html
     */
    public function replace(&$html)
    {
        foreach ($this->statements as $if_statement)
        {
            $if_statement->replace($html);
        }
    }

    /**
     * @param array   $values
     * @param Numbers $numbers
     */
    public function setValues($values, Numbers $numbers)
    {
        foreach ($this->statements as &$if_statement)
        {
            $if_statement->setValues($values, $numbers);
        }
    }

    /**
     * @param $string
     */
    private function setStatements($string, $include_rows = false)
    {
        $this->statements = [];

        $regex = Params::getRegex('ifstatement');

        RL_RegEx::matchAll($regex, $string, $matches);

        if (empty($matches))
        {
            return;
        }

        foreach ($matches as $match)
        {
            $has_row = strpos($match[0], 'row:') !== false;

            if (($include_rows && ! $has_row)
                || ( ! $include_rows && $has_row)
            )
            {
                continue;
            }

            $this->statements[] = new IfStatement($match);
        }
    }

}
