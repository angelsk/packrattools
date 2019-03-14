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
            ->shouldBeCalled()
            ->willReturn([]);

        $this->getCurrentCollections()->shouldBeArray();
    }

    public function it_should_get_a_collection_by_id(CollectionRepository $repository, Collection $collection)
    {
        $repository->findOneById(1)
            ->shouldBeCalled()
            ->willReturn($collection);

        $this->getOneById(1)->shouldBeAnInstanceOf(Collection::class);
        $this->getOneById(1)->shouldEqual($collection);
    }

    public function it_should_return_null_if_no_collection(CollectionRepository $repository)
    {
        $repository->findOneById(999)
            ->shouldBeCalled()
            ->willReturn(null);

        $this->getOneById(999)->shouldEqual(null);
    }
}
