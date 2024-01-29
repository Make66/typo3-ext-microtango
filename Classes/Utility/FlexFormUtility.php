<?php
declare(strict_types=1);
namespace DMS\Microtango\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
// use TYPO3\CMS\Core\Utility\DebugUtility;
// DebugUtility::debug(object, 'Debug');

class FlexFormUtility
{
    const BASEURI = 'https://api.microtango.de/rest/v1/';
    const DEFAULTCOLUMNS = 'Kurs|{{Subject}}#Start|{{ScheduleInfo}} {{StartDateText}}#Von|{{Timespan}} Uhr#Stunden|{{RepeatCount}}#|{{AttendButton}}';
    const DEFAULTVIDEOCOLUMNS = '|{{VideoThumbnail}}#Name|{{Name}}#Beschreibung|{{Description}}#Länge|{{Length}}#|{{ShowVideo}}';

    public function getWebCategories(array $config)
    {        
        // https://docs.typo3.org/m/typo3/reference-coreapi/main/en-us/ExtensionArchitecture/HowTo/RestRequests/Index.html
        $requestFactory = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Http\RequestFactory::class);
        $uri = FlexFormUtility::BASEURI . $this->getRestKey($config) . '/WebCategories';
        $response = $requestFactory->request($uri, 'GET');

        $this->handleRequestError($response);
        //$content = $response->getBody()->getContents();
        $values = json_decode($response->getBody()->getContents());

        /*
        \nn\t3::debug([
            'uri' => $uri,
            'Status' => $response->getStatusCode(),
            'Content-Type' => $response->getHeaderLine('Content-Type'),
            'content' => $content,
            'json_decode' => json_decode($content),
        ]);
        */

        return $this->convertValuesToSelection($values, $config);
    }

    public function getCategories(array $config)
    {        
        $requestFactory = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Http\RequestFactory::class);
        $response = $requestFactory->request(FlexFormUtility::BASEURI . $this->getRestKey($config) . '/Categories', 'GET');
        $this->handleRequestError($response);
        $values = json_decode($response->getBody()->getContents());

        return $this->convertValuesToSelection($values, $config);
    }

    public function getVideoGroups(array $config)
    {      
        $requestFactory = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Http\RequestFactory::class);  
        $response = $requestFactory->request(FlexFormUtility::BASEURI . $this->getRestKey($config) . '/VideoGroups', 'GET');
        $this->handleRequestError($response);
        $values = json_decode($response->getBody()->getContents());

        return $this->convertValuesToSelection($values, $config);
    }

    public function getCourseTemplateTypes(array $config)
    {     
        $settings = $this->getConfiguration($config);

        $templateList = [];
        $i = 0;

        $templateList[$i++] = ['Standard', 'default'];

        if (!empty($settings['courserowtemplate1']))
            $templateList[$i++] = ['Template 1', 'template1'];

        if (!empty($settings['courserowtemplate2']))
            $templateList[$i++] = ['Template 2', 'template2'];

        if (!empty($settings['courserowtemplate3']))
            $templateList[$i++] = ['Template 3', 'template3'];

        if (!empty($settings['courserowtemplate4']))
            $templateList[$i++] = ['Template 4', 'template4'];

        if (!empty($settings['courserowtemplate5']))
            $templateList[$i++] = ['Template 5', 'template5'];

        if (!empty($settings['courserowtemplate6']))
            $templateList[$i++] = ['Template 6', 'template6'];

        if (!empty($settings['courserowtemplate7']))
            $templateList[$i++] = ['Template 7', 'template7'];

        if (!empty($settings['courserowtemplate8']))
            $templateList[$i++] = ['Template 8', 'template8'];

        if (!empty($settings['courserowtemplate9']))
            $templateList[$i++] = ['Template 9', 'template9'];

        $templateList[$i++] = ['Individuell', 'individual'];
        // $templateList[$i++] = ['ID', 'id'];

        $config['items'] = array_merge($config['items'], $templateList);

        return $config;
    }

    public function getVideoTemplateTypes(array $config)
    {     
        $templateList = [];
        $i = 0;

        $templateList[$i++] = ['Standard', 'default'];
        $templateList[$i++] = ['Individuell', 'individual'];
        // $templateList[$i++] = ['ID', 'id'];

        $config['items'] = array_merge($config['items'], $templateList);

        return $config;
    }

    public function getSortFields(array $config)
    {
        $config['items'] = [
            ['Name', 'name'],
            ['Bezeichnung', 'subject'],
            ['Start Datum', 'startdate'],
            ['Start Datum (absteigend)', 'startdate desc'],
            ['Start Zeit', 'starttime'],
            ['Start Wochentag', 'startweekday'],
            ['Start Wochentag  (absteigend)', 'startweekday desc'],
            ['Ende Datum', 'enddate'],
            ['Ende Datum (absteigend)', 'enddate'],
            ['Ende Zeit', 'endtime'],
            ['Ende Wochentag', 'endweekday desc'],
            ['Ende Wochentag (absteigend)', 'endweekday desc'],
            ['Saal', 'hallname'],
            ['Webkategorie', 'webcategory'],
            ['Kategorie', 'category'],
            ['Verfügbarkeit', 'availability']
        ];

        return $config;
    }

    private function getRestKey($config)
    {
        $config = $this->getConfiguration($config);
        $restKey = trim($config['restkey']);

        if (empty($restKey))
            throw new \RuntimeException('REST-Key not found. Check settings and/or sites configuration.');

        return $restKey;
    }

    private function handleRequestError($response)
    {
        if ($response->getStatusCode() !== 200) {
            throw new \RuntimeException('Returned status code is ' . $response->getStatusCode());
        }

        if (!str_starts_with($response->getHeaderLine('Content-Type'), 'application/json')) {
            throw new \RuntimeException('The request did not return JSON data');
        }
    }

    private function convertValuesToSelection($values, $config)
    {
        $optionList = [];
        $i = 0;

        foreach ($values as $o) {
            $optionList[$i] = [0 => $o, 1 => $o];
            $i++;
        }

        $config['items'] = array_merge($config['items'], $optionList);

        return $config;
    }

    private function getConfiguration($config)
    {
        $pageId = $config['flexParentDatabaseRow']['pid'];
        $siteFinder = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Site\SiteFinder::class);
        $site = $siteFinder->getSiteByPageId($pageId);

        if(!$site->getAttribute('mtSiteActive'))
        {
            $settings = array_merge($GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['microtango']);
        }
        else
        {
            $settings = [];
            $settings['restkey'] = $site->getAttribute('mtRestKey');

            if($site->getAttribute('mtShowAdvanced')) {
                $settings['courserowtemplate1'] = $site->getAttribute('mtCourseRowTemplate1');
                $settings['courserowtemplate2'] = $site->getAttribute('mtCourseRowTemplate2');
                $settings['courserowtemplate3'] = $site->getAttribute('mtCourseRowTemplate3');
                $settings['courserowtemplate4'] = $site->getAttribute('mtCourseRowTemplate4');
                $settings['courserowtemplate5'] = $site->getAttribute('mtCourseRowTemplate5');
                $settings['courserowtemplate6'] = $site->getAttribute('mtCourseRowTemplate6');
                $settings['courserowtemplate7'] = $site->getAttribute('mtCourseRowTemplate7');
                $settings['courserowtemplate8'] = $site->getAttribute('mtCourseRowTemplate8');
                $settings['courserowtemplate9'] = $site->getAttribute('mtCourseRowTemplate9');
            }
        }

        return $settings;
    }
}