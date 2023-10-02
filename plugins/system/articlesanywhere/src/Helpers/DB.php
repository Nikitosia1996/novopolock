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

namespace RegularLabs\Plugin\System\ArticlesAnywhere\Helpers;

defined('_JEXEC') or die;

use Joomla\CMS\Factory as JFactory;
use Joomla\Database\DatabaseDriver as JDatabaseDriver;
use Joomla\Database\DatabaseQuery as JDatabaseQuery;
use Joomla\Database\QueryInterface;
use RegularLabs\Library\Cache as RL_Cache;
use RegularLabs\Library\DB as RL_DB;
use RegularLabs\Plugin\System\ArticlesAnywhere\Database;

class DB extends RL_DB
{
    /**
     * @var JDatabaseDriver
     */
    private static $query_cache_time;

    /**
     * @param string $database_name
     *
     * @return Database
     */
    public static function get($database_name = '')
    {
        $cache = new RL_Cache([__METHOD__, $database_name]);

        if ($cache->exists())
        {
            return $cache->get();
        }

        $db = (new Database($database_name));

        return $cache->set($db);
    }

    /**
     * @return JDatabaseDriver|null
     */
    public static function getDbo()
    {
        return self::get()->getDbo();
    }

    /**
     * @return  string
     */
    public static function getNullDate()
    {
        return self::getDbo()->getNullDate();
    }

    /**
     * @return  JDatabaseQuery
     */
    public static function getQuery()
    {
        return self::getDbo()->getQuery(true);
    }

    public static function getQueryTime()
    {
        if ( ! is_null(self::$query_cache_time))
        {
            return self::$query_cache_time;
        }

        self::$query_cache_time = (int) Params::get()->query_cache_time ?: JFactory::getApplication()->get('cachetime');

        return self::$query_cache_time;
    }

    /**
     * @param string|QueryInterface $query
     * @param string                $return_type
     * @param bool                  $use_local_db
     * @param bool                  $allow_caching
     *
     * @return mixed
     */
    public static function getResults($query, $return_type = 'column', $allow_caching = true, $database_name = '')
    {
        return self::get()->getResults($query, $return_type, $allow_caching);
    }

    /**
     * @param array|string $text
     * @param boolean      $escape
     *
     * @return  string  The quoted input string.
     */
    public static function quote($text, $escape = true)
    {
        return self::getDbo()->quote($text, $escape);
    }

    /**
     * @param array|string $name
     * @param array|string $as
     *
     * @return  array|string
     */
    public static function quoteName($name, $as = null)
    {
        return self::getDbo()->quoteName($name, $as);
    }
}
