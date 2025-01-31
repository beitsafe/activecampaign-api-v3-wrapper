<?php

namespace Beitsafe\ActiveCampaign;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class Connector
{

	protected $base_url;
	protected $api_key;
	protected $paginate_params;
	protected $filter_params;
	protected $query_params;
	protected $orderby_params;


	public function __construct()
	{
		$this->api_key			= env('AC_API_KEY');
		$this->base_url 		= rtrim(env('AC_API_URL'), '/') . '/';
		$this->paginate_params 	= [];
		$this->filter_params 	= [];
		$this->query_params 	= [];
		$this->orderby_params 	= [];
	}

	public function paginate($limit, $offset = 0)
	{
		$this->paginate_params = ['limit' => $limit, 'offset' => $offset];

		return $this;
	}

	public function filter($values)
	{
		foreach($values as $key => $value){
			$this->filter_params['filters[' . $key . ']'] = $value;
		}

		return $this;
	}

	public function query($values)
	{
		$this->query_params = $values;

		return $this;
	}

	public function orderby($values)
	{
		foreach($values as $key => $value){
			$this->orderby_params['orders[' . $key . ']'] = $value;
		}

		return $this;
	}

	protected function buildUrl($endpoint)
	{
		$query = http_build_query(array_merge($this->query_params, $this->filter_params, $this->orderby_params, $this->paginate_params));

		return $this->base_url . $endpoint . (!empty($query) ? ((stripos($endpoint, '?') === false ? '?' : '&') . $query) : '');
	}

	protected function request($method, $endpoint, $data = [])
	{
		try {
			$client		= new Client(['headers' => ['Api-Token' => $this->api_key],'verify' => false]);
			$url		= $this->buildUrl($endpoint);
            $key	    = ($method == 'GET') ? 'query' : 'json';
            $options	= !empty($data) ? [$key => $data] : [];
			$request 	= $client->request($method, $url, $options);

			return json_decode($request->getBody()->getContents(), true);
		} catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
	}
}
