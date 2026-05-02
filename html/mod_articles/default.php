<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_articles
 *
 * @copyright   (C) 2024 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

if (!$list) {
    return;
}

?>
<div class="uk-position-relative uk-margin-bottom" uk-slideshow="autoplay: true; autoplay-interval: 3500">
    <ul class="uk-slideshow-items">
        <?php
        $items = is_array($list) && isset(array_values($list)[0]) && is_array(array_values($list)[0])
            ? array_merge(...array_values($list))
            : $list;
        ?>
        <?php foreach ($items as $item) : ?>
            <li itemscope itemtype="https://schema.org/Article">
                <a href="<?php echo htmlspecialchars($item->link, ENT_QUOTES, 'UTF-8'); ?>">
                    <?php require ModuleHelper::getLayoutPath('mod_articles', 'default_item'); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
</div>
