<?php
declare(strict_types=1);
namespace DMS\Microtango\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class MicrotangoController extends ActionController
{
    const DEFAULTCOLUMNS = 'Kurs|{{Subject}}#Start|{{ScheduleInfo}} {{StartDateText}}#Von|{{Timespan}} Uhr#Stunden|{{RepeatCount}}#|{{AttendButton}}';
    const DEFAULTVIDEOCOLUMNS = '|{{VideoThumbnail}}#Name|{{Name}}#Beschreibung|{{Description}}#Länge|{{Length}}#|{{ShowVideo}}';

    public function courseAction() //: ResponseInterface
    {
        $config = MicrotangoController::getConfiguration();

        $templateid = 'mtuserdefined' . rand(10000000, 99999999);

        switch ($this->settings['templateType']) {
            default:
            case "default":
                $columns = $config['defaultrowtemplate'];
                break;
            case "template1":
                $columns = $config['courserowtemplate1'];
                break;
            case "template2":
                $columns = $config['courserowtemplate2'];
                break;
            case "template3":
                $columns = $config['courserowtemplate3'];
                break;
            case "template4":
                $columns = $config['courserowtemplate4'];
                break;
            case "template5":
                $columns = $config['courserowtemplate5'];
                break;
            case "template6":
                $columns = $config['courserowtemplate6'];
                break;
            case "template7":
                $columns = $config['courserowtemplate7'];
                break;
            case "template8":
                $columns = $config['courserowtemplate8'];
                break;
            case "template9":
                $columns = $config['courserowtemplate9'];
                break;
            case "individual":
                $columns = $this->settings['rowTemplate'];
                break;
            case "id":
                $columns = $config['defaultrowtemplate'];
                $templateid = $this->settings['templateId'];
                break;
        }

        $columns = "\"" . str_replace("#", "\", \"", $columns) . "\"";

        $this->view->assign('columns', $columns);
        $this->view->assign('webcategory', $this->settings['webCategory']);
        $this->view->assign('orderby', $this->settings['orderBy']);
        $this->view->assign('category', $this->settings['category']);
        $this->view->assign('templateid', $templateid);
        $this->view->assign('backendConfiguration', $config);
        
        if (version_compare(TYPO3_version, '11.0.0', '>='))
            return $this->htmlResponse();
    }

    public function reservationAction() //: ResponseInterface
    {
        $config = MicrotangoController::getConfiguration();

        $columns = $this->settings['rowTemplate'] ?: $config['defaultrowtemplate'];
        $columns = "\"" . str_replace("#", "\", \"", $columns) . "\"";

        $this->view->assign('columns', $columns);
        $this->view->assign('backendConfiguration', $config);

        if (version_compare(TYPO3_version, '11.0.0', '>='))
            return $this->htmlResponse();
    }

    public function videoAction() //: ResponseInterface
    {
        $config = MicrotangoController::getConfiguration();

        $templateid = 'mtuserdefined' . rand(10000000, 99999999);

        switch ($this->settings['templateType']) {
            default:
            case "default":
                $columns = $config['defaultvideorowtemplate'];
                break;
            case "individual":
                $columns = $this->settings['rowTemplate'];
                break;
            case "id":
                $columns = $config['defaultvideorowtemplate'];
                $templateid = $this->settings['templateId'];
                break;
        }

        $columns = "\"" . str_replace("#", "\", \"", $columns) . "\"";

        $this->view->assign('columns', $columns);
        $this->view->assign('videoGroup', $this->settings['videoGroup']);
        $this->view->assign('templateid', $templateid);
        $this->view->assign('backendConfiguration', $config);

        if (version_compare(TYPO3_version, '11.0.0', '>='))
            return $this->htmlResponse();
    }

    private function getConfiguration()
    {
        $site = version_compare(TYPO3_version, '11.0.0', '>=') ? $this->request->getAttribute('site') : $GLOBALS['TYPO3_REQUEST']->getAttribute('site');

        if(!$site->getAttribute('mtSiteActive'))
        {
            $settings = array_merge($GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['microtango']);
        }
        else
        {
            $settings = [];
            $settings['restkey'] = $site->getAttribute('mtRestKey');
            $settings['loadcss'] = $site->getAttribute('mtLoadCss');
            $settings['loadtemplate'] = $site->getAttribute('mtLoadTemplate');

            if($site->getAttribute('mtShowAdvanced')) {
                $settings['defaultrowtemplate'] = $site->getAttribute('mtDefaultRowTemplate');
                $settings['defaultvideorowtemplate'] = $site->getAttribute('mtDefaultVideoRowTemplate');
                $settings['pleasewaittext'] = $site->getAttribute('mtPleaseWaitText');
                $settings['coursenotfoundtext'] = $site->getAttribute('mtCourseNotFoundText');
                $settings['attendtext'] = $site->getAttribute('mtAttendText');
                $settings['nearlybookedtext'] = $site->getAttribute('mtNearlyBookedText');
                $settings['fullybookedtext'] = $site->getAttribute('mtFullyBookedText');
                $settings['reservationtext'] = $site->getAttribute('mtReservationText');
                $settings['logintext'] = $site->getAttribute('mtLoginText');
                $settings['videonotfoundtext'] = $site->getAttribute('mtVideoNotFoundText');
                $settings['showvideotext'] = $site->getAttribute('mtShowVideoText');
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

        $settings['defaultrowtemplate'] = $settings['defaultrowtemplate'] ?: MicrotangoController::DEFAULTCOLUMNS;
        $settings['defaultvideorowtemplate'] = $settings['defaultvideorowtemplate'] ?: MicrotangoController::DEFAULTVIDEOCOLUMNS;

        return $settings;
    }
}