<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

// Prevent script from being called directly
defined('TYPO3') or die();

(static function() {
    ExtensionUtility::registerPlugin(
        'Microtango',
        'Course',
        'Microtango Kurse',
        'EXT:microtango/Resources/Public/Icons/course.svg'
     );

     ExtensionUtility::registerPlugin(
        'Microtango',
        'Video',
        'Microtango Videos',
        'EXT:microtango/Resources/Public/Icons/video.svg'
     );

     ExtensionUtility::registerPlugin(
        'Microtango',
        'Reservation',
        'Microtango Reservierung',
        'EXT:microtango/Resources/Public/Icons/reservation.svg'
     );
 })();

 $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['microtango_course'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    // plugin signature: <extension key without underscores> '_' <plugin name in lowercase>
    'microtango_course',
    // Flexform configuration schema file
    'FILE:EXT:microtango/Configuration/FlexForms/Course.xml'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['microtango_video'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    // plugin signature: <extension key without underscores> '_' <plugin name in lowercase>
    'microtango_video',
    // Flexform configuration schema file
    'FILE:EXT:microtango/Configuration/FlexForms/Video.xml'
);
