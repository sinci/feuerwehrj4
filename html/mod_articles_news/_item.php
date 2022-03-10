<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   (C) 2010 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;
?>

<?php if ($params->get('img_intro_full') !== 'none' && !empty($item->imageSrc)) : ?>
		<?php echo LayoutHelper::render(
			'joomla.html.image',
			[
				'src' => $item->imageSrc,
				'alt' => $item->imageAlt,
			]
		); ?>
<?php endif; ?>

<?php if ($params->get('item_title')) : ?>
<div class="uk-overlay uk-overlay-primary uk-position-bottom uk-text-left uk-transition-slide-bottom">
	<?php $item_heading = $params->get('item_heading', 'h4'); ?>
	<span class="uk-label-danger uk-text-uppercase uk-text-small" style="padding:3px 5px;">
		<?php echo $item->category_title ;?>
	</span>
	<<?php echo $item_heading; ?> class="newsflash-title">
	<?php if ($item->link !== '' && $params->get('link_titles')) : ?>
		<a href="<?php echo $item->link; ?>">
			<?php echo $item->title; ?>
		</a>
	<?php else : ?>
		<?php echo $item->title; ?>
	<?php endif; ?>
	</<?php echo $item_heading; ?>>
<?php endif; ?>
