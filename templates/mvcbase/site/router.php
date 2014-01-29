<?php
/**
 * @version		$Id:router.php 1 ##date##Z ##sauthor## $
 * @package		##Component##
 * @subpackage 	Router
 * @copyright	Copyright (C) ##year##, ##author##. All rights reserved.
 * @license ###license##
 */  

require_once(JPATH_ADMINISTRATOR.'/components/com_##component##/helpers/##component##.php');
##ifdefCategoriesStart##
require_once JPATH_SITE.'/components/com_##component##/helpers/category.php';
##ifdefCategoriesEnd##
defined('_JEXEC') or die('Restricted access');

  function ##Component##BuildRoute( &$query )
  {
  	$segments = array();
  	  	
  	$catviews = ##Component##Helper::getCategoryViews();
  	
  	$listviews = array_keys($catviews);

	// get a menu item based on Itemid or currently active
	$app = JFactory::getApplication();
	$params = JComponentHelper::getParams('com_##component##');
	$advanced = $params->get('sef_advanced_link', 0);
	$menu = $app->getMenu();

	if (empty($query['Itemid']))
	{
		$menuItem = $menu->getActive();
	}
	else
	{
		$menuItem = $menu->getItem($query['Itemid']);
	}
	$mView = (empty($menuItem->query['view'])) ? null : $menuItem->query['view'];
	$mId = (empty($menuItem->query['id'])) ? null : $menuItem->query['id'];

	if (isset($query['view']))
	{
		$view = $query['view'];
		if (empty($query['Itemid']) || empty($menuItem) || $menuItem->component != 'com_##component##')
		{
			$segments[] = $query['view'];
			unset($query['view']);
		}
		
	}

	// are we dealing with a contact that is attached to a menu item?
	if (isset($view) && ($mView == $view) and (!in_array($view, $listviews)) and (isset($query['id'])) and ($mId == (int) $query['id']))
	{
		unset($query['view']);
		unset($query['category']);
		unset($query['id']);
		return $segments;
	}

	// category (list) views
	if (isset($view) && in_array($view, $listviews))
	{
		$segments[] = $query['view'];
		unset($query['view']);		
		
		if ((isset($query['id']) && ($mId != (int) $query['id'])) || $mView != $view)
		{
			if (isset($query['category']))
			{
				$catid = $query['category'];				 
			}
			elseif (isset($query['id']))
			{
				$catid = $query['id'];
			}
			$menuCatid = $mId;
			
			$options = array('extension'=>$catviews[$view]);
			
			$categories = JCategories::getInstance('##Component##', $options);
			$category = $categories->get((int) $catid);			
			if ($category)
			{
				//TODO Throw error that the category either not exists or is unpublished
				$path = array_reverse($category->getPath());

				$array = array();
				foreach ($path as $id)
				{
					if ((int) $id == (int) $menuCatid)
					{
						break;
					}					
					$array[] = $id;
				}
				$segments = array_merge($segments, array_reverse($array));
			}
		}
		unset($query['id']);
		unset($query['category']);
	} else {
		if(isset($query['view'])) {
			$segments[] = $query['view'];
			unset($query['view']);
		}
		if(isset($query['id'])) {
			$segments[] = $query['id'];
			unset($query['id']);
		}
	}
    
	return $segments;  	
  } // End ##Component##BuildRoute function
  
  function ##Component##ParseRoute( $segments )
  {
  	$vars = array();
  
  	$catviews = ##Component##Helper::getCategoryViews();
  	$extensionviews = array_flip($catviews);
  	$listviews = array_keys($catviews);

  	//Get the active menu item.
  	$app = JFactory::getApplication();
  	
  	$params = JComponentHelper::getParams('com_##component##');
  	$advanced = $params->get('sef_advanced_link', 0);
  	  	
  	$menu = $app->getMenu();
  	
  	$item = $menu->getActive();
  	
  	// Count route segments
  	$count = count($segments);
  	
  	
  	// Standard routing
  	if (!isset($item))
  	{
  		$vars['view'] = $segments[0];
  		$isList = in_array($vars['view'], $listviews);
  		if($isList && $count > 1) {
  			$vars['category'] = $segments[$count - 1];
  		} elseif(!$isList && $count > 1) {
  			$vars['id'] = $segments[$count - 1];
  		}
  	
  		return $vars;
  	}
##ifdefCategoriesStart##  	
  	//if there query has an extension, this must be a category
  	if(isset($item->query['extension'])) {
  			
  		$id = (isset($item->query['id']) && $item->query['id'] > 1) ? $item->query['id'] : 'root';
  		$options = array();
  		$options['extension'] = $item->query['extension'];
  		$##Component##category  = ##Component##Categories::getInstance('##Component##', $options)->get($id);
  	
  		$categories = ($##Component##category) ? $##Component##category->getChildren() : array();
  		$vars['catid'] = $id;
  		$vars['id'] = $id;
  		$found = 0;
  		foreach($segments as $segment)
  		{
  			$segment = $advanced ? str_replace(':', '-', $segment) : $segment;
  			foreach($categories as $category)
  			{
  				if ($category->slug == $segment || $category->alias == $segment)
  				{
  					$vars['id'] = $category->id;
  					$vars['category'] = $category->id;
  					$vars['view'] = $extensionviews[$item->query['extension']];
  					$categories = $category->getChildren();
  					$found = 1;
  					break;
  				}
  			}
  			if ($found == 0)
  			{
  	
  				$nid = $segment;
  	
  				$vars['id'] = $nid;
  				$vars['view'] = $vars['view'] = str_replace('com_##component##.','',$item->query['extension']);
  			}
  			$found = 0;
  	
  		}
  		return $vars;
  	
  	} else {
  		//this must be an item
  		if(count($segments) == 1 && isset($item->query['category']) && isset($item->query['view'])) {
  			//eg. called from the view books the item view is "book"
  			$vars['view'] = substr($item->query['view'],0 ,-1);
  			$vars['id']  = array_pop($segments);
  			return $vars;
  		}
  			
  	}  	
##ifdefCategoriesEnd##   	 	
  	if(count($segments > 0)) {
  		$vars['view'] = $segments[0];
  		switch($vars['view']) {
  			##routerswitch##
  		}
              
    } else {
      $vars['view'] = $segments[0];
    } // End count(segments) statement

    return $vars;
  } // End ##Component##ParseRoute  
?>
