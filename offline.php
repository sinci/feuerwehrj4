<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.cassiopeia
 * @subpackage  Templates.feuerwehrj4
 * @copyright   (C) 2017 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Helper\AuthenticationHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;

/** @var Joomla\CMS\Document\HtmlDocument $this */

$twofactormethods = AuthenticationHelper::getTwoFactorMethods();
$extraButtons     = AuthenticationHelper::getLoginButtons('form-login');
$app              = Factory::getApplication();
$wa               = $this->getWebAssetManager();


// Override 'template.active' asset to set correct ltr/rtl dependency
$wa->registerStyle('template.active', '', [], [], ['template.feuerwehrj4.' . ($this->direction === 'rtl' ? 'rtl' : 'ltr')]);

// Logo file or site title param
$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');

// Browsers support SVG favicons
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon.svg', '', [], true, 1), 'icon', 'rel', ['type' => 'image/svg+xml']);
$this->addHeadLink(HTMLHelper::_('image', 'favicon.ico', '', [], true, 1), 'alternate icon', 'rel', ['type' => 'image/vnd.microsoft.icon']);
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon-pinned.svg', '', [], true, 1), 'mask-icon', 'rel', ['color' => '#000']);

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . Uri::root(true) . '/' . htmlspecialchars($this->params->get('logoFile'), ENT_QUOTES) . '" alt="' . $sitename . '">';
}
elseif ($this->params->get('siteTitle'))
{
	$logo = '<span title="' . $sitename . '">' . htmlspecialchars($this->params->get('siteTitle'), ENT_COMPAT, 'UTF-8') . '</span>';
}
else
{
	$logo = HTMLHelper::_('image', 'logo.svg', $sitename, ['class' => 'logo d-inline-block'], true, 0);
}

?>
<!DOCTYPE html>
<html lang="<?= $this->language ?>" dir="<?= $this->direction ?>" vocab="https://schema.org/">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="<?php echo $this->params->get('faviconFile'); ?>" sizes="96x96">
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $this->params->get('appletouchicon'); ?>">
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/feuerwehrj4/css/uikit.min.css" />
        <script src="<?php echo $this->baseurl ?>/templates/feuerwehrj4/js/uikit.min.js"></script>
        <script src="<?php echo $this->baseurl ?>/templates/feuerwehrj4/js/uikit-icons.min.js"></script>    
        <jdoc:include type="head" />
    </head>
<body class="uk-flex uk-flex-middle" uk-height-viewport>
	<div class="jm-offline uk-container uk-container-small uk-text-center uk-background-muted uk-padding">
		<div class="offline-card">
			<div class="header">
			<?php if (!empty($logo)) : ?>
				<h1><?php echo $logo; ?></h1>
			<?php else : ?>
				<h1><?php echo $sitename; ?></h1>
			<?php endif; ?>
			<?php if ($app->get('offline_image')) : ?>
				<?php echo HTMLHelper::_('image', $app->get('offline_image'), $sitename, [], false, 0); ?>
			<?php endif; ?>
			<?php if ($app->get('display_offline_message', 1) == 1 && str_replace(' ', '', $app->get('offline_message')) != '') : ?>
				<p><?php echo $app->get('offline_message'); ?></p>
			<?php elseif ($app->get('display_offline_message', 1) == 2) : ?>
				<p><?php echo Text::_('JOFFLINE_MESSAGE'); ?></p>
			<?php endif; ?>
			</div>
			<div class="login">
				<jdoc:include type="message" />
				<form action="<?php echo Route::_('index.php', true); ?>" method="post" id="form-login">
					<fieldset>
						<label for="username"><?php echo Text::_('JGLOBAL_USERNAME'); ?></label>
						<input name="username" class="form-control uk-input" id="username" type="text">

						<label for="password"><?php echo Text::_('JGLOBAL_PASSWORD'); ?></label>
						<input name="password" class="form-control uk-input" id="password" type="password">

						<?php if (count($twofactormethods) > 1) : ?>
						<label for="secretkey"><?php echo Text::_('JGLOBAL_SECRETKEY'); ?></label>
						<input name="secretkey" autocomplete="one-time-code" class="form-control uk-input" id="secretkey" type="text">
						<?php endif; ?>

						<?php foreach($extraButtons as $button):
							$dataAttributeKeys = array_filter(array_keys($button), function ($key) {
								return substr($key, 0, 5) == 'data-';
							});
							?>
							<div class="mod-login__submit form-group">
								<button type="button"
										class="btn btn-secondary w-100 mt-4 uk-button uk-button-default uk-margin-small-top <?php echo $button['class'] ?? '' ?>"
								<?php foreach ($dataAttributeKeys as $key): ?>
									<?php echo $key ?>="<?php echo $button[$key] ?>"
								<?php endforeach; ?>
								<?php if ($button['onclick']): ?>
									onclick="<?php echo $button['onclick'] ?>"
								<?php endif; ?>
								title="<?php echo Text::_($button['label']) ?>"
								id="<?php echo $button['id'] ?>"
								>
								<?php if (!empty($button['icon'])): ?>
									<span class="<?php echo $button['icon'] ?>"></span>
								<?php elseif (!empty($button['image'])): ?>
									<?php echo $button['image']; ?>
								<?php elseif (!empty($button['svg'])): ?>
									<?php echo $button['svg']; ?>
								<?php endif; ?>
								<?php echo Text::_($button['label']) ?>
								</button>
							</div>
						<?php endforeach; ?>

						<button type="submit" name="Submit" class="btn btn-primary uk-button uk-button-secondary uk-margin-small-top"><?php echo Text::_('JLOGIN'); ?></button>

						<input type="hidden" name="option" value="com_users">
						<input type="hidden" name="task" value="user.login">
						<input type="hidden" name="return" value="<?php echo base64_encode(Uri::base()); ?>">
						<?php echo HTMLHelper::_('form.token'); ?>
					</fieldset>
				</form>
			</div>
		</div>
	</uk-flex>
</body>
</html>
