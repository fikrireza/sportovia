<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Kelas;
use App\Models\KelasRuang;
use App\Models\KelasKategori;
use App\Models\KelasProgram;
use App\Models\Fasilitas;
use App\Models\Member;
use App\Models\NewsEvent;
use App\Models\Staff;
use App\Models\Trial;
use App\Models\Facebook;

use DateTime;
use Analytics;
use Spatie\Analytics\Period;

class DashboardController extends Controller
{


    public function index()
    {
        $getMember = Member::get();
        $getClassCourse = Kelas::get();
        $getNews = NewsEvent::where('news_event', 1)->get();
        $getEvent = NewsEvent::where('news_event', 0)->get();

        return view('backend.dashboard.index', compact('getMember', 'getClassCourse', 'getNews', 'getEvent'));
    }

    // Anal Facebook
    public function getFB(){

        $getCode = Facebook::first();

        $fb = new \Facebook\Facebook([
          'app_id' => $getCode->app_id,
          'app_secret' => $getCode->app_secret,
          'default_graph_version' => 'v2.8',
          'default_access_token' => $getCode->default_access_token,
          ]);

        $fb->setDefaultAccessToken($getCode->default_access_token);

         $requestPageImpression = $fb->request('GET', '/'.$getCode->page_id.'/insights/page_impressions?since=1483228800&until=1490918400');

        $requestPageImpressionOrganic = $fb->request('GET', '623577477829239/insights/page_impressions_organic');

        $requestPageView = $fb->request('GET', ''.$getCode->page_id.'/insights/page_views_total');

        $requestGenderAge = $fb->request('GET', ''.$getCode->page_id.'/insights/page_fans_gender_age');

        $requestFanReach = $fb->request('GET', ''.$getCode->page_id.'/insights/post_fan_reach');

        $requestPageEngagedUser = $fb->request('GET', ''.$getCode->page_id.'/insights/page_engaged_users');

        $requestPostEngagedFan = $fb->request('GET', ''.$getCode->page_id.'/insights/post_engaged_fan');

        $batch = [
            'page-impression' => $requestPageImpression,
            'page-impression-organic' => $requestPageImpressionOrganic,
            'page-page-view'  => $requestPageView,
            'page-gender-age' => $requestGenderAge,
            'page-fan-reach'  => $requestFanReach,
            'page-engaged-user' => $requestPageEngagedUser,
            'post-engaged-fan'  => $requestPostEngagedFan,
            ];

        try {
          $responses = $fb->sendBatchRequest($batch);
        }
        catch(Facebook\Exceptions\FacebookResponseException $e) {
          echo 'Graph returned an error: ' . $e->getMessage();
          exit;
        }
        catch(Facebook\Exceptions\FacebookSDKException $e) {
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
        }

        $response = $responses->getResponses();

        foreach ($responses as $key => $response) {
          // page-impression
          if ($key == "page-impression") {
            $pageImpression = $response->getDecodedBody();
            foreach ($pageImpression as $key => $response) {
              if ($key == "data") {
                $checkObj = 0;
                $datas = $response;
                foreach ($datas as $data){
                  if ($checkObj == 0) {
                    $pageImpressionDay = $data;
                  }
                  if ($checkObj == 1) {
                    $pageImpressionWeek = $data;
                  }
                  if ($checkObj == 2) {
                    $pageImpressionMonth = $data;
                  }
                  $checkObj++;
                }
              }
              if ($key == "paging") {
                $pageImpressionPaging = $response;
              }
            }
          }
          // end page-impression

          // page-impression-organic
          if ($key == "page-impression-organic") {
            $pageImpressionOrganic = $response->getDecodedBody();
            foreach ($pageImpressionOrganic as $key => $response) {
              if ($key == "data") {
                $checkObj = 0;
                $datas = $response;
                foreach ($datas as $data){
                  if ($checkObj == 0) {
                    $pageImpressionOrganicDay = $data;
                  }
                  if ($checkObj == 1) {
                    $pageImpressionOrganicWeek = $data;
                  }
                  if ($checkObj == 2) {
                    $pageImpressionOrganicMonth = $data;
                  }
                  $checkObj++;
                }
              }
              if ($key == "paging") {
                $pageImpressionOrganicPaging = $response;
              }
            }
          }
          // end page-impression-organic

          // page-page-view
          if ($key == "page-page-view") {
            $pagePageView = $response->getDecodedBody();
            foreach ($pagePageView as $key => $response) {
              if ($key == "data") {
                $checkObj = 0;
                $datas = $response;
                foreach ($datas as $data){
                  if ($checkObj == 0) {
                    $pagePageViewDay = $data;
                  }
                  if ($checkObj == 1) {
                    $pagePageViewWeek = $data;
                  }
                  if ($checkObj == 2) {
                    $pagePageViewMonth = $data;
                  }
                  $checkObj++;
                }
              }
              if ($key == "paging") {
                $pagePageViewPaging = $response;
              }
            }
          }
          // end page-page-view

          // page-engaged-user
          if ($key == "page-engaged-user") {
            $pageEngagedUser = $response->getDecodedBody();
            foreach ($pageEngagedUser as $key => $response) {
              if ($key == "data") {
                $checkObj = 0;
                $datas = $response;
                foreach ($datas as $data){
                  if ($checkObj == 0) {
                    $pageEngagedUserDay = $data;
                  }
                  if ($checkObj == 1) {
                    $pageEngagedUserWeek = $data;
                  }
                  if ($checkObj == 2) {
                    $pageEngagedUserMonth = $data;
                  }
                  $checkObj++;
                }
              }
              if ($key == "paging") {
                $pageEngagedUserPaging = $response;
              }
            }
          }
          // end page-engaged-user


        }

        // page-impression
        foreach ($pageImpressionDay as $key => $response){
          if ($key == "values"){
            $pageImpressionDayDatas = $response;
          }
        }
        foreach ($pageImpressionWeek as $key => $response){
          if ($key == "values"){
            $pageImpressionWeekDatas = $response;
          }
        }
        foreach ($pageImpressionMonth as $key => $response){
          if ($key == "values"){
            $pageImpressionMonthDatas = $response;
          }
        }
        // end page-impression

        // page-impression-organic
        foreach ($pageImpressionOrganicDay as $key => $response){
          if ($key == "values"){
            $pageImpressionOrganicDayDatas = $response;
          }
        }
        foreach ($pageImpressionOrganicWeek as $key => $response){
          if ($key == "values"){
            $pageImpressionOrganicWeekDatas = $response;
          }
        }
        foreach ($pageImpressionOrganicMonth as $key => $response){
          if ($key == "values"){
            $pageImpressionOrganicMonthDatas = $response;
          }
        }
        // end page-impression-organic

        // page-page-view
        foreach ($pagePageViewDay as $key => $response){
          if ($key == "values"){
            $pagePageViewDayDatas = $response;
          }
        }
        foreach ($pagePageViewWeek as $key => $response){
          if ($key == "values"){
            $pagePageViewWeekDatas = $response;
          }
        }
        foreach ($pagePageViewMonth as $key => $response){
          if ($key == "values"){
            $pagePageViewMonthDatas = $response;
          }
        }
        // end page-page-view

        // page-engaged-user
        foreach ($pageEngagedUserDay as $key => $response){
          if ($key == "values"){
            $pageEngagedUserDayDatas = $response;
          }
        }
        foreach ($pageEngagedUserWeek as $key => $response){
          if ($key == "values"){
            $pageEngagedUserWeekDatas = $response;
          }
        }
        foreach ($pageEngagedUserMonth as $key => $response){
          if ($key == "values"){
            $pageEngagedUserMonthDatas = $response;
          }
        }
        // end page-engaged-user

        // dd($pageImpressionDayDatas);
        return response()->json(
          compact(
            'pageImpressionDayDatas',
            'pageImpressionWeekDatas',
            'pageImpressionMonthDatas',
            'pageImpressionPaging',
            'pageImpressionOrganicDayDatas',
            'pageImpressionOrganicWeekDatas',
            'pageImpressionOrganicMonthDatas',
            'pageImpressionOrganicPaging',
            'pagePageViewDayDatas',
            'pagePageViewWeekDatas',
            'pagePageViewMonthDatas',
            'pagePageViewPaging',
            'pageEngagedUserDayDatas',
            'pageEngagedUserWeekDatas',
            'pageEngagedUserMonthDatas',
            'pageEngagedUserPaging'
            )
        );
    }


    // Anal Google
    public function getGA(){

      $MostVisitedPages   = Analytics::fetchMostVisitedPages(Period::days(30));
      $TopBrowsers        = Analytics::fetchTopBrowsers(Period::days(30));
      $CityVisited        = Analytics::performQuery(Period::days(30), "ga:users", array("dimensions" => "ga:city"))->rows;
      $userVisited        = Analytics::performQuery(Period::days(30), "ga:users", array("dimensions" => "ga:userGender,ga:userAgeBracket"))->rows;
      $VisitorWebsite     = Analytics::performQuery(Period::days(30), "ga:users", array("dimensions" => "ga:date"))->rows;

      $bounceRate         = Analytics::performQuery(Period::days(30), "ga:bounceRate")->rows;
      $avgSessionDuration = Analytics::performQuery(Period::days(30), "ga:avgSessionDuration")->rows;

      return response()->json(
        compact(
          "MostVisitedPages",
          "TopBrowsers",
          "CityVisited",
          "userVisited",
          "VisitorWebsite",
          "bounceRate",
          "avgSessionDuration"
        )
      );
    }

    public function getGAP($start, $end) {

    $startDate  = new DateTime($start." 00:00:00");
    $endDate  = new DateTime($end." 00:00:00");

        $MostVisitedPages = Analytics::fetchMostVisitedPages(Period::create($startDate, $endDate));
        $TopBrowsers = Analytics::fetchTopBrowsers(Period::create($startDate, $endDate));
        $CityVisited = Analytics::performQuery(Period::create($startDate, $endDate), "ga:users", array("dimensions" => "ga:city"))->rows;
        $bounceRate = Analytics::performQuery(Period::create($startDate, $endDate), "ga:bounceRate")->rows;
        $avgSessionDuration = Analytics::performQuery(Period::create($startDate, $endDate), "ga:avgSessionDuration")->rows;
        $VisitorWebsite = Analytics::performQuery(Period::create($startDate, $endDate), "ga:users", array("dimensions" => "ga:date"))->rows;
        $userVisited = Analytics::performQuery(Period::create($startDate, $endDate), "ga:users", array("dimensions" => "ga:userGender,ga:userAgeBracket"))->rows;

        return response()->json(
        compact(
          "MostVisitedPages",
          "TopBrowsers",
          "CityVisited",
          "userVisited",
          "VisitorWebsite",
          "bounceRate",
          "avgSessionDuration"
        )
      );
    }

}
