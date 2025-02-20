<?php
     function parseAreaObj($ispezione){
          
          $separatoreArea = $ispezione->nomeArea != ""?",": ""; 
          $macroarea = isset($ispezione->macroArea) ? $ispezione->macroArea : ""; 

          $sottoarea = isset($ispezione->sottoArea) ? $ispezione->sottoArea : "";
          $sottoarea = $sottoarea != "" ? " ". $sottoarea : "";
          $sottoarea =  $sottoarea." ";

          $area =  $macroarea . $sottoarea . " ". $ispezione->nomeArea;
          return $area;
     }

     function parseArea($ispezione){
          
          $separatoreArea = $ispezione["nomeArea"] != ""?",": ""; 
          $macroarea = isset($ispezione["macroArea"]) ? $ispezione["macroArea"] : ""; 

          $sottoarea = isset($ispezione["sottoArea"]) ? $ispezione["sottoArea"] : "";
          $sottoarea = $sottoarea != "" ? " ". $sottoarea : "";
          $sottoarea =  $sottoarea." ";

          $area =  $macroarea . $sottoarea . " ". $ispezione["nomeArea"];
          return $area;
     }
 
 