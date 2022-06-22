<?php

namespace Beitsafe\ActiveCampaign;

use Beitsafe\ActiveCampaign\Classes\CustomFields;
use Beitsafe\ActiveCampaign\Classes\Lists;
use Beitsafe\ActiveCampaign\Classes\Contacts;
use Beitsafe\ActiveCampaign\Classes\Tags;


class ActiveCampaign
{
    public function lists()
    {
        return new Lists();
    }

    public function contacts()
    {
        return new Contacts();
    }

    public function tags()
    {
        return new Tags();
    }

    public function customfields()
    {
        return new CustomFields();
    }
}
