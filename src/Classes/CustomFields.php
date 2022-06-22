<?php

namespace Beitsafe\ActiveCampaign\Classes;

use Beitsafe\ActiveCampaign\Connector;


class CustomFields extends Connector
{
    public function get($field_id = null)
    {
        return $this->request('GET', 'fields/' . strval($field_id));
    }

    public function all()
    {
        return $this->request('GET', 'fields');
    }

    public function create($params)
    {
        return $this->request('POST', 'fields', ['field' => $params]);
    }

    public function update($field_id, $params)
    {
        return $this->request('PUT', 'fields/' . $field_id, ['field' => $params]);
    }

    public function delete($field_id)
    {
        return $this->request('DELETE', 'fields/' . strval($field_id));
    }
}
