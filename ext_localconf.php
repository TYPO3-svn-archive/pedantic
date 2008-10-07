<?php defined ('TYPO3_MODE') || die('Access denied.');

$TYPO3_CONF_VARS['EXTCONF'][$_EXTKEY] = unserialize($_EXTCONF);
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$_EXTKEY]['extKeys'] = t3lib_div::trimExplode(',', $GLOBALS['TYPO3_CONF_VARS']['EXTCONF'][$_EXTKEY]['extKeys']);

if (!function_exists('pedantic_errorHandler')) {
	function pedantic_errorHandler($errno, $errstr, $errfile, $errline) {
		$output = false;
		$prefix = 'Warning';

		switch ($errno) {
		case E_NOTICE:
			$output = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['pedantic']['reportNotice'];
			$prefix = 'Notice';
			break;
		case E_WARNING:
			$output = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['pedantic']['reportWarning'];
			$prefix = 'Warning';
			break;
		case E_STRICT:
			$output = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['pedantic']['reportStrict'];
			$prefix = 'Strict';
			break;
		}

		if ($output) {
			$extConf = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['pedantic'];

			// Prevent warnings on old extension module configuration files which redefines a constant (TYPO3_MOD_PATH)
			if (strpos($errfile, '/conf.php') === false) {
				$complain = false;
				if ($extConf['filenamePattern']) {
					if (@preg_match($extConf['filenamePattern'], $errfile)) {
						$complain = true;
					}
				}
				if (!$complain) {
					foreach ($extConf['extKeys'] as $extKey) {
						if (t3lib_extMgm::isLoaded($extKey) && (strpos(t3lib_div::fixWindowsFilePath($errfile), '/'.$extKey.'/') !== false)) {
							$complain = true;
							break;
						}
					}
				}
				if ($complain) {
					switch ($output) {
						case 'disabled':
							// do nothing;
							break;
						case 'inline':
							echo '<pre>'.$prefix.': ['.$errfile.':'.$errline.']: '.$errstr.'</pre>';
							break;
						case 'debug':
							debug($prefix.': ['.$errfile.':'.$errline.']: '.$errstr);
							break;
						case 'devlog':
							$errorArray = array(
								'Error type' => $prefix,
								'Error text' => $errstr,
								'In file' => $errfile,
								'At line nr.' => $errline
							);
							t3lib_div::devLog($prefix.': ['.$errfile.':'.$errline.']: '.$errstr, 'pedantic', 1, $errorArray);
					}
				}
			}
		}
		return false;
	}

	// Add error handler on developer machines
	if (t3lib_div::cmpIP(t3lib_div::getIndpEnv('REMOTE_ADDR'), $GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask'])) {
		set_error_handler('pedantic_errorHandler');
	}
}
?>