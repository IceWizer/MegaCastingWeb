<?php

declare(strict_types=1);

namespace App\State;

use ApiPlatform\Doctrine\Orm\Paginator;
use ApiPlatform\Exception\ResourceClassNotFoundException;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\Metadata\Resource\Factory\ResourceMetadataCollectionFactoryInterface;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\CastingOfferRepresentation;
use App\DataTransformer\CastingOfferRepresentationDataTransformer;
use App\Entity\CastingOffer;

/**
 * @implements ProviderInterface<CastingOfferRepresentation>
 */
final class CastingOfferRepresentationProvider implements ProviderInterface
{
    /**
     * @param ProviderInterface<CastingOffer> $itemProvider
     */
    public function __construct(
        readonly private ProviderInterface $itemProvider,
        readonly private CastingOfferRepresentationDataTransformer $castingOfferRepresentationDataTransformer,
        readonly private ResourceMetadataCollectionFactoryInterface $collectionFactory,
    ) {
    }

    /**
     * @param Operation $operation
     * @param array $uriVariables
     * @param array $context
     *
     * @return CastingOfferRepresentation
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): CastingOfferRepresentation
    {
        $item = $this->collectionFactory->create($operation->getExtraProperties()['entity'])->getOperation();

        /** @var CastingOffer $castingOffer */
        $castingOffer = $this->itemProvider->provide($item, $uriVariables, $context);

        return $this->castingOfferRepresentationDataTransformer->transform($castingOffer);
    }
}
