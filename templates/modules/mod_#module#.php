<?php
/**
 * @version SVN: $Id: mod_#module#.php 147 2013-10-06 08:58:34Z michel $
 * @package    ##Module##
 * @subpackage Base
 * @author     ##author##
 * @license    ##license##
 */

defined('_JEXEC') or die('Restricted access'); // no direct access

require_once __DIR__ . '/helper.php';
$item = mod##Module##Helper::getItem($params);
require(JModuleHelper::getLayoutPath('mod_##module##'));
require_once ('helper.php');

?>