<?php

namespace spec\App\Entity;

use App\Entity\Collection;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CollectionSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Collection::class);
    }

    public function it_should_not_report_collection_as_retireding_if_no_expiry_date()
    {
        $this->expiryDate = null;

        $this->shouldNotBeRetireding();
    }

    public function it_should_not_be_retireding_if_expiry_date_1_month_in_future()
    {
        $this->expiryDate = new \DateTime('+28 day');

        $this->shouldNotBeRetireding();
    }

    public function it_should_be_retireding_if_retiring_today()
    {
        $this->expiryDate = new \DateTime();

        $this->shouldBeRetireding();
    }

    public function it_should_be_retireding_if_2_weeks_in_future()
    {
        $this->expiryDate = new \DateTime('+2 week');

        $this->shouldBeRetireding();
    }

    public function it_should_be_retireding_if_1_year_in_past()
    {
        $this->expiryDate = new \DateTime('-1 year');

        $this->shouldBeRetireding();
    }

    public function it_should_not_report_collection_as_retired_if_no_expiry_date()
    {
        $this->expiryDate = null;

        $this->shouldNotBeRetired();
    }

    public function it_should_not_be_retired_if_expiry_date_1_month_in_future()
    {
        $this->expiryDate = new \DateTime('+28 day');

        $this->shouldNotBeRetired();
    }

    public function it_should_not_be_retired_if_retiring_today()
    {
        $this->expiryDate = new \DateTime();

        $this->shouldNotBeRetired();
    }

    public function it_should_be_retired_if_retiring_today_am()
    {
        $this->expiryDate = new \DateTime('-5 minute');

        $this->shouldBeRetired();
    }

    public function it_should_not_be_retired_if_2_weeks_in_future()
    {
        $this->expiryDate = new \DateTime('+2 week');

        $this->shouldNotBeRetired();
    }

    public function it_should_be_retired_if_1_year_in_past()
    {
        $this->expiryDate = new \DateTime('-1 year');

        $this->shouldBeRetired();
    }
}
