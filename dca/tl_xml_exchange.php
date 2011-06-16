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
		'module'						=> '{name_legend},type,name;{export_legend},module,moduleFields;'
	),

	// Fields
	'fields' => array
	(
		'type' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_xml_exchange']['type'],
			'default'					=> 'pagetree',
			'inputType'					=> 'select',
			'options'					=> array('pagetree', 'module'),
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
			'options_callback'			=> array('tl_xml_exchange', 'getPages'),
			'eval'						=> array('tl_class'=>'clr', 'multiple'=>true),
		),
		'articles' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_xml_exchange']['articles'],
			'inputType'					=> 'checkbox',
			'options_callback'			=> array('tl_xml_exchange', 'getArticles'),
			'eval'						=> array('tl_class'=>'clr', 'multiple'=>true),
		),
		'contentElements' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_xml_exchange']['contentElements'],
			'inputType'					=> 'checkbox',
			'options_callback'			=> array('tl_xml_exchange', 'getContentElements'),
			'eval'						=> array('tl_class'=>'clr', 'multiple'=>true),
		),
		'source' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_xml_exchange']['source'],
			'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'filesOnly'=>true, 'extensions'=>'xml', 'class'=>'mandatory')
		),
		'module' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_xml_exchange']['module'],
			'inputType'					=> 'checkbox',
			'options_callback'			=> array('tl_xml_exchange', 'getModule'),
			'eval'						=> array('tl_class'=>'clr', 'multiple'=>true),
		),
		'moduleFields' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_xml_exchange']['moduleFields'],
			'inputType'					=> 'checkbox',
			'options_callback'			=> array('tl_xml_exchange', 'getModuleFields'),
			'eval'						=> array('tl_class'=>'clr', 'multiple'=>true),
		),
	)
);

/**
 * Provide helper methods for the DCA tl_xml_exchange
 */
class tl_xml_exchange extends Backend
{
	/**
	 * return all fields in tl_page
	 */
	public function getPages()
	{
		return $this->getOptionData('tl_page');
	}


	/**
	 * return all fields in tl_article
	 */
	public function getArticles()
	{
		return $this->getOptionData('tl_article');
	}


	/**
	 * return all fields in tl_content
	 */
	public function getContentElements()
	{
		return $this->getOptionData('tl_content');
	}


	/**
	 * return all modules sorted by the themes
	 */
	public function getModule()
	{
		$arrReturn = array();
		$objThemes = $this->Database->query('SELECT * FROM tl_theme');
		
		while ($objThemes->next())
		{
			$objThemeModules = $this->Database->prepare('SELECT id,name,type FROM tl_module WHERE pid=?')
											  ->executeUncached($objThemes->id);

			$arrTemp = array();
			while($objThemeModules->next())
			{
				$arrTemp[$objThemeModules->id] = $objThemeModules->name . ' <span style="color:#b3b3b3; padding-left:3px;">[' . $GLOBALS['TL_LANG']['FMD'][$objThemeModules->type][0] . ']</span>';
			}

			$arrReturn[$objThemes->name] = $arrTemp;
			unset($arrTemp);
		}
		
		return $arrReturn;
	}


	/**
	 * return all fields in tl_module
	 */
	public function getModuleFields()
	{
		return $this->getOptionData('tl_module');
	}


	/**
	 * Return all dca fields from a dca
	 * 
	 * @param string $strName
	 * @return array
	 */
	protected function getOptionData($strName)
	{
		$this->loadDataContainer($strName);
		$this->loadLanguageFile($strName);
		$arrReturn = array();

		foreach ($GLOBALS['TL_DCA'][$strName]['fields'] as $k=>$v)
		{
			$arrReturn[$k] = $v['label'][0];
		}

		return $arrReturn;
	}
}
?>