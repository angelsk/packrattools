<?php

namespace spec\App\Service;

use App\Repository\FamilyRepository;
use App\Service\FamilyService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FamilyServiceSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(FamilyService::class);
    }

    public function let(FamilyRepository $repository)
    {
        $this->beConstructedWith($repository);
    }

    public function it_should_get_statistics(FamilyRepository $repository)
    {
        $repository->getStatistics()
            ->shouldBeCalled()
            ->willReturn([]);

        $this->getStatistics()->shouldBeArray();
    }

    public function it_should_get_card_statistics(FamilyRepository $repository)
    {
        $repository->getCardStatistics()
            ->shouldBeCalled()
            ->willReturn([]);

        $this->getCardStatistics()->shouldBeArray();
    }
}
