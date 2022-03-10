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
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

/** @var Joomla\CMS\Document\ErrorDocument $this */

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
$wa->registerStyle('template.active', '', [], [], ['template.feuerwehrj4.' . ($this->direction === 'rtl' ? 'rtl' : 'ltr')]);

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

$this->setMetaData('viewport', 'width=device-width, initial-scale=1');

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

<body class="site error_site">
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
							<jdoc:include type="modules" name="toolbar-right" style="none"/>
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

					<?php if ($this->countModules('menu', true) or $this->countModules('search', true)) : ?>
						<div class="uk-navbar-right uk-visible@m">
							<?php if ($this->countModules('menu', true)) : ?>
								<jdoc:include type="modules" name="menu" style="none" />
							<?php endif; ?>
							<?php if ($this->countModules('search', true)) : ?>
								<div class="container-search">
									<jdoc:include type="modules" name="search" style="none" />
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</nav><!-- end .uk-navbar -->				
			</div>
		</div><!-- end .uk-navbar-container -->		
	</header>

	<div class="uk-container uk-margin-top">
		<div class="grid-child container-component">
			<h1 class="page-header"><?php echo Text::_('JERROR_LAYOUT_PAGE_NOT_FOUND'); ?></h1>
			<div class="card">
				<div class="card-body">
					<jdoc:include type="message" />
					<p><strong><?php echo Text::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?></strong></p>
					<p><?php echo Text::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?></p>
					<ul>
						<li><?php echo Text::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?></li>
						<li><?php echo Text::_('JERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?></li>
						<li><?php echo Text::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?></li>
						<li><?php echo Text::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?></li>
					</ul>
					<p><?php echo Text::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?></p>
					<p><a href="<?php echo $this->baseurl; ?>/index.php" class="btn btn-secondary uk-button uk-button-default"><span class="icon-home" aria-hidden="true"></span> <?php echo Text::_('JERROR_LAYOUT_HOME_PAGE'); ?></a></p>
					<hr>
					<p><?php echo Text::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?></p>
					<blockquote>
						<span class="badge bg-secondary"><?php echo $this->error->getCode(); ?></span> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?>
					</blockquote>
					<?php if ($this->debug) : ?>
						<div>
							<?php echo $this->renderBacktrace(); ?>
							<?php // Check if there are more Exceptions and render their data as well ?>
							<?php if ($this->error->getPrevious()) : ?>
								<?php $loop = true; ?>
								<?php // Reference $this->_error here and in the loop as setError() assigns errors to this property and we need this for the backtrace to work correctly ?>
								<?php // Make the first assignment to setError() outside the loop so the loop does not skip Exceptions ?>
								<?php $this->setError($this->_error->getPrevious()); ?>
								<?php while ($loop === true) : ?>
									<p><strong><?php echo Text::_('JERROR_LAYOUT_PREVIOUS_ERROR'); ?></strong></p>
									<p><?php echo htmlspecialchars($this->_error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></p>
									<?php echo $this->renderBacktrace(); ?>
									<?php $loop = $this->setError($this->_error->getPrevious()); ?>
								<?php endwhile; ?>
								<?php // Reset the main error object to the base error ?>
								<?php $this->setError($this->error); ?>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

<?php if ($this->countModules('footer-a', true)) : ?>
<footer class="container-footer uk-background-secondary uk-text-muted uk-padding">
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
<?php endif; ?>

	<jdoc:include type="modules" name="debug" style="none" />
</div><!-- #page -->

<div id="offcanvas-nav" uk-offcanvas="overlay: true">
    <div class="uk-offcanvas-bar">
        <?php if ($this->countModules('offcanvas', true) || $this->countModules('search', true)) : ?>
					
			<?php if ($this->countModules('offcanvas', true)) : ?>
				<button class="uk-offcanvas-close" type="button" uk-close></button>
				<jdoc:include type="modules" name="offcanvas" style="none" />
			<?php endif; ?>
			<?php if ($this->countModules('search', true)) : ?>
				<div class="container-search">
					<jdoc:include type="modules" name="search" style="none" />
				</div>
			<?php endif; ?>
					
		<?php endif; ?>
    </div>
</div>
</body>
</html>
