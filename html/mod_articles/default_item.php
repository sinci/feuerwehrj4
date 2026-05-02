<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_articles
 *
 * @copyright   (C) 2024 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;

?>
<?php if (in_array($params->get('img_intro_full'), ['intro', 'full']) && !empty($item->imageSrc)) : ?>
    <?php echo LayoutHelper::render('joomla.content.' . $params->get('img_intro_full') . '_image', $item); ?>
<?php endif; ?>

<?php if ($params->get('item_title')) : ?>
    <div class="uk-overlay uk-overlay-primary uk-position-bottom uk-text-left uk-transition-slide-bottom">
        <?php $item_heading = $params->get('item_heading', 'h4'); ?>
        <?php if ($item->displayCategoryTitle) : ?>
            <span class="uk-label uk-label-danger uk-text-uppercase uk-text-small" style="padding: 3px 5px;">
                <?php echo htmlspecialchars($item->displayCategoryTitle, ENT_QUOTES, 'UTF-8'); ?>
            </span>
        <?php endif; ?>
        <<?php echo $item_heading; ?> class="newsflash-title uk-margin-small-top">
            <?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>
        </<?php echo $item_heading; ?>>
    </div>
<?php endif; ?>
