<?php
/**
 * @version		$Id: index.php 147 2013-10-06 08:58:34Z michel $
 * @copyright	Copyright (C) ##year##, ##author##. All rights reserved.
 * @license ###license##
 */ 
defined( '_JEXEC' ) or die;

$option   = JRequest::getVar('option', '');
$view     = JRequest::getVar('view', '');
$layout   = JRequest::getVar('layout', '');
$task     = JRequest::getVar('task', '');
JHTML::_('behavior.modal');

$showRightColumn = ($this->countModules('position-5') or $this->countModules('position-6') or $this->countModules('position-7'));
$showRightColumn =  ($layout == 'edit'  || $task == 'edit' || $layout == 'form') ? false : $showRightColumn;

$rightcols = $this->params->get("right_columns", "5");
$leftcols = ($showRightColumn) ? 12 - $rightcols: 12;

$template_style = $this->params->get("style", "") ?  $this->params->get("style", "") : "black";

$header_desc = $this->params->get("sitedescription", "");

?>
<!DOCTYPE html>
<html lang="de">

<head>
<meta charset="utf-8">
<jdoc:include type="head" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet"
	href="<?php echo $this->baseurl; ?>/templates/system/css/system.css"
	type="text/css" />
<link rel="stylesheet"
	href="<?php echo $this->baseurl; ?>/templates/system/css/general.css"
	type="text/css" />
<link rel="stylesheet"
	href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template ?>/css/template-<?php echo $template_style; ?>.css"
	type="text/css" />
<link rel="stylesheet"
	href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template ?>/css/responsive.css"
	type="text/css" />
<link
	href='http://fonts.googleapis.com/css?family=Asap:400,400italic,700,700italic'
	rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300italic'
	rel='stylesheet' type='text/css'>

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->


</head>
<body
	class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task');
?>">
	<div class="body">
		<div class="container">
				<!-- Header -->
			<div class="header" id="gradient">
				<div class="header-inner">
					<a class="brand pull-left" href="<?php echo JUri::base()?>"> <img id="logo" src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template ?>/images/logo.png" />
					</a>
					<?php if($header_desc): ?>
					<h1 class="brand"><?php echo $header_desc; ?></h1>
					<?php endif; ?>
					<div class="clearfix"></div>
				</div>
			</div>		
			<jdoc:include type="modules" name="position-1" style="xhtml" />			
			<div class="navigation">
				<div class="container">
					<div id="topmenu">
						<jdoc:include type="modules" name="position-0" style="none" />
					</div>
				</div>
			</div>
		</div>
		<div style="margin-top: -20px;" class="clearfix"></div>
		<div id="content" class="container content">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span<?php echo $leftcols; ?> left-col">
						<jdoc:include type="message" />
						<jdoc:include type="modules" name="position-2" style="xhtml" />						
						<jdoc:include type="component" />
						<jdoc:include type="modules" name="position-3" style="xhtml" />
						<jdoc:include type="modules" name="position-4" style="xhtml" />													
					</div>
					<?php if($showRightColumn): ?>
						<div class="span<?php echo $rightcols; ?> right-col">
							<jdoc:include type="modules" name="position-5" style="xhtml" />
							<jdoc:include type="modules" name="position-6" style="xhtml" />
							<jdoc:include type="modules" name="position-7" style="xhtml" />
						</div>
					<?php endif;?>	
				</div>
			</div>			
		</div>		
	<div class="footer">
		<div class="container">
			<hr />
			<jdoc:include type="modules" name="footer" style="none" />
		</div>
	</div>
	<jdoc:include type="modules" name="debug" style="none" />				
	</div>	
</body>