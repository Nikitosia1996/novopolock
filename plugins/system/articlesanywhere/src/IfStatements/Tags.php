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
use RegularLabs\Library\StringHelper as RL_String;
use RegularLabs\Plugin\System\ArticlesAnywhere\Helpers\Params;

class Tags
{
    /**
     * @var Tag[]
     */
    private array $tags = [];

    /**
     * @param string $string
     */
    public function __construct($string)
    {
        $this->setTags($string);
    }

    /**
     * @return Tag[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param string $string
     */
    private function setTags($string)
    {
        $regex = Params::getRegex('iftag');

        RL_RegEx::matchAll($regex, $string, $matches);

        if (empty($matches))
        {
            return;
        }

        foreach ($matches as $i => $match)
        {
            $end_tag = $matches[$i + 1][0] ?? Params::getIfEndTag();

            $startpos = RL_String::strpos($string, $match[0]) + strlen($match[0]);
            $endpos   = RL_String::strpos($string, $end_tag, $startpos) - $startpos;

            $match['content'] = RL_String::substr($string, $startpos, $endpos);

            $this->tags[] = new Tag($match);
        }
    }
}
