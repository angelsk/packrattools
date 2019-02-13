<?php

namespace spec\App\Service;

use App\Repository\FeatRepository;
use App\Service\FeatService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FeatServiceSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(FeatService::class);
    }

    public function let(FeatRepository $repository)
    {
        $this->beConstructedWith($repository);
    }

    public function it_should_get_statistics(FeatRepository $repository)
    {
        $repository->getStatistics()
            ->shouldBeCalled()
            ->willReturn([]);

        $this->getStatistics()->shouldBeArray();
    }
}
