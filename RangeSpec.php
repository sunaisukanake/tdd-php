<?php
require("Range.php");

class RangeSpec extends PHPUnit_Framework_TestCase {

  function testCloseRangeZeroToFive () {
    $this->assertEquals("{0,1,2,3,4,5}",calRange("[0,5]"));
  }

  function testOpenCloseRangeZeroToFive () {
    $this->assertEquals("{1,2,3,4,5}", calRange("(0,5]"));
  }

  function testCloseOpenRangeZeroToFive () {
    $this->assertEquals("{0,1,2,3,4}", calRange("[0,5)"));
  }

  function testOpenOpenRangeZeroToFive () {
    $this->assertEquals("{1,2,3,4}", calRange("(0,5)"));
  }
  function testOpenOpenRangeZeroToZero () {
    $this->assertEquals("{}", calRange("(0,0)"));
  }
  function testCloseCloseRangeOneToOne () {
    $this->assertEquals("{1}", calRange("[1,1]"));
  }
  function testOpenOpenRangeZeroToFour () {
    $this->assertEquals("{1,2,3}", calRange("(0,4)"));
  }
  function testCloseGetMember () {
    $this->assertEquals("1,2,3", getCloseMembers("0","4"));
  }
  function testCloseGetMemberSixToTen () {
    $this->assertEquals("7,8,9", getCloseMembers("6","10"));
  }
  function testCloseGetMemberOneToOne (){
    $this->assertEquals("", getCloseMembers("1","1"));
  }

  function testCloseCloseRangeTwoToTwo() {
    $this->assertEquals("{2}", calRange("[2,2]"));
  }

  function testOpenOpenRangeTwoToTwo() {
    $this->assertEquals("{}", calRange("(2,2)"));
  }

  function testOpenCloseRangeTwoToTwo(){
    try {
      $this->assertEquals("invalid", calRange("(2,2]"));
      $this->fail("Invalid range was not thrown");
    } catch (Exception $e) {
      $this->assertTrue(true);
    }
  }

  function testFirstEdgeMember_WhenRange_HasSameValue() {

    $this->assertEquals("", getFirstEdgeMember("2","2"));

  }

  function testFirstEdgeMember_WhenRange_HasDiffValue() {

    $this->assertEquals("2,", getFirstEdgeMember("2","4"));

  }

  function testLastEdgeMember_WhenRange_HasSameValue() {

    $this->assertEquals("", getLastEdgeMember("3","3"));

  }

  function testLastEdgeMember_WhenRange_HasDiffValue() {

    $this->assertEquals(",4", getLastEdgeMember("2","4"));

  }  

  function testGetStarter() {

    $this->assertEquals("2", getStarter("(2,4)"));
  
  }

  function testGetStoper() {

    $this->assertEquals("4", getStoper("(2,4)"));

  }

  function testGetMemberRange() {

    $this->assertEquals("2,3", getMemberRange("(2,3)"));

  }

  function testGetSign_WhenOpenToOpen() {

    $this->assertEquals("()", getSign("(2,3)"));

  }

  function testGetSign_WhenOpenToClose() {

    $this->assertEquals("(]", getSign("(2,3]"));

  }


 
}
