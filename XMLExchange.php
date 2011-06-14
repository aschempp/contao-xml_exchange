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


class XMLExchange extends Backend
{
	
	public function importXML($dc)
	{
		if ($this->Input->post('FORM_SUBMIT') == 'tl_xml_import')
		{
			$strSource = $this->Input->post('source', true);

			// Check the file names
			if ($strSource == '')
			{
				$_SESSION['TL_ERROR'][] = $GLOBALS['TL_LANG']['ERR']['all_fields'];
				$this->reload();
			}

			// Skip folders
			if (is_dir(TL_ROOT . '/' . $strSource))
			{
				$_SESSION['TL_ERROR'][] = sprintf($GLOBALS['TL_LANG']['ERR']['importFolder'], basename($strSource));
				$this->reload();
			}

			$objFile = new File($strSource);

			// Skip anything but .xml files
			if ($objFile->extension != 'xml')
			{
				$_SESSION['TL_ERROR'][] = sprintf($GLOBALS['TL_LANG']['ERR']['filetype'], $objFile->extension);
				$this->reload();
			}
			
			if ($this->Input->post('confirm'))
			{
				return $this->executeImport($strSource);
			}
			else
			{
				return $this->confirmImport($strSource);
			}
		}

		$objTree = new FileTree($this->prepareForWidget($GLOBALS['TL_DCA']['tl_xml_exchange']['fields']['source'], 'source', null, 'source', 'tl_xml_exchange'));

		// Return the form
		return '
<div id="tl_buttons">
<a href="'.ampersand(str_replace('&key=import', '', $this->Environment->request)).'" class="header_back" title="'.specialchars($GLOBALS['TL_LANG']['MSC']['backBT']).'" accesskey="b">'.$GLOBALS['TL_LANG']['MSC']['backBT'].'</a>
</div>

<h2 class="sub_headline">'.$GLOBALS['TL_LANG']['tl_xml_exchange']['import'][1].'</h2>'.$this->getMessages().'

<form action="'.ampersand($this->Environment->request, true).'" id="tl_xml_import" class="tl_form" method="post">
<div class="tl_formbody_edit">
<input type="hidden" name="FORM_SUBMIT" value="tl_xml_import" />
<input type="hidden" name="REQUEST_TOKEN" value="'.REQUEST_TOKEN.'">

<div class="tl_tbox block">
  <h3><label for="source">'.$GLOBALS['TL_LANG']['tl_xml_exchange']['source'][0].'</label> <a href="contao/files.php" title="' . specialchars($GLOBALS['TL_LANG']['MSC']['fileManager']) . '" onclick="Backend.getScrollOffset(); Backend.openWindow(this, 750, 500); return false;">' . $this->generateImage('filemanager.gif', $GLOBALS['TL_LANG']['MSC']['fileManager'], 'style="vertical-align:text-bottom;"') . '</a></h3>'.$objTree->generate().(strlen($GLOBALS['TL_LANG']['tl_xml_exchange']['source'][1]) ? '
  <p class="tl_help tl_tip">'.$GLOBALS['TL_LANG']['tl_xml_exchange']['source'][1].'</p>' : '').'
</div>

</div>

<div class="tl_formbody_submit">

<div class="tl_submit_container">
  <input type="submit" name="save" id="save" class="tl_submit" accesskey="s" value="'.specialchars($GLOBALS['TL_LANG']['tl_xml_exchange']['import'][0]).'" />
</div>

</div>
</form>';
	}
	
	
	protected function confirmImport($strFile)
	{
		$return = '
<div id="tl_buttons">
<a href="'.ampersand(str_replace('&key=import', '', $this->Environment->request)).'" class="header_back" title="'.specialchars($GLOBALS['TL_LANG']['MSC']['backBT']).'" accesskey="b">'.$GLOBALS['TL_LANG']['MSC']['backBT'].'</a>
</div>

<h2 class="sub_headline">'.$GLOBALS['TL_LANG']['tl_xml_exchange']['confirmImport'].'</h2>'.$this->getMessages().'

<form action="'.ampersand($this->Environment->request, true).'" id="tl_theme_import" class="tl_form" method="post">
<div class="tl_formbody_edit">
<input type="hidden" name="FORM_SUBMIT" value="tl_xml_import" />
<input type="hidden" name="REQUEST_TOKEN" value="'.REQUEST_TOKEN.'">
<input type="hidden" name="confirm" value="1" />
<input type="hidden" name="source" value="'.$strFile.'" />';

		$return .= '

<div class="tl_'. (($count++ < 1) ? 't' : '') .'box block">
<h3>'. basename($strFile) .'</h3>';

		// Open the XML file
		$xml = new DOMDocument();
		$xml->preserveWhiteSpace = false;
		$xml->load(TL_ROOT . '/' . $strFile);
		$tables = $xml->getElementsByTagName('table');

		// Loop through the tables
		for ($i=0; $i<$tables->length; $i++)
		{
			$rows = $tables->item($i)->childNodes;
			$table = $tables->item($i)->getAttribute('name');

			$fields = $rows->item(0)->childNodes;

			$return .= "\n  " . '<p style="margin:0; color:#c55;">'. sprintf($GLOBALS['TL_LANG']['tl_xml_exchange']['fieldInTable'], $fields->length, $table) .'</p>';
		}

		// Return the form
		return $return . '

</div>
</div>

<div class="tl_formbody_submit">

<div class="tl_submit_container">
  <input type="submit" name="save" id="save" class="tl_submit" accesskey="s" value="'.specialchars($GLOBALS['TL_LANG']['MSC']['continue']).'" />
</div>

</div>
</form>';
	}
	
	
	protected function executeImport($strFile)
	{
		// Count affected rows
		$affected = 0;
		
		// Open the XML file
		$xml = new DOMDocument();
		$xml->preserveWhiteSpace = false;
		$xml->load(TL_ROOT . '/' . $strFile);
		$tables = $xml->getElementsByTagName('table');

		// Loop through the tables
		for ($i=0; $i<$tables->length; $i++)
		{
			$table = $tables->item($i)->getAttribute('name');
			$rows = $tables->item($i)->childNodes;
			
			$this->loadDataContainer($table);
			$arrFields = array_keys($GLOBALS['TL_DCA'][$table]['fields']);

			for ($j=0; $j<$rows->length; $j++)
			{
				$id = $rows->item($j)->getAttribute('id');
				$fields = $rows->item($j)->childNodes;
				$set = array();

				// Loop through the fields
				for ($k=0; $k<$fields->length; $k++)
				{
					$value = $fields->item($k)->nodeValue;
					$name = $fields->item($k)->getAttribute('name');
					
					if (in_array($name, array('id', 'pid', 'sorting', 'tstamp')) || !in_array($name, $arrFields))
					{
						continue;
					}

					$set[$name] = $value;
				}
				
				// Update the database
				$affected += $this->Database->prepare("UPDATE ". $table ." %s WHERE id=?")->set($set)->execute($id)->affectedRows;
			}
		}
		
		$_SESSION['TL_CONFIRM'][] = sprintf('Updated %s records from XML file.', $affected);
		
		$this->reload();
	}
	
	
	public function exportXML($dc)
	{
		$objExport = $this->Database->execute("SELECT * FROM tl_xml_exchange WHERE id=".$dc->id);
		
		switch( $objExport->type )
		{
			case 'pagetree':
				return $this->exportPagetree($objExport);
			
			default:
				return '<p class="tl_gerror">Export type not found.</p>';
		}
	}
	
	
	protected function exportPagetree($objExport)
	{
		// Romanize the name
		$strName = utf8_romanize($objExport->name);
		$strName = strtolower(str_replace(' ', '_', $strName));
		$strName = preg_replace('/[^A-Za-z0-9_-]/', '', $strName);
		$strName = basename($strName);

		// Create a new XML document
		$objXML = new DOMDocument('1.0', 'UTF-8');
		$objXML->formatOutput = true;
		
		// Root element
		$objTables = $objXML->createElement('tables');
		$objTables = $objXML->appendChild($objTables);

		$arrPages = deserialize($objExport->pageTree);
		
		if ($objExport->inherit)
		{
			foreach( $arrPages as $page )
			{
				$arrPages = array_merge($arrPages, $this->getChildRecords($page, 'tl_page'));
			}
		}
		
		if ($objExport->pages)
		{
			$objPages = $this->Database->execute("SELECT * FROM tl_page WHERE id IN (" . implode(',', $arrPages) . ")");
			$this->generateXML($objXML, $objTables, $objPages, 'tl_page');
		}
		
		if ($objExport->articles || $objExport->contentElements)
		{
			$objArticles = $this->Database->execute("SELECT * FROM tl_article WHERE pid IN (" . implode(',', $arrPages) . ")");
			
			if ($objExport->articles && $objArticles->numRows)
			{
				$this->generateXML($objXML, $objTables, $objArticles, 'tl_article');
			}
			
			if ($objExport->contentElements && $objArticles->numRows)
			{
				$objElements = $this->Database->execute("SELECT * FROM tl_content WHERE pid IN (" . implode(',', $objArticles->fetchEach('id')) . ")");
				$this->generateXML($objXML, $objTables, $objElements, 'tl_content');
			}
		}

		$strXML = $objXML->saveXML();

		header('Content-Type: application/imt');
		header('Content-Transfer-Encoding: binary');
		header('Content-Disposition: attachment; filename="' . $strName . '.xml"');
		header('Content-Length: ' . strlen($strXML));
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Expires: 0');

		echo $strXML;

		exit;
	}
	
	
	protected function generateXML(&$objXML, &$objTables, $objResult, $strTable)
	{
		$this->loadDataContainer($strTable);
		$arrFields = array_keys($GLOBALS['TL_DCA'][$strTable]['fields']);
		
		$table = $objXML->createElement('table');
		$table->setAttribute('name', $strTable);
		$table = $objTables->appendChild($table);
		
		while( $objResult->next() )
		{
			$row = $objXML->createElement('row');
			$row->setAttribute('id', $objResult->id);
			$row = $table->appendChild($row);
			
			foreach( $objResult->row() as $k=>$v )
			{
				if (in_array($k, array('id', 'pid', 'sorting', 'tstamp')) || !in_array($k, $arrFields))
					continue;

				$field = $objXML->createElement('field');
				$field->setAttribute('name', $k);
				$field = $row->appendChild($field);
	
				if (is_null($v))
				{
					$v = 'NULL';
				}

				if ($GLOBALS['TL_DCA'][$strTable]['fields'][$k]['eval']['allowHtml'] || $GLOBALS['TL_DCA'][$strTable]['fields'][$k]['eval']['preserveTags'] || $GLOBALS['TL_DCA'][$strTable]['fields'][$k]['eval']['rte'] != '')
				{
					$value = $objXML->createCDATASection($v);
				}
				else
				{
					$value = $objXML->createTextNode($v);
				}
				
				$value = $field->appendChild($value);
			}
		}
	}
}

