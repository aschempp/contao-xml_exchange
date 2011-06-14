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
 * Table tl_xml_exchange
 */
$GLOBALS['TL_DCA']['tl_xml_exchange'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'					=> 'Table',
		'enableVersioning'				=> true,
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'						=> 1,
			'fields'					=> array('name'),
			'flag'						=> 1,
			'panelLayout'				=> 'filter;search,limit',
		),
		'label' => array
		(
			'fields'					=> array('name', 'type'),
			'format'					=> '%s <span style="color:#b3b3b3; padding-left:3px;">[%s]</span>',
		),
		'global_operations' => array
		(
			'import' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_xml_exchange']['import'],
				'href'					=> 'key=import',
				'class'					=> 'header_import',
				'attributes'			=> 'onclick="Backend.getScrollOffset();"'
			),
			'all' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'					=> 'act=select',
				'class'					=> 'header_edit_all',
				'attributes'			=> 'onclick="Backend.getScrollOffset();"'
			),
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_xml_exchange']['edit'],
				'href'					=> 'act=edit',
				'icon'					=> 'edit.gif'
			),
			'copy' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_xml_exchange']['copy'],
				'href'					=> 'act=copy',
				'icon'					=> 'copy.gif'
			),
			'delete' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_xml_exchange']['delete'],
				'href'					=> 'act=delete',
				'icon'					=> 'delete.gif',
				'attributes'			=> 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_xml_exchange']['show'],
				'href'					=> 'act=show',
				'icon'					=> 'show.gif'
			),
			'export' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_xml_exchange']['export'],
				'href'					=> 'key=export',
				'icon'					=> 'system/modules/xml_exchange/html/export.png',
			),
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'					=> array('type'),
		'default'						=> '{name_legend},type,name',
		'pagetree'						=> '{name_legend},type,name;{export_legend},pageTree,inherit,pages,articles,contentElements',
	),

	// Fields
	'fields' => array
	(
		'type' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_xml_exchange']['type'],
			'default'					=> 'pagetree',
			'inputType'					=> 'select',
			'options'					=> array('pagetree'),
			'reference'					=> &$GLOBALS['TL_LANG']['tl_xml_exchange']['type'],
			'eval'						=> array('mandatory'=>true, 'submitOnChange'=>true, 'tl_class'=>'clr'),
		),
		'name' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_xml_exchange']['name'],
			'inputType'					=> 'text',
			'eval'						=> array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'clr'),
		),
		'pageTree' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_xml_exchange']['pageTree'],
			'inputType'					=> 'pageTree',
			'eval'						=> array('mandatory'=>true, 'fieldType'=>'checkbox', 'tl_class'=>'clr'),
		),
		'inherit' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_xml_exchange']['inherit'],
			'inputType'					=> 'checkbox',
			'eval'						=> array('tl_class'=>'w50'),
		),
		'pages' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_xml_exchange']['pages'],
			'inputType'					=> 'checkbox',
			'eval'						=> array('tl_class'=>'w50'),
		),
		'articles' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_xml_exchange']['articles'],
			'inputType'					=> 'checkbox',
			'eval'						=> array('tl_class'=>'w50'),
		),
		'contentElements' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_xml_exchange']['contentElements'],
			'inputType'					=> 'checkbox',
			'eval'						=> array('tl_class'=>'w50'),
		),
		'source' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_xml_exchange']['source'],
			'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'filesOnly'=>true, 'extensions'=>'xml', 'class'=>'mandatory')
		)
	)
);

