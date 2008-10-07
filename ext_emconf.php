<?php

########################################################################
# Extension Manager/Repository config file for ext: "pedantic"
#
# Auto generated 07-10-2008 14:58
#
# Manual updates:
# Only the data in the array - anything else is removed by next write.
# "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Pedantic',
	'description' => 'Run select extensions and files in strict mode: Choose whether notices, warnings and strict errors should be reported. Obeys devIPmask. This is a developer tool.',
	'category' => 'misc',
	'shy' => '',
	'author' => 'Mikkel Ricky & Kasper Ligaard',
	'author_email' => 'mri@systime.dk',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => '',
	'version' => '2.0.3',
	'constraints' => array(
		'depends' => array(
			'php' => '5.2.3-0.0.0',
			'typo3' => '4.2-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
			'devlog' => '2.4-0.0.0',
			'cc_debug' => '1.0-0.0.0',
		),
	),
	'_md5_values_when_last_written' => 'a:5:{s:10:"README.txt";s:4:"bc97";s:21:"ext_conf_template.txt";s:4:"8a14";s:12:"ext_icon.gif";s:4:"efa9";s:17:"ext_localconf.php";s:4:"4b0d";s:14:"doc/manual.sxw";s:4:"1723";}',
	'suggests' => array(
	),
);

?>