<?php
/*
*  Warning: Don't remove this text.
*
************Disclaimer***********************
*
   Copyright ©2021. Developer Rezwan ahmod sami and Edussm. All Rights Reserved. Permission to use, copy, modify, and distribute this software and its documentation for educational, research, and not-for-profit purposes, without fee and without a signed licensing agreement, is hereby granted, provided that the above copyright notice, this paragraph and the following two paragraphs appear in all copies, modifications, and distributions. Contact The developer facebook: https://www.facebook.com/rezwanahmod.sami, email: samiahmed0f0@gmail.com  for commercial licensing opportunities.
*
***********************************************
*
* Developer: Rezwan Ahmod Sami.
* Version: 1.0
* facebook: https://www.facebook.com/rezwanahmod.sami
* Email: samiahmed0f0@gmail.com
*/

/* 
   This is main  class file of PHP Client for api: Cricket live data,
   Api  provider: Rapid Api.
   Api link: https://rapidapi.com/sportcontentapi/api/cricket-live-data/
*/
class cricketapi_client {
   private $api_host = "https://cricket-live-data.p.rapidapi.com/";
   private $api_key = API_KEY;
   private $result = [];

   // set curl connection
   private function set_curl($dataname, $parameter = '') {
      $curl = curl_init();

      curl_setopt_array($curl, [
         CURLOPT_URL => $this->api_host.$dataname.$parameter,
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_FOLLOWLOCATION => true,
         CURLOPT_ENCODING => "",
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 30,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => "GET",
         CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: cricket-live-data.p.rapidapi.com",
            "x-rapidapi-key: {$this->api_key}"
         ],
      ]);

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
         $result[] = "cURL Error #:" . $err;
         return $result;
      } else {
         return $response;
      }
   }

   // get match fixtures
   public  function get_fixtures() {
      $fixtures = $this->set_curl("fixtures");
      $fixtures = json_decode($fixtures, true);
      return  $fixtures;
   }

   // get fixtures by date
   public function fixtures_by_date($year, $month, $date){
      $date_format = "{$year}-{$month}-{$date}";
      $results = $this->set_curl("fixtures-by-date/", $date_format);

      $results = json_decode($results, true);
      return $results;
   }

   // get fixtures by date
   public function fixtures_by_series($series_id){
      $results = $this->set_curl("fixtures-by-series/", $series_id);
      $results = json_decode($results, true);
      return $results;
   }

   // get matchscorecards
   public function match_scorecard($match_id) {
      $match = $this->set_curl("match/", $match_id);
      $match = json_decode($match, true);
      return $match;
   }
 
   // get results by date
   public function results_by_date($year, $month, $date){
      $date_format = "{$year}-{$month}-{$date}";
      $results = $this->set_curl("results-by-date/", $date_format);

      $results = json_decode($results, true);
      return $results;
   }

   // get results
   public function matches_results(){
      $results = $this->set_curl("results");

      $results = json_decode($results, true);
      return $results;
   }


   // get series 
   public function get_series() {
      $series = $this->set_curl("series");
      $series = json_decode($series, true);
      return  $series;
   }

   //live  matches
   public function get_live_matches(){
      $year = date('Y');
      $month = date('m');
      $date = date('d');
      $fixtures = $this->fixtures_by_date($year, $month, $date);
      $matches = $fixtures['results'];
      $live_matches  = [];
      $z = 0;
      for ($i=0; $i < count($matches); $i++) {
         if ($matches[$i]['status'] == 'Fixture') {
            $scorecards = $this->match_scorecard($matches[$i]['id']);
            if ($scorecards['results']['live_details'] != NULL && $scorecards['results']['live_details']['match_summary']['in_play'] == 'Yes') {
               $live_matches[$z] = $matches[$i];
               $z++;
            }
         }
      }

      return $live_matches;
   }

   //upcoming  matches
   public function get_upcoming_matches(){
   
      $fixtures = $this->get_fixtures();
      $matches = $fixtures['results'];
      $upcoming_matches  = [];
      $z = 0;
      for ($i=0; $i < count($matches); $i++) {
         if ($matches[$i]['status'] == 'Fixture') {
            $scorecards = $this->match_scorecard($matches[$i]['id']);
            if ($scorecards['results']['live_details'] == NULL) {
               $upcoming_matches[$z] = $matches[$i];
               $z++;
            }
         }
      }

      return $upcoming_matches;
   }

   // get team bowlers
   public function team_bowlers($match_id, $team_id){
      $scorecards = $this->match_scorecard($match_id);
      if ($scorecards['results']['live_details'] != NULL) {
           
           
            if ($scorecards['results']['fixture']['home']['id'] == $team_id) {
              $team = $scorecards['results']['live_details']['teamsheets']['home'];
            }else if($scorecards['results']['fixture']['away']['id'] == $team_id){
               $team = $scorecards['results']['live_details']['teamsheets']['away'];
            }else{
               $team = "400";
            }

            if ($team != "400") {
               $bowlers = [];
               $i = 0;
               foreach ($team as $key => $value) {
                  if ($value['position'] != 'Unknown' && $value['position'] != 'Wicketkeeper') {
                  $bowlers[$i] = $value;
                  $i++;
                  }
               }
               $output = $bowlers;
            }else{
               $output = "Invalid team id!!";
            }
      }else{
         $output = "Match result not available now!!";
      }
      return $output;
   }
   

}
?>