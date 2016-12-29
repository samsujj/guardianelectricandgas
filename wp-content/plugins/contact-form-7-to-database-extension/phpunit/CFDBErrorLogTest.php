<?php

include_once(dirname(dirname(__FILE__)) . '/CFDBErrorLog.php');

class CFDBErrorLogTest extends PHPUnit_Framework_TestCase {

    public function testIsEmailAddress() {
        $dateFormatter = new MockDateFormatter();
        $err = new CFDBErrorLog($dateFormatter);
        $email = 'me@here.com';
        $this->assertTrue($err->isEmailAddress($email), $email);
        $email = 'michael_d_simpson@gmail.com';
        $this->assertTrue($err->isEmailAddress($email), $email);
        $email = 'some-body@xxx.pl';
        $this->assertTrue($err->isEmailAddress($email), $email);
    }

    public function testIsEmailAddress_isPath() {
        $dateFormatter = new MockDateFormatter();
        $err = new CFDBErrorLog($dateFormatter);
        $this->assertFalse($err->isEmailAddress('/path/to/something'), '/path/to/something');
    }

    public function testIsEmailAddress_emptyString() {
        $dateFormatter = new MockDateFormatter();
        $err = new CFDBErrorLog($dateFormatter);
        $this->assertFalse($err->isEmailAddress(''), 'empty string');
    }

    public function testIsEmailAddress_null() {
        $dateFormatter = new MockDateFormatter();
        $err = new CFDBErrorLog($dateFormatter);
        $this->assertFalse($err->isEmailAddress(null), 'null');
    }

    public function testNoDestination() {
        $dateFormatter = new MockDateFormatter();
        $err = new CFDBErr