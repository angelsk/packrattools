<?php

namespace spec\App\Service;

use App\Repository\ArtistRepository;
use App\Service\ArtistService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ArtistServiceSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(ArtistService::class);
    }

    public function let(ArtistRepository $repository)
    {
        $this->beConstructedWith($repository);
    }

    public function it_should_get_statistics(ArtistRepository $repository)
    {
        $repository->getStatistics()
            ->shouldBeCalled()
            ->willReturn([]);

        $this->getStatistics()->shouldBeArray();
    }
}
