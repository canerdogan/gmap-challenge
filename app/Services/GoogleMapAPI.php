<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/**
 * Class GoogleMapAPI
 *
 * @package App\Services
 */
class GoogleMapAPI extends Client
{

	/**
	 * @var null|string
	 */
	protected $url = 'https://maps.googleapis.com/maps/api/geocode/json';

	/**
	 * @var string
	 */
	protected $address;


	/**
	 * @var array
	 */
	protected $response;


	/**
	 * GoogleMapAPI constructor.
	 *
	 * @param null|string $address
	 */
	public function __construct ($address = NULL)
	{

		if( ! is_null( $address )) {
			$this->setAddress( $address );
		}

		return parent::__construct();
	}


	/**
	 * Set the address
	 *
	 * @param $address
	 */
	public function setAddress ($address)
	{

		$this->address = $address;

		return $this;
	}


	/**
	 * Get the value of address
	 *
	 * @return string
	 */
	public function getAddress ()
	{

		return $this->address;
	}


	/**
	 * Preparing request URI with API KEY
	 *
	 * @return string
	 */
	public function prepareRequest ()
	{

		return $this->url . "?sensor=false&address=" . urlencode( $this->address ) . "&key=" . getenv('GOOGLE_API_KEY');
	}


	/**
	 * Sending request to Google Map API to fetch responses
	 *
	 * @param $address
	 *
	 * @return string|\Psr\Http\Message\StreamInterface
	 */
	public function find ()
	{

		try {
			if(empty( $this->address )) {
				throw new \Exception( 'Set the Address before sending request' );
			}

			$response = $this->request( 'GET', $this->prepareRequest() );

			$content        = json_decode( $response->getBody()->getContents() );
			$this->response = $content->results;

			return $this->response;
		} catch (ClientException $e) {
			return $e->getMessage();
		}
	}
}