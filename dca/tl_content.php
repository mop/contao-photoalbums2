<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * @package   photoalbums2
 * @author    Daniel Kiesel <https://github.com/icodr8>
 * @license   LGPL
 * @copyright Daniel Kiesel 2012-2013
 */


/**
 * Table tl_content
 */
$GLOBALS['TL_DCA']['tl_content']['config']['onsubmit_callback'][] = array('Pa2Backend', 'checkTimeFilter');
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][]    = 'pa2TimeFilter';
$GLOBALS['TL_DCA']['tl_content']['palettes']['photoalbums2']      = '{type_legend},type,headline;
																			{config_legend},pa2Album;
																			{pa2Template_legend},pa2ImageViewTemplate,pa2ImagesTemplate,pa2ImagesShowHeadline,pa2ImagesShowTitle,pa2ImagesShowTeaser;
																			{pa2Image_legend},pa2ImagesImageSize,pa2ImagesImageMargin,pa2ImagesPerRow,pa2ImagesPerPage,pa2NumberOfImages;
																			{pa2Meta_legend:hide},pa2ImagesShowMetaDescriptions,pa2ImagesMetaFields;
																			{pa2TimeFilter_legend:hide},pa2TimeFilter;
																			{pa2Other_legend:hide},pa2Teaser;
																			{protected_legend:hide},protected;
																			{expert_legend:hide},guests,cssID,space';

$GLOBALS['TL_DCA']['tl_content']['subpalettes']['pa2TimeFilter'] = 'pa2TimeFilterStart,pa2TimeFilterEnd';

$GLOBALS['TL_DCA']['tl_content']['fields']['pa2Album'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['pa2Album'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('tl_content_photoalbums2', 'getPhotoalbums2Albums'),
	'eval'                    => array('mandatory'=>true, 'chosen'=>true),
	'wizard' => array
	(
		array('tl_content_photoalbums2', 'editAlbum')
	),
	'sql'                     => "int(10) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['pa2ImageViewTemplate'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['pa2ImageViewTemplate'],
	'exclude'                 => true,
	'filter'                  => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 11,
	'inputType'               => 'select',
	'options_callback'        => array('Pa2Backend', 'getPa2WrapTemplates'),
	'eval'                    => array('chosen'=>true, 'tl_class'=>'w50'),
	'sql'                     => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['pa2ImagesTemplate'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['pa2ImagesTemplate'],
	'exclude'                 => true,
	'filter'                  => true,
	'search'                  => true,
	'sorting'                 => true,
	'flag'                    => 11,
	'inputType'               => 'select',
	'options_callback'        => array('Pa2Backend', 'getPa2ImageTemplates'),
	'eval'                    => array('chosen'=>true, 'tl_class'=>'w50'),
	'sql'                     => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['pa2ImagesShowHeadline'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['pa2ImagesShowHeadline'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'default'                 => 1,
	'eval'                    => array('tl_class'=>'clr'),
	'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['pa2ImagesShowTitle'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['pa2ImagesShowTitle'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'default'                 => 1,
	'eval'                    => array('tl_class'=>'clr'),
	'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['pa2ImagesShowTeaser'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['pa2ImagesShowTeaser'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'default'                 => 1,
	'eval'                    => array('tl_class'=>'clr'),
	'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['pa2ImagesImageSize'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['pa2ImagesImageSize'],
	'exclude'                 => true,
	'inputType'               => 'imageSize',
	'options'                 => array('crop', 'proportional', 'box'),
	'reference'               => &$GLOBALS['TL_LANG']['MSC'],
	'eval'                    => array('rgxp'=>'digit', 'nospace'=>true, 'tl_class'=>'w50'),
	'sql'                     => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['pa2ImagesImageMargin'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['pa2ImagesImageMargin'],
	'exclude'                 => true,
	'inputType'               => 'trbl',
	'options'                 => array('px', '%', 'em', 'pt', 'pc', 'in', 'cm', 'mm'),
	'eval'                    => array('includeBlankOption'=>true, 'tl_class'=>'w50'),
	'sql'                     => "varchar(128) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['pa2ImagesPerRow'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['pa2ImagesPerRow'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'default'                 => 2,
	'options'                 => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12),
	'eval'                    => array('mandatory'=>true, 'chosen'=>true, 'tl_class'=>'clr'),
	'sql'                     => "smallint(5) unsigned NOT NULL default '2'"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['pa2ImagesPerPage'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['pa2ImagesPerPage'],
	'default'                 => 24,
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('rgxp'=>'digit', 'tl_class'=>'w50'),
	'sql'                     => "smallint(5) unsigned NOT NULL default '24'"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['pa2NumberOfImages'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['pa2NumberOfImages'],
	'default'                 => 0,
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'tl_class'=>'w50'),
	'sql'                     => "smallint(5) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['pa2ImagesShowMetaDescriptions'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['pa2ImagesShowMetaDescriptions'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'default'                 => 1,
	'eval'                    => array(),
	'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['pa2ImagesMetaFields'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['pa2ImagesMetaFields'],
	'exclude'                 => true,
	'inputType'               => 'checkboxWizard',
	'options'                 => $GLOBALS['pa2']['metaFields'],
	'reference'               => &$GLOBALS['TL_LANG']['pa2']['pa2MetaFieldOptions'],
	'eval'                    => array('multiple'=>true, 'tl_class'=>'cbxes'),
	'sql'                     => "blob NULL"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['pa2TimeFilter'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['pa2TimeFilter'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('submitOnChange'=>true),
	'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['pa2TimeFilterStart'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['pa2TimeFilterStart'],
	'exclude'                 => true,
	'inputType'               => 'timePeriod',
	'default'                 => 'days',
	'options'                 => $GLOBALS['pa2']['timeFilterOptions'],
	'reference'               => &$GLOBALS['TL_LANG']['pa2']['pa2TimeFilterOptions'],
	'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'tl_class'=>'w50'),
	'sql'                     => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['pa2TimeFilterEnd'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['pa2TimeFilterEnd'],
	'exclude'                 => true,
	'inputType'               => 'timePeriod',
	'default'                 => 'days',
	'options'                 => array(/*'seconds', 'minutes', 'hours', */'days', 'weeks', 'months', 'years'),
	'reference'               => &$GLOBALS['TL_LANG']['pa2']['pa2TimeFilterOptions'],
	'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'tl_class'=>'w50'),
	'sql'                     => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['pa2Teaser'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['pa2Teaser'],
	'exclude'                 => true,
	'inputType'               => 'textarea',
	'eval'                    => array('rte'=>'tinyFlash', 'tl_class'=>'long'),
	'sql'                     => "text NULL"
);


/**
 * Class tl_content_photoalbums2
 *
 * @copyright Daniel Kiesel 2012-2013
 * @author    Daniel Kiesel <https://github.com/icodr8>
 * @package   photoalbums2
 */
class tl_content_photoalbums2 extends Pa2Backend
{

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}


	/**
	 * Get all archives from photoalbums2 and return them as array
	 * @return array
	 */
	public function getPhotoalbums2Albums()
	{
		if (!$this->User->isAdmin && !is_array($this->User->photoalbums2s))
		{
			return array();
		}

		$arrArchives = array();
		$objArchives = \Photoalbums2ArchiveModel::findAll(array('order'=>'title'));

		if ($objArchives !== null)
		{
			while ($objArchives->next())
			{
				if ($this->User->isAdmin || $this->User->hasAccess($objArchives->id, 'photoalbums2s'))
				{
					$objAlbums = \Photoalbums2AlbumModel::findBy('pid', $objArchives->id, array('order'=>'title'));

					if ($objAlbums !== null)
					{
						while ($objAlbums->next())
						{
							$arrArchives[$objArchives->title][$objAlbums->id] = $objAlbums->title;
						}
					}
				}
			}
		}

		return $arrArchives;
	}


	/**
	 * Return the edit album wizard
	 * @param DataContainer
	 * @return string
	 */
	public function editAlbum(DataContainer $dc)
	{
		return ($dc->value < 1) ? '' : ' <a href="contao/main.php?do=photoalbums2&amp;table=tl_photoalbums2_album&amp;act=edit&amp;id=' . $dc->value . '&amp;rt=' . REQUEST_TOKEN . '" title="'.sprintf(specialchars($GLOBALS['TL_LANG']['tl_content']['editalias'][1]), $dc->value).'" style="padding-left:3px">' . $this->generateImage('alias.gif', $GLOBALS['TL_LANG']['tl_content']['editalias'][0], 'style="vertical-align:top"') . '</a>';
	}
}
