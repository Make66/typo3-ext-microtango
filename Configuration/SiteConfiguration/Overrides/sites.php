<?php

// Prevent script from being called directly
defined('TYPO3') or die();

$newColumns = [
    'mtSiteActive' => [
        'label' => 'Site-Einstellungen verwenden',
        'description' => 'Überschreibt die globalen Extension-Einstellungen',
        'onChange' => 'reload',
        'config' => [
            'type' => 'check',
        ],
    ],
    'mtShowAdvanced' => [
        'label' => 'Erweiterte-Einstellungen',
        'description' => 'Zeigt die erweiterten Einstellungen an',
        'displayCond' => 'FIELD:mtSiteActive:=:1',
        'onChange' => 'reload',
        'config' => [
            'type' => 'check',
        ],
    ],
    'mtRestKey' => [
        'label' => 'REST-Key',
        'description' => 'Bei DMS anfordern',
        'displayCond' => 'FIELD:mtSiteActive:=:1',
        'config' => [
            'type' => 'input',
            'eval' => 'trim'
        ],
    ],
    'mtLoadCss' => [
        'label' => 'CSS laden',
        'description' => 'Lädt kundenspezifische Styles',
        'displayCond' => 'FIELD:mtSiteActive:=:1',
        'config' => [
            'type' => 'check',
            'rows' => 2,
        ],
    ],
    'mtLoadTemplate' => [
        'label' => 'Templates laden',
        'description' => 'Lädt kundenspezifische Templates',
        'displayCond' => 'FIELD:mtSiteActive:=:1',
        'config' => [
            'type' => 'check',
        ],
    ],
    'mtDefaultRowTemplate' => [
        'label' => 'Standard Kurs-Template',
        'description' => 'z.B.: Kurs|{{Subject}}#Start|{{ScheduleInfo}} {{StartDateText}}#Von|{{Timespan}} Uhr#Stunden|{{RepeatCount}}#|{{AttendButton}}. Hier gibt es die möglichen Werte: https://api.microtango.de/swagger',
        'displayCond' => [
            'AND' => [
                'FIELD:mtSiteActive:=:1',
                'FIELD:mtShowAdvanced:=:1',
            ]
        ],
        'config' => [
            'type' => 'input',
            'size' => '50',
            'eval' => 'trim'
        ],
    ],
    'mtDefaultVideoRowTemplate' => [
        'label' => 'Standard Video-Template',
        'description' => 'z.B.: |{{VideoThumbnail}}#Name|{{Name}}#Beschreibung|{{Description}}#Länge|{{Length}}#|{{ShowVideo}}. Hier gibt es die möglichen Werte: https://api.microtango.de/swagger',
        'displayCond' => [
            'AND' => [
                'FIELD:mtSiteActive:=:1',
                'FIELD:mtShowAdvanced:=:1',
            ]
        ],
        'config' => [
            'type' => 'input',
            'size' => '50',
            'eval' => 'trim'
        ],
    ],
    'mtPleaseWaitText' => [
        'label' => 'Text "Bitte warten"',
        'description' => 'Standard: Lade...',
        'displayCond' => [
            'AND' => [
                'FIELD:mtSiteActive:=:1',
                'FIELD:mtShowAdvanced:=:1',
            ]
        ],
        'config' => [
            'type' => 'input',
            'eval' => 'trim'
        ],
    ],
    'mtCourseNotFoundText' => [
        'label' => 'Text "Kein Kurs gefunde"',
        'description' => 'Standard: <h3>Keine aktuellen Kurse vorhanden</h3>',
        'displayCond' => [
            'AND' => [
                'FIELD:mtSiteActive:=:1',
                'FIELD:mtShowAdvanced:=:1',
            ]
        ],
        'config' => [
            'type' => 'input',
            'eval' => 'trim'
        ],
    ],
    'mtAttendText' => [
        'label' => 'Text "Anmelden"',
        'description' => 'Standard: Anmelden',
        'displayCond' => [
            'AND' => [
                'FIELD:mtSiteActive:=:1',
                'FIELD:mtShowAdvanced:=:1',
            ]
        ],
        'config' => [
            'type' => 'input',
            'eval' => 'trim'
        ],
    ],
    'mtNearlyBookedText' => [
        'label' => 'Text "Kurs ist fast ausgebucht"',
        'description' => 'Standard: Wenig Plätze',
        'displayCond' => [
            'AND' => [
                'FIELD:mtSiteActive:=:1',
                'FIELD:mtShowAdvanced:=:1',
            ]
        ],
        'config' => [
            'type' => 'input',
            'eval' => 'trim'
        ],
    ],
    'mtFullyBookedText' => [
        'label' => 'Text "Kurs ist ausgebucht"',
        'description' => 'Standard: Ausgebucht',
        'displayCond' => [
            'AND' => [
                'FIELD:mtSiteActive:=:1',
                'FIELD:mtShowAdvanced:=:1',
            ]
        ],
        'config' => [
            'type' => 'input',
            'eval' => 'trim'
        ],
    ],
    'mtReservationText' => [
        'label' => 'Text "Reservierungen"',
        'description' => 'Standard: Meine Reservierungen',
        'displayCond' => [
            'AND' => [
                'FIELD:mtSiteActive:=:1',
                'FIELD:mtShowAdvanced:=:1',
            ]
        ],
        'config' => [
            'type' => 'input',
            'eval' => 'trim'
        ],
    ],
    'mtLoginText' => [
        'label' => 'Text "Einloggen"',
        'description' => 'Standard: Einloggen',
        'displayCond' => [
            'AND' => [
                'FIELD:mtSiteActive:=:1',
                'FIELD:mtShowAdvanced:=:1',
            ]
        ],
        'config' => [
            'type' => 'input',
            'eval' => 'trim'
        ],
    ],
    'mtVideoNotFoundText' => [
        'label' => 'Text "Kein Video gefunden"',
        'description' => 'Standard: <h3>Keine Videos vorhanden</h3>',
        'displayCond' => [
            'AND' => [
                'FIELD:mtSiteActive:=:1',
                'FIELD:mtShowAdvanced:=:1',
            ]
        ],
        'config' => [
            'type' => 'input',
            'eval' => 'trim'
        ],
    ],
    'mtShowVideoText' => [
        'label' => 'Text "Video anzeigen"',
        'description' => 'Standard: Abspielen',
        'displayCond' => [
            'AND' => [
                'FIELD:mtSiteActive:=:1',
                'FIELD:mtShowAdvanced:=:1',
            ]
        ],
        'config' => [
            'type' => 'input',
            'eval' => 'trim'
        ],
    ],
    'mtCourseRowTemplate1' => [
        'label' => 'Kurs-Template 1',
        'displayCond' => [
            'AND' => [
                'FIELD:mtSiteActive:=:1',
                'FIELD:mtShowAdvanced:=:1',
            ]
        ],
        'config' => [
            'type' => 'input',
            'eval' => 'trim'
        ],
    ],
    'mtCourseRowTemplate2' => [
        'label' => 'Kurs-Template 2',
        'displayCond' => [
            'AND' => [
                'FIELD:mtSiteActive:=:1',
                'FIELD:mtShowAdvanced:=:1',
            ]
        ],
        'config' => [
            'type' => 'input',
            'eval' => 'trim'
        ],
    ],
    'mtCourseRowTemplate3' => [
        'label' => 'Kurs-Template 3',
        'displayCond' => [
            'AND' => [
                'FIELD:mtSiteActive:=:1',
                'FIELD:mtShowAdvanced:=:1',
            ]
        ],
        'config' => [
            'type' => 'input',
            'eval' => 'trim'
        ],
    ],
    'mtCourseRowTemplate4' => [
        'label' => 'Kurs-Template 4',
        'displayCond' => [
            'AND' => [
                'FIELD:mtSiteActive:=:1',
                'FIELD:mtShowAdvanced:=:1',
            ]
        ],
        'config' => [
            'type' => 'input',
            'eval' => 'trim'
        ],
    ],
    'mtCourseRowTemplate5' => [
        'label' => 'Kurs-Template 5',
        'displayCond' => [
            'AND' => [
                'FIELD:mtSiteActive:=:1',
                'FIELD:mtShowAdvanced:=:1',
            ]
        ],
        'config' => [
            'type' => 'input',
            'eval' => 'trim'
        ],
    ],
    'mtCourseRowTemplate6' => [
        'label' => 'Kurs-Template 6',
        'displayCond' => [
            'AND' => [
                'FIELD:mtSiteActive:=:1',
                'FIELD:mtShowAdvanced:=:1',
            ]
        ],
        'config' => [
            'type' => 'input',
            'eval' => 'trim'
        ],
    ],
    'mtCourseRowTemplate7' => [
        'label' => 'Kurs-Template 7',
        'displayCond' => [
            'AND' => [
                'FIELD:mtSiteActive:=:1',
                'FIELD:mtShowAdvanced:=:1',
            ]
        ],
        'config' => [
            'type' => 'input',
            'eval' => 'trim'
        ],
    ],
    'mtCourseRowTemplate8' => [
        'label' => 'Kurs-Template 8',
        'displayCond' => [
            'AND' => [
                'FIELD:mtSiteActive:=:1',
                'FIELD:mtShowAdvanced:=:1',
            ]
        ],
        'config' => [
            'type' => 'input',
            'eval' => 'trim'
        ],
    ],
    'mtCourseRowTemplate9' => [
        'label' => 'Kurs-Template 9',
        'displayCond' => [
            'AND' => [
                'FIELD:mtSiteActive:=:1',
                'FIELD:mtShowAdvanced:=:1',
            ]
        ],
        'config' => [
            'type' => 'input',
            'eval' => 'trim'
        ],
    ],
];

$newPalettes = [
    'mt_default' => [
        'showitem' => 'mtSiteActive, mtShowAdvanced',
    ],
    'mt_basic' => [
        'label' => 'Einstellungen:',
        'showitem' => 'mtRestKey, --linebreak--, mtLoadCss, mtLoadTemplate',
    ],
    'mt_advanced' => [
        'label' => 'Erweiterte-Einstellungen:',
        'showitem' => 'mtDefaultRowTemplate, --linebreak--, mtDefaultVideoRowTemplate, --linebreak--, mtPleaseWaitText, mtCourseNotFoundText, --linebreak--, mtAttendText, mtNearlyBookedText, --linebreak--, mtFullyBookedText, mtReservationText, --linebreak--, mtLoginText, mtVideoNotFoundText, --linebreak--, mtShowVideoText',
    ],
    'mt_templates' => [
        'label' => 'Templates:',
        'showitem' => 'mtCourseRowTemplate1, mtCourseRowTemplate2, --linebreak--, mtCourseRowTemplate3, mtCourseRowTemplate4, --linebreak--, mtCourseRowTemplate5, mtCourseRowTemplate6, --linebreak--, mtCourseRowTemplate7, mtCourseRowTemplate8, --linebreak--, mtCourseRowTemplate9',
    ],
];


$GLOBALS['SiteConfiguration']['site']['columns'] = array_merge_recursive(
    $GLOBALS['SiteConfiguration']['site']['columns'],
    $newColumns
);

$GLOBALS['SiteConfiguration']['site']['palettes'] = array_merge_recursive(
    $GLOBALS['SiteConfiguration']['site']['palettes'],
    $newPalettes
);


$GLOBALS['SiteConfiguration']['site']['types']['0']['showitem'] .= ',--div--;Microtango, --palette--;;mt_default, --palette--;;mt_basic, --palette--;;mt_advanced, --palette--;;mt_templates';
