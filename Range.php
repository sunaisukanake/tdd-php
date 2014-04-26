<?php

function getCloseMembers($firstRange, $lastRange){
  if($firstRange==$lastRange){
    return "";
  }
  for($i=$firstRange+1; $i< $lastRange; $i++){
    $result[] = $i;
  }
  $result = implode($result,',');
  return $result;
}

function getFirstEdgeMember($firstRange,$lastRange) {

    if($firstRange == $lastRange) {
       return "";
    } else {
       return $firstRange .",";
    }

}

function getLastEdgeMember($firstRange,$lastRange) {

    if($firstRange == $lastRange) {
       return "";
    } else {
       return "," .$lastRange;
    }

}

function getMemberRange($range) {

  return substr($range,1,3);

}


function getStarter($range) {

  $member = explode(',',getMemberRange($range));
  return $member[0];

}

function getStoper($range) {

  $member = explode(',',getMemberRange($range));
  return $member[1];

}

function getSign($range) {

  return $range[0] . $range[4];

}

function calRange($range) {

  $starter = getStarter($range);
  $stopper = getStoper($range);

  $firstMember = getFirstEdgeMember($starter,$stopper);
  $lastMember = getLastEdgeMember($starter,$stopper);
  $setMembers = getCloseMembers($starter,$stopper);
  $signs = getSign($range);

  if($starter == $stopper) {
  
    if($signs == "[]") {
        $setMembers = $starter;
    } else if ($signs == "()") {
        $setMembers = "";
    } else if($signs == "(]"){
        throw new Exception("invalid");
    }
  }

  if($signs == "(]")  {
    $setMembers = $setMembers . $lastMember;

  } else if($signs == "[)") {
    $setMembers = $firstMember . $setMembers;

  } else if($signs == "[]"){
    $setMembers = $firstMember . $setMembers . $lastMember;
  }

  return "{" . $setMembers . "}";
}
