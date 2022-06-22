<?php

namespace Beitsafe\ActiveCampaign;

use Beitsafe\ActiveCampaign\Classes\Lists;
use Beitsafe\ActiveCampaign\Classes\Contacts;
use Beitsafe\ActiveCampaign\Classes\Tags;


class ActiveCampaign
{
	private $base_url;
	private $api_key;

	public function __construct()
	{
		$this->base_url = env('AC_API_URL');
		$this->api_key = env('AC_API_KEY');
	}

	public function lists()
	{
		return new Lists($this->base_url, $this->api_key);
	}

	public function contacts()
	{
		return new Contacts($this->base_url, $this->api_key);
	}

	public function tags()
	{
		return new Tags($this->base_url, $this->api_key);
	}

}
