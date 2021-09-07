<?php
/*
*
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


// require api clint main file for  inherited
require 'apiclient.php';


//  this is inherited  class, this class extend class {cricketapi_client}
class questions_result extends cricketapi_client{

   // get toss winner by match id
   public function toss_winner($match_id){
         $scorecards = $this->match_scorecard($match_id);
      if ($scorecards['results']['live_details'] != NULL) {
         $output = $scorecards['results']['live_details']['match_summary']['toss'];
      }else{
         $output = "Toss winner not available now!!";
      }
      return $output;
   }

   //match winner
   public function match_winner($match_id) {
      $scorecards = $this->match_scorecard($match_id);
      if ($scorecards['results']['live_details'] != NULL) {
         if ($scorecards['results']['live_details']['match_summary']['result'] == 'Yes') {
         $output = $scorecards['results']['live_details']['match_summary']['status'];
         }else{
            $output = "Match result not available now!!";
         }
      }else{
         $output = "Match result not available now!!";
      }
      
      return $output;
   }

   // get total run in match
   public function  total_run_both($match_id){
      $scorecards = $this->match_scorecard($match_id);
      if ($scorecards['results']['live_details'] != NULL) {
         if ($scorecards['results']['live_details']['match_summary']['result'] == 'Yes') {
         $output = $scorecards['results']['live_details']['scorecard'][0]['runs'] + $scorecards['results']['live_details']['scorecard'][1]['runs'];
         }else{
            $output = "Match Not completed now!!";
         }
      }else{
         $output = "Match result not available now!!";
      }
      return $output;
   }


   // get current  run
   public function  team_current_run($match_id, $team_id){
      $scorecards = $this->match_scorecard($match_id);
      if ($scorecards['results']['live_details'] != NULL) {
         
         if ($scorecards['results']['fixture']['home']['id'] == $team_id) {
            if (strpos($scorecards['results']['live_details']['scorecard'][0]['title'] , $scorecards['results']['fixture']['home']['name']) !== false) {
               $output = $scorecards['results']['live_details']['scorecard'][0]['runs'];
            }else if(strpos($scorecards['results']['live_details']['scorecard'][1]['title'] , $scorecards['results']['fixture']['home']['name']) !== false){
               $output = $scorecards['results']['live_details']['scorecard'][1]['runs'];
            }else{
               $output = "Team get run error!!";
            }
         }else if($scorecards['results']['fixture']['away']['id'] == $team_id){
            if (strpos($scorecards['results']['live_details']['scorecard'][0]['title'] , $scorecards['results']['fixture']['away']['name']) !== false) {
               $output = $scorecards['results']['live_details']['scorecard'][0]['runs'];
            }else if(strpos($scorecards['results']['live_details']['scorecard'][1]['title'] , $scorecards['results']['fixture']['away']['name']) !== false){
               $output = $scorecards['results']['live_details']['scorecard'][1]['runs'];
            }else{
               $output = "Team get run error!!";
            }
         }else{
            $output = "Invalid team id!!";
         }
         
      }else{
         $output = "Match result not available now!!";
      }
      return $output;
   }

   // get current  overs
   public function  team_current_overs($match_id, $team_id){
      $scorecards = $this->match_scorecard($match_id);
      if ($scorecards['results']['live_details'] != NULL) {


         if ($scorecards['results']['fixture']['home']['id'] == $team_id) {
            if (strpos($scorecards['results']['live_details']['scorecard'][0]['title'] , $scorecards['results']['fixture']['home']['name']) !== false) {
               $output = $scorecards['results']['live_details']['scorecard'][0]['overs'];
            }else if(strpos($scorecards['results']['live_details']['scorecard'][1]['title'] , $scorecards['results']['fixture']['home']['name']) !== false){
               $output = $scorecards['results']['live_details']['scorecard'][1]['overs'];
            }else{
               $output = "Team get overs error!!";
            }
         }else if($scorecards['results']['fixture']['away']['id'] == $team_id){
            if (strpos($scorecards['results']['live_details']['scorecard'][0]['title'] , $scorecards['results']['fixture']['away']['name']) !== false) {
               $output = $scorecards['results']['live_details']['scorecard'][0]['overs'];
            }else if(strpos($scorecards['results']['live_details']['scorecard'][1]['title'] , $scorecards['results']['fixture']['away']['name']) !== false){
               $output = $scorecards['results']['live_details']['scorecard'][1]['overs'];
            }else{
               $output = "Team get overs error!!";
            }
         }else{
            $output = "Invalid team id!!";
         }
         
      }else{
         $output = "Match result not available now!!";
      }
      return $output;
   }


   // get sum of both team total six
   public function total_sixes_both($match_id){
      $scorecards = $this->match_scorecard($match_id);
      if ($scorecards['results']['live_details'] != NULL) {
         if ($scorecards['results']['live_details']['match_summary']['result'] == 'Yes') {
         $team1 = $scorecards['results']['live_details']['scorecard'][0]['batting'];
         $team2 = $scorecards['results']['live_details']['scorecard'][1]['batting'];

         $total_sixes = 0;
            for ($i=0; $i < count($team1); $i++) { 
               $total_sixes += $team1[$i]['sixes'];
            }
            for ($z=0; $z < count($team2); $z++) { 
               $total_sixes += $team2[$z]['sixes'];
            }

            $output = $total_sixes;

         }else{
            $output = "Match Not completed now!!";
         }
      }else{
         $output = "Match result not available now!!";
      }
      return $output;
   }

   // get team wise  total sixes
   public function team_total_sixes($match_id, $team_id){
      $scorecards = $this->match_scorecard($match_id);
      if ($scorecards['results']['live_details'] != NULL) {
         if ($scorecards['results']['live_details']['match_summary']['result'] == 'Yes') {


            if ($scorecards['results']['fixture']['home']['id'] == $team_id) {
            if (strpos($scorecards['results']['live_details']['scorecard'][0]['title'] , $scorecards['results']['fixture']['home']['name']) !== false) {
               $team = $scorecards['results']['live_details']['scorecard'][0]['batting'];
            }else if(strpos($scorecards['results']['live_details']['scorecard'][1]['title'] , $scorecards['results']['fixture']['home']['name']) !== false){
               $team = $scorecards['results']['live_details']['scorecard'][1]['batting'];
            }else{
               $team = "400";
            }
         }else if($scorecards['results']['fixture']['away']['id'] == $team_id){
            if (strpos($scorecards['results']['live_details']['scorecard'][0]['title'] , $scorecards['results']['fixture']['away']['name']) !== false) {
               $team = $scorecards['results']['live_details']['scorecard'][0]['batting'];
            }else if(strpos($scorecards['results']['live_details']['scorecard'][1]['title'] , $scorecards['results']['fixture']['away']['name']) !== false){
               $team = $scorecards['results']['live_details']['scorecard'][1]['batting'];
            }else{
               $team = "400";
            }
         }else{
            $team = "400";
         }

            if ($team != "400") {
               $total_sixes = 0;
               for ($i=0; $i < count($team); $i++) { 
                  $total_sixes += $team[$i]['sixes'];
               }
               $output = $total_sixes;
            }else{
               $output = "Invalid team id!!";
            }

         }else{
            $output = "Match Not completed now!!";
         }
      }else{
         $output = "Match result not available now!!";
      }
      return $output;
   }

   // get sum of both team total fours
   public function total_fours_both($match_id){
      $scorecards = $this->match_scorecard($match_id);
      if ($scorecards['results']['live_details'] != NULL) {
         if ($scorecards['results']['live_details']['match_summary']['result'] == 'Yes') {
         $team1 = $scorecards['results']['live_details']['scorecard'][0]['batting'];
         $team2 = $scorecards['results']['live_details']['scorecard'][1]['batting'];

         $total_fours = 0;
            for ($i=0; $i < count($team1); $i++) { 
               $total_fours += $team1[$i]['fours'];
            }
            for ($z=0; $z < count($team2); $z++) { 
               $total_fours += $team2[$z]['fours'];
            }

            $output = $total_fours;

         }else{
            $output = "Match Not completed now!!";
         }
      }else{
         $output = "Match result not available now!!";
      }
      return $output;
   }

   // get team wise  total sixes
   public function team_total_fours($match_id, $team_id){
      $scorecards = $this->match_scorecard($match_id);
      if ($scorecards['results']['live_details'] != NULL) {
         if ($scorecards['results']['live_details']['match_summary']['result'] == 'Yes') {

            
            if ($scorecards['results']['fixture']['home']['id'] == $team_id) {
            if (strpos($scorecards['results']['live_details']['scorecard'][0]['title'] , $scorecards['results']['fixture']['home']['name']) !== false) {
               $team = $scorecards['results']['live_details']['scorecard'][0]['batting'];
            }else if(strpos($scorecards['results']['live_details']['scorecard'][1]['title'] , $scorecards['results']['fixture']['home']['name']) !== false){
               $team = $scorecards['results']['live_details']['scorecard'][1]['batting'];
            }else{
               $team = "400";
            }
         }else if($scorecards['results']['fixture']['away']['id'] == $team_id){
            if (strpos($scorecards['results']['live_details']['scorecard'][0]['title'] , $scorecards['results']['fixture']['away']['name']) !== false) {
               $team = $scorecards['results']['live_details']['scorecard'][0]['batting'];
            }else if(strpos($scorecards['results']['live_details']['scorecard'][1]['title'] , $scorecards['results']['fixture']['away']['name']) !== false){
               $team = $scorecards['results']['live_details']['scorecard'][1]['batting'];
            }else{
               $team = "400";
            }
         }else{
            $team = "400";
         }

            if ($team != "400") {
               $total_fours = 0;
               for ($i=0; $i < count($team); $i++) { 
                  $total_fours += $team[$i]['fours'];
               }
               $output = $total_fours;
            }else{
               $output = "Invalid team id!!";
            }

         }else{
            $output = "Match Not completed now!!";
         }
      }else{
         $output = "Match result not available now!!";
      }
      return $output;
   }


   // get sum of both team total wickets
   public function total_wickets_both($match_id){
      $scorecards = $this->match_scorecard($match_id);
      if ($scorecards['results']['live_details'] != NULL) {
         if ($scorecards['results']['live_details']['match_summary']['result'] == 'Yes') {
         $team1 = $scorecards['results']['live_details']['scorecard'][0];
         $team2 = $scorecards['results']['live_details']['scorecard'][1];

         $total_wickets = $team1['wickets'] + $team2['wickets'];
         
         $output = $total_wickets;

         }else{
            $output = "Match Not completed now!!";
         }
      }else{
         $output = "Match result not available now!!";
      }
      return $output;
   }

   // get team wise  total sixes
   public function team_total_wickets($match_id, $team_id){
      $scorecards = $this->match_scorecard($match_id);
      if ($scorecards['results']['live_details'] != NULL) {
         if ($scorecards['results']['live_details']['match_summary']['result'] == 'Yes') {

         if ($scorecards['results']['fixture']['home']['id'] == $team_id) {
            if (strpos($scorecards['results']['live_details']['scorecard'][0]['title'] , $scorecards['results']['fixture']['home']['name']) !== false) {
               $team = $scorecards['results']['live_details']['scorecard'][0];
            }else if(strpos($scorecards['results']['live_details']['scorecard'][1]['title'] , $scorecards['results']['fixture']['home']['name']) !== false){
               $team = $scorecards['results']['live_details']['scorecard'][1];
            }else{
               $team = "400";
            }
         }else if($scorecards['results']['fixture']['away']['id'] == $team_id){
            if (strpos($scorecards['results']['live_details']['scorecard'][0]['title'] , $scorecards['results']['fixture']['away']['name']) !== false) {
               $team = $scorecards['results']['live_details']['scorecard'][0];
            }else if(strpos($scorecards['results']['live_details']['scorecard'][1]['title'] , $scorecards['results']['fixture']['away']['name']) !== false){
               $team = $scorecards['results']['live_details']['scorecard'][1];
            }else{
               $team = "400";
            }
         }else{
            $team = "400";
         }

            if ($team != "400") {
               $total_wickets = $team['wickets'];
               
               $output = $total_wickets;
            }else{
               $output = "Invalid team id!!";
            }

         }else{
            $output = "Match Not completed now!!";
         }
      }else{
         $output = "Match result not available now!!";
      }
      return $output;
   }


   // get sum of both team total wickets
   public function total_extras_both($match_id){
      $scorecards = $this->match_scorecard($match_id);
      if ($scorecards['results']['live_details'] != NULL) {
         if ($scorecards['results']['live_details']['match_summary']['result'] == 'Yes') {
         $team1 = $scorecards['results']['live_details']['scorecard'][0];
         $team2 = $scorecards['results']['live_details']['scorecard'][1];

         $total_extras = $team1['extras'] + $team2['extras'];
         
         $output = $total_extras;

         }else{
            $output = "Match Not completed now!!";
         }
      }else{
         $output = "Match result not available now!!";
      }
      return $output;
   }

   // get team wise  total extras
   public function team_total_extras($match_id, $team_id){
      $scorecards = $this->match_scorecard($match_id);
      if ($scorecards['results']['live_details'] != NULL) {
         if ($scorecards['results']['live_details']['match_summary']['result'] == 'Yes') {

            if ($scorecards['results']['fixture']['home']['id'] == $team_id) {
            if (strpos($scorecards['results']['live_details']['scorecard'][0]['title'] , $scorecards['results']['fixture']['home']['name']) !== false) {
               $team = $scorecards['results']['live_details']['scorecard'][0];
            }else if(strpos($scorecards['results']['live_details']['scorecard'][1]['title'] , $scorecards['results']['fixture']['home']['name']) !== false){
               $team = $scorecards['results']['live_details']['scorecard'][1];
            }else{
               $team = "400";
            }
         }else if($scorecards['results']['fixture']['away']['id'] == $team_id){
            if (strpos($scorecards['results']['live_details']['scorecard'][0]['title'] , $scorecards['results']['fixture']['away']['name']) !== false) {
               $team = $scorecards['results']['live_details']['scorecard'][0];
            }else if(strpos($scorecards['results']['live_details']['scorecard'][1]['title'] , $scorecards['results']['fixture']['away']['name']) !== false){
               $team = $scorecards['results']['live_details']['scorecard'][1];
            }else{
               $team = "400";
            }
         }else{
            $team = "400";
         }

            if ($team != "400") {
               $total_extras = $team['extras'];
               
               $output = $total_extras;
            }else{
               $output = "Invalid team id!!";
            }

         }else{
            $output = "Match Not completed now!!";
         }
      }else{
         $output = "Match result not available now!!";
      }
      return $output;
   }


   /* 
      players, data methods started
      from here.
   */
  //   get team [player] run
   public function team_player_run($match_id, $team_id, $player_id){
      $scorecards = $this->match_scorecard($match_id);
      if ($scorecards['results']['live_details'] != NULL) {
         if ($scorecards['results']['live_details']['match_summary']['result'] == 'Yes') {
            
            if ($scorecards['results']['fixture']['home']['id'] == $team_id) {
            if (strpos($scorecards['results']['live_details']['scorecard'][0]['title'] , $scorecards['results']['fixture']['home']['name']) !== false) {
               $team = $scorecards['results']['live_details']['scorecard'][0];
            }else if(strpos($scorecards['results']['live_details']['scorecard'][1]['title'] , $scorecards['results']['fixture']['home']['name']) !== false){
               $team = $scorecards['results']['live_details']['scorecard'][1];
            }else{
               $team = "400";
            }
         }else if($scorecards['results']['fixture']['away']['id'] == $team_id){
            if (strpos($scorecards['results']['live_details']['scorecard'][0]['title'] , $scorecards['results']['fixture']['away']['name']) !== false) {
               $team = $scorecards['results']['live_details']['scorecard'][0];
            }else if(strpos($scorecards['results']['live_details']['scorecard'][1]['title'] , $scorecards['results']['fixture']['away']['name']) !== false){
               $team = $scorecards['results']['live_details']['scorecard'][1];
            }else{
               $team = "400";
            }
         }else{
            $team = "400";
         }

            if ($team != "400") {

               $total_player = $team['batting'];

               for ($i=0; $i < count($total_player); $i++) {
                  if ($total_player[$i]['player_id'] == $player_id) {
                     $output = $total_player[$i]['runs'];
                     break;
                  }else{
                     $output = "Invalid Player Id !!";
                  }
               }

            }else{
               $output = "Invalid team id!!";
            }

         }else{
            $output = "Match Not completed now!!";
         }
      }else{
         $output = "Match result not available now!!";
      }
      return $output;
   }

   //   get team [player] wickets
   public function team_player_wickets($match_id, $team_id, $player_id){
      $scorecards = $this->match_scorecard($match_id);
      if ($scorecards['results']['live_details'] != NULL) {
         if ($scorecards['results']['live_details']['match_summary']['result'] == 'Yes') {
            
            if ($scorecards['results']['fixture']['home']['id'] == $team_id) {
            if (strpos($scorecards['results']['live_details']['scorecard'][0]['title'] , $scorecards['results']['fixture']['home']['name']) !== false) {
               $team = $scorecards['results']['live_details']['scorecard'][0];
            }else if(strpos($scorecards['results']['live_details']['scorecard'][1]['title'] , $scorecards['results']['fixture']['home']['name']) !== false){
               $team = $scorecards['results']['live_details']['scorecard'][1];
            }else{
               $team = "400";
            }
         }else if($scorecards['results']['fixture']['away']['id'] == $team_id){
            if (strpos($scorecards['results']['live_details']['scorecard'][0]['title'] , $scorecards['results']['fixture']['away']['name']) !== false) {
               $team = $scorecards['results']['live_details']['scorecard'][0];
            }else if(strpos($scorecards['results']['live_details']['scorecard'][1]['title'] , $scorecards['results']['fixture']['away']['name']) !== false){
               $team = $scorecards['results']['live_details']['scorecard'][1];
            }else{
               $team = "400";
            }
         }else{
            $team = "400";
         }

            if ($team != "400") {

               $total_player = $team['bowling'];

               for ($i=0; $i < count($total_player); $i++) {
                  if ($total_player[$i]['player_id'] == $player_id) {
                     $output = $total_player[$i]['wickets'];
                     break;
                  }else{
                     $output = "Invalid Player Id !!";
                  }
               }

            }else{
               $output = "Invalid team id!!";
            }

         }else{
            $output = "Match Not completed now!!";
         }
      }else{
         $output = "Match result not available now!!";
      }
      return $output;
   }

   public function how_out_batsman($match_id, $team_id, $player_id){
      $scorecards = $this->match_scorecard($match_id);
      if ($scorecards['results']['live_details'] != NULL) {
         if ($scorecards['results']['live_details']['match_summary']['result'] == 'Yes') {
            
            if ($scorecards['results']['fixture']['home']['id'] == $team_id) {
            if (strpos($scorecards['results']['live_details']['scorecard'][0]['title'] , $scorecards['results']['fixture']['home']['name']) !== false) {
               $team = $scorecards['results']['live_details']['scorecard'][0];
            }else if(strpos($scorecards['results']['live_details']['scorecard'][1]['title'] , $scorecards['results']['fixture']['home']['name']) !== false){
               $team = $scorecards['results']['live_details']['scorecard'][1];
            }else{
               $team = "400";
            }
         }else if($scorecards['results']['fixture']['away']['id'] == $team_id){
            if (strpos($scorecards['results']['live_details']['scorecard'][0]['title'] , $scorecards['results']['fixture']['away']['name']) !== false) {
               $team = $scorecards['results']['live_details']['scorecard'][0];
            }else if(strpos($scorecards['results']['live_details']['scorecard'][1]['title'] , $scorecards['results']['fixture']['away']['name']) !== false){
               $team = $scorecards['results']['live_details']['scorecard'][1];
            }else{
               $team = "400";
            }
         }else{
            $team = "400";
         }
            
            if ($team != "400") {

               $total_player = $team['batting'];

               for ($i=0; $i < count($total_player); $i++) {
                  if ($total_player[$i]['player_id'] == $player_id) {
                     $output = $total_player[$i]['how_out'];
                     break;
                  }else{
                     $output = "Invalid Player Id !!";
                  }
               }

            }else{
               $output = "Invalid team id!!";
            }

         }else{
            $output = "Match Not completed now!!";
         }
      }else{
         $output = "Match result not available now!!";
      }
      return $output;
   }




}

?>