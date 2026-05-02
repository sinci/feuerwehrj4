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

/** @var Joomla\CMS\Document\HtmlDocument $this */

$app = Factory::getApplication();
$wa  = $this->getWebAssetManager();

// Override 'template.active' asset to set correct ltr/rtl dependency
$wa->registerStyle('template.active', '', [], [], ['template.feuerwehrj4.' . ($this->direction === 'rtl' ? 'rtl' : 'ltr')]);

// Browsers support SVG favicons
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon.svg', '', [], true, 1), 'icon', 'rel', ['type' => 'image/svg+xml']);
$this->addHeadLink(HTMLHelper::_('image', 'favicon.ico', '', [], true, 1), 'alternate icon', 'rel', ['type' => 'image/vnd.microsoft.icon']);
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon-pinned.svg', '', [], true, 1), 'mask-icon', 'rel', ['color' => '#000']);

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
<body class="<?php echo $this->direction === 'rtl' ? 'rtl' : ''; ?>">
	<jdoc:include type="message" />
	<jdoc:include type="component" />
</body>
</html>
