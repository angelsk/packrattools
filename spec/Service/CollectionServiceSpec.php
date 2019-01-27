<?php

namespace spec\App\Service;

use App\Entity\Collection;
use App\Repository\CollectionRepository;
use App\Service\CollectionService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Bridge\Doctrine\ManagerRegistry;

class CollectionServiceSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(CollectionService::class);
    }

    public function let(CollectionRepository $repository)
    {
        $this->beConstructedWith($repository);
    }

    public function it_should_get_current_collections_with_family(CollectionRepository $repository)
    {
        $repository->getCurrentCollectionsWithFamily()
            ->willReturn([]);

        $this->getCurrentCollections()->shouldBeArray();
    }
}
