<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.cassiopeia
 * @subpackage  Templates.feuerwehrj4
 * @copyright   (C) 2017 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

//JHtml::_('bootstrap.framework');
//JHtml::_('bootstrap.loadcss', true, $this->direction);

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

/** @var Joomla\CMS\Document\HtmlDocument $this */

$doc = Factory::getDocument();
$doc->addStyleSheet(JUri::root() . 'templates/feuerwehrj4/css/custom.css');

$app = Factory::getApplication();
$wa  = $this->getWebAssetManager();

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');
$menu     = $app->getMenu()->getActive();
$pageclass = $menu !== null ? $menu->getParams()->get('pageclass_sfx', '') : '';

// Override 'template.active' asset to set correct ltr/rtl dependency
$wa->registerStyle('template.active', '', [], [], ['template.cassiopeia.' . ($this->direction === 'rtl' ? 'rtl' : 'ltr')]);

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

<body class="site <?php echo $option
	. ($this->direction == 'rtl' ? ' rtl' : '');
?>">
<div id="page" class="jm-page">

	<header>
		<?php if ($this->countModules('toolbar-left', true) || $this->countModules('toolbar-right', true)) : ?>
			<div class="jm-toolbar uk-clearfix">
				<div class="uk-container">
					<?php if ($this->countModules('toolbar-left',true)) : ?>
						<div class="uk-float-left">
							<jdoc:include type="modules" name="toolbar-left" style="none"/>
						</div>
					<?php endif; ?>

					<?php if ($this->countModules('toolbar-right',true)) : ?>
						<div class="uk-float-right">
							<div class="uk-display-inline-block"><jdoc:include type="modules" name="toolbar-right" style="none"/></div>
							<div class="uk-display-inline-block"><jdoc:include type="modules" name="search" style="none" /></div>
						</div>
					<?php endif; ?>
				</div>
			</div><!-- end .jm-toolbar-->
		<?php endif; ?>

		<div class="uk-navbar-container uk-background-secondary" uk-sticky>
			<div class="uk-container">
				<nav class="uk-navbar" uk-navbar="boundary:boundary-align:left;">

					<?php if ($this->params->get('brand', 1)) : ?>
						<div class="uk-navbar-left uk-visible@m">
							<div class="navbar-brand">
								<a class="uk-navbar-item uk-logo" href="<?php echo $this->baseurl; ?>/">
									<?php echo $logo; ?>
								</a>
								<?php if ($this->params->get('siteDescription')) : ?>
									<div class="site-description"><?php echo htmlspecialchars($this->params->get('siteDescription')); ?></div>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>

					<div class="uk-navbar-left uk-hidden@m">
						<a class="uk-navbar-toggle uk-hidden@m" href="#offcanvas-nav" uk-toggle="">
							<div uk-navbar-toggle-icon="" class="uk-icon uk-navbar-toggle-icon"></div>
							<span class="uk-margin-small-left">Menu</span>
						</a>
					</div>

					<?php if ($this->params->get('brand', 1)) : ?>
						<div class="uk-navbar-center uk-hidden@m">
							<div class="navbar-brand">
								<a class="uk-navbar-item uk-logo" href="<?php echo $this->baseurl; ?>/">
									<?php echo $logo; ?>
								</a>
								<?php if ($this->params->get('siteDescription')) : ?>
									<div class="site-description"><?php echo htmlspecialchars($this->params->get('siteDescription')); ?></div>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>

					<?php if ($this->countModules('menu', true)): ?>
						<div class="uk-navbar-right uk-visible@m">
							<?php if ($this->countModules('menu', true)) : ?>
								<jdoc:include type="modules" name="menu" style="none" />
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</nav><!-- end .uk-navbar -->				
			</div>
		</div><!-- end .uk-navbar-container -->		
	</header>

<div class="uk-container uk-margin-top">
	<div uk-grid>
		<?php if ($this->countModules('sidebar-left') || $this->countModules('sidebar-right', true)) :?>
			<?php if ($this->countModules('sidebar-left', true)) : ?>
			<div class="uk-width-1-4@m sidebar-left">	
				<jdoc:include type="modules" name="sidebar-left" style="html5"/>
			</div>
			<?php endif; ?>
			<div class="uk-width-expand@m">
				<jdoc:include type="modules" name="breadcrumbs" style="none" />
				<?php if ($this->countModules('main-top', true)) : ?>
					<jdoc:include type="modules" name="main-top" style="html5" />
				<?php endif;?>
				<jdoc:include type="message" />
				<main>
				<jdoc:include type="component" />
				</main>
				<jdoc:include type="modules" name="main-bottom" style="none" />
			</div>
			<?php if ($this->countModules('sidebar-right', true)) : ?>
			<div class="uk-width-1-4@m sidebar-right">
				<jdoc:include type="modules" name="sidebar-right" style="html5" />
			</div>
			<?php endif; ?>
		<?php else:?>
			<div class="uk-width-1-1@m">
					<?php if ($this->countModules('main-top', true)) : ?>
						<jdoc:include type="modules" name="main-top" style="html5" />
					<?php endif; ?>
					<jdoc:include type="modules" name="breadcrumbs" style="none" />
					<jdoc:include type="message" />
					<main>
					<jdoc:include type="component" />
					</main>
					<jdoc:include type="modules" name="main-bottom" style="none" />
			</div>

		<?php endif; ?>
	</div><!-- uk-grid -->
</div><!-- .uk-container -->

<footer class="container-footer uk-background-secondary uk-text-muted uk-padding uk-margin-top">
	<div class="uk-container">
		<div uk-grid>

			<div class="uk-width-1-3@m">
			<?php if ($this->countModules('footer-a', true)) : ?>
				<div class="footer-a">
					<jdoc:include type="modules" name="footer-a" style="html5" />
				</div>
			<?php endif; ?>
			</div>

			<div class="uk-width-1-3@m">
			<?php if ($this->countModules('footer-b', true)) : ?>
				<div class="footer-b">
					<jdoc:include type="modules" name="footer-b" style="html5" />
				</div>
			<?php endif; ?>
			</div>

			<div class="uk-width-1-3@m">
			<?php if ($this->countModules('footer-c', true)) : ?>
				<div class="footer-c">
					<jdoc:include type="modules" name="footer-c" style="html5" />
				</div>
			<?php endif; ?>
			</div>

		</div>
	</div>

	<?php if ($this->countModules('footer-menu', true)) : ?>
		<div class="footer-menu uk-flex uk-flex-center uk-margin-top">
			<jdoc:include type="modules" name="footer-menu" style="none" />
		</div>
	<?php endif; ?>
	
	<div class="uk-flex uk-flex-center uk-margin-top">
	<small>Designed by <a href="http://www.sinci.at">sinci</a> Powered by <a href="https://getuikit.com/">Ulkit</a></small>
	</div>
</footer>

<jdoc:include type="modules" name="debug" style="none" />
</div><!-- #page -->

<div id="offcanvas-nav" uk-offcanvas="overlay: true">
    <div class="uk-offcanvas-bar">
			<?php if ($this->countModules('mobile', true)) : ?>
				<button class="uk-offcanvas-close" type="button" uk-close></button>
				<jdoc:include type="modules" name="mobile" style="none" />
			<?php endif; ?>					
    </div>
</div>
<script src="<?php echo $this->baseurl ?>/templates/feuerwehrj4/js/custom.js"></script>
</body>
</html>
