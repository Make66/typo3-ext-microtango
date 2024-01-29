<?php

use DMS\Microtango\Controller\MicrotangoController;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') || die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:microtango/Configuration/TsConfig/Wizard.tsconfig">');

$iconRegistry = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$iconRegistry->registerIcon(
   'microtango',
   \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
   ['source' => 'EXT:microtango/Resources/Public/Icons/extension.svg']
);
$iconRegistry->registerIcon(
   'microtango-course',
   \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
   ['source' => 'EXT:microtango/Resources/Public/Icons/course.svg']
);
$iconRegistry->registerIcon(
   'microtango-reservation',
   \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
   ['source' => 'EXT:microtango/Resources/Public/Icons/reservation.svg']
);
$iconRegistry->registerIcon(
   'microtango-video',
   \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
   ['source' => 'EXT:microtango/Resources/Public/Icons/video.svg']
);

(static function() {
    ExtensionUtility::configurePlugin(
        'Microtango',
        'Course',
        [
         MicrotangoController::class => 'course',
        ]
     );

     ExtensionUtility::configurePlugin(
        'Microtango',
        'Video',
        [
         MicrotangoController::class => 'video',
        ]
     );

     ExtensionUtility::configurePlugin(
        'Microtango',
        'Reservation',
        [
         MicrotangoController::class => 'reservation',
        ]
     );
 })();
