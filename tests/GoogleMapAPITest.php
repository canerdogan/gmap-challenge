<?php

use App\Services\GoogleMapAPI;
use PHPUnit\Framework\TestCase;

class GoogleMapAPITest extends TestCase
{

	private $googleMapAPI;


	public function setUp ()
	{
		$this->googleMapAPI = new GoogleMapAPI();
	}


	public function testSetterGetter ()
	{
		$address = 'Berlin Germany';

		$this->googleMapAPI->setAddress( $address );
		$this->assertEquals( $address, $this->googleMapAPI->getAddress() );

	}


	public function testFind ()
	{
		$this->googleMapAPI->setAddress( 'Berlin Germany' );
		$result = $this->googleMapAPI->find();
		$this->assertArrayHasKey( 0, $result );
		$this->assertObjectHasAttribute( 'address_components', $result[0], 'Address Components found' );
		$this->assertObjectHasAttribute( 'formatted_address', $result[0], 'Formatted Address found' );

	}

}