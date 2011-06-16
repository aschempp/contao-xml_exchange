<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Andreas Schempp 2011
 * @author     Andreas Schempp <andreas@schempp.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 * @version    $Id$
 */



/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_xml_exchange']['name']				= array('Name', 'Please enter a name for this XML export.');
$GLOBALS['TL_LANG']['tl_xml_exchange']['type']				= array('Type', 'Select the export type');
$GLOBALS['TL_LANG']['tl_xml_exchange']['pageTree']			= array('Page Tree', 'Select the pages you want to include in the export.');
$GLOBALS['TL_LANG']['tl_xml_exchange']['inherit']			= array('Inherit pages', 'Check here to include child records of the selected pages.');
$GLOBALS['TL_LANG']['tl_xml_exchange']['pages']				= array('Export pages', 'Export tl_page data.');
$GLOBALS['TL_LANG']['tl_xml_exchange']['articles']			= array('Export articles', 'Export tl_article data.');
$GLOBALS['TL_LANG']['tl_xml_exchange']['contentElements']	= array('Export content elements', 'Export tl_content data.');
$GLOBALS['TL_LANG']['tl_xml_exchange']['source']			= array('XML file', 'Please select the XML file from your files.');
$GLOBALS['TL_LANG']['tl_xml_exchange']['module']			= array('Module', 'Please select all modules you want in your XML Export.');
$GLOBALS['TL_LANG']['tl_xml_exchange']['moduleFields']		= array('Module fields', 'Please select all fields you want in your XML export.');



/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_xml_exchange']['new']			= array('New XML export', 'Create a new XML export');
$GLOBALS['TL_LANG']['tl_xml_exchange']['edit']			= array('Edit XML export', 'Edit XML export ID %s');
$GLOBALS['TL_LANG']['tl_xml_exchange']['copy']			= array('Duplicate XML export', 'Duplicate XML export ID %s');
$GLOBALS['TL_LANG']['tl_xml_exchange']['delete']		= array('Delete XML export', 'Delete XML export ID %s');
$GLOBALS['TL_LANG']['tl_xml_exchange']['show']			= array('XML export details', 'Show details of XML export ID %s');
$GLOBALS['TL_LANG']['tl_xml_exchange']['export']		= array('Export XML', 'Export XML data to file');
$GLOBALS['TL_LANG']['tl_xml_exchange']['import']		= array('Import XML', 'Import XML data from file');


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_xml_exchange']['name_legend']		= 'Name & Type';
$GLOBALS['TL_LANG']['tl_xml_exchange']['export_legend']	= 'Export Settings';


/**
 * References
 */
$GLOBALS['TL_LANG']['tl_xml_exchange']['type']['pagetree']	= 'Pages/Articles/Content Elements';
$GLOBALS['TL_LANG']['tl_xml_exchange']['type']['module']	= 'Modules';
$GLOBALS['TL_LANG']['tl_xml_exchange']['confirmImport']		= 'Confirm XML import';
$GLOBALS['TL_LANG']['tl_xml_exchange']['fieldInTable']		= 'Updating %s rows in table "%s".';

