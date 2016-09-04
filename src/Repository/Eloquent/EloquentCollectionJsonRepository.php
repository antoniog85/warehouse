<?php

namespace Warehouse\Repository\Eloquent;


use Warehouse\Entity\EntityInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Warehouse\MediaType\CollectionJson\CollectionJson;
use Warehouse\MediaType\CollectionJson\CollectionJsonItem;
use Warehouse\MediaType\CollectionJson\CollectionJsonLink;
use Warehouse\MediaType\CollectionJson\Transformer\CollectionJsonTransformer;
use Warehouse\Repository\CollectionJsonRepositoryInterface;
use Warehouse\Transformer\EloquentToEntity\TransformableToEntity;
use Warehouse\Repository\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class EloquentCollectionJsonRepository implements CollectionJsonRepositoryInterface
{
    /**
     * @var TransformableToEntity
     */
    protected $eloquentTransformer;

    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * @var Model
     */
    protected $model;

    public function __construct(
        TransformableToEntity $eloquentTransformer,
        RepositoryInterface $repository,
        Model $model
    )
    {
        $this->eloquentTransformer = $eloquentTransformer;
        $this->repository = $repository;
        $this->model = $model;
    }

    /**
     * Retrieve the list of warehouses
     *
     * @param int $perPage
     * @param int $page
     *
     * @return CollectionJson
     */
    public function findAll(int $perPage, int $page): CollectionJson
    {
        /** @var LengthAwarePaginator $result */
        $result = $this->model->paginate($perPage);
        $result->appends('per_page', $perPage);

        $collectionJsonTransformer = new CollectionJsonTransformer($result);
        $collectionJson = $collectionJsonTransformer->transform();

        $this->addItemsToCollectionJson($collectionJson, $result->items());

        return $collectionJson;
    }

    /**
     * @param int $id
     * @return CollectionJson
     */
    public function findOne(int $id): CollectionJson
    {
        $entity = $this->repository->findOne($id);

        $collectionJson = new CollectionJson();
        $collectionJsonItem = new CollectionJsonItem();
        $collectionJsonItem
            ->setData($entity->toArray())
            ->setHref("http://$_SERVER[HTTP_HOST]/{$entity->getUrlPath()}/{$id}");
        $collectionJson->addItem($collectionJsonItem);
        $resourcesListUrl = "http://$_SERVER[HTTP_HOST]/{$entity->getUrlPath()}";
        $list = (new CollectionJsonLink())->setRel('list')->setHref($resourcesListUrl);
        $collectionJson->addLink($list);

        return $collectionJson;
    }
    /**
     * @param EntityInterface $entityToPersist
     * @return CollectionJson
     */
    public function persist(EntityInterface $entityToPersist): CollectionJson
    {
        $persistedEntity = $this->repository->persist($entityToPersist);

        $collectionJson = new CollectionJson();
        $collectionJsonItem = new CollectionJsonItem();
        $collectionJsonItem->setData($persistedEntity->toArray());
        $collectionJson->addItem($collectionJsonItem);

        return $collectionJson;
    }

    /**
     * @param CollectionJson $collectionJson
     * @param array $items
     */
    protected function addItemsToCollectionJson(CollectionJson $collectionJson, array $items = [])
    {
        foreach ($items as $item) {
            $entity = $this->eloquentTransformer->transform($item);
            $collectionJsonItem = new CollectionJsonItem();
            $collectionJsonItem->setData($entity->toArray());
            $collectionJsonItem->setHref("http://$_SERVER[HTTP_HOST]/{$entity->getUrlPath()}/{$entity->getId()}");

            foreach ($entity->getLinks() as $link) {
                $collectionJsonLink = new CollectionJsonLink();
                $collectionJsonLink->setRel($link->getRel());
                $collectionJsonLink->setHref($link->getHref());
                $collectionJsonItem->addLink($collectionJsonLink);
            }

            $collectionJson->addItem($collectionJsonItem);
        }
    }
}