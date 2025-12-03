<?php

namespace App\Repository\Cache;

use App\Entity\NetworkDeviceEntity;
use App\Repository\Contract\NetworkDeviceEntityRepositoryInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class NetworkDeviceEntityCacheRepository implements NetworkDeviceEntityRepositoryInterface
{
    private const CACHE_KEY = 'network_device_entity1';
    private const CACHE_TTL = 3600;
    public function __construct(
        private readonly NetworkDeviceEntityRepositoryInterface $inner,
        private readonly CacheInterface $cache,
    ) {
    }
    public function findById(int $id): ?NetworkDeviceEntity
    {
        $result = $this->cache->get(
            $this->getCacheKey($id),
            function (ItemInterface $item) use ($id) {
                $item->expiresAfter(self::CACHE_TTL);

                return $this->inner->findById($id);
            }
        );

        return $result;
    }

    public function save(NetworkDeviceEntity $networkDeviceEntity): void
    {
        $this->cache->delete($this->getCacheKey($networkDeviceEntity->getId()));
        $this->inner->save($networkDeviceEntity);
    }

    public function refresh(NetworkDeviceEntity $networkDeviceEntity): void
    {
        $this->cache->delete($this->getCacheKey($networkDeviceEntity->getId()));
        $this->inner->refresh($networkDeviceEntity);
    }

    private function getCacheKey(string|int $root): string
    {
        return self::CACHE_KEY.'_'.$root;
    }
}
