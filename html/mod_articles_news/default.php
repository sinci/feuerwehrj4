<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $app->getDocument()->getWebAssetManager();
$wa->registerAndUseStyle('mod_modules', 'mod_articles_news/template.css');

if (empty($list))
{
	return;
}

?>
<div class="uk-position-relative uk-margin-bottom" uk-slideshow="autoplay: true;autoplay-interval:3500">
<ul class="uk-slideshow-items">
	<?php foreach ($list as $item) : ?>
		<li itemscope itemtype="https://schema.org/Article">
		<a href="<?php echo $item->link; ?>">
			<?php require ModuleHelper::getLayoutPath('mod_articles_news', '_item'); ?>
		</a>
		</li>
	<?php endforeach; ?>
</ul>
<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
</div>