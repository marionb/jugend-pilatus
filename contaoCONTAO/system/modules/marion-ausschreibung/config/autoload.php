<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'Contao\ModuleAusschreibungList' => 'system/modules/marion-ausschreibung/ModuleAusschreibungList.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_ausschreibunglist' => 'system/modules/marion-ausschreibung/templates',
));
