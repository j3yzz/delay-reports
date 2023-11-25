<?php

namespace App\Containers\DeliveryAudit\Entities;

class Order
{
    protected int $id;
    protected int $userId;
    protected int $vendorId;
    protected string $orderedAt;
    protected int $deliveryTime;
    protected string $status;

    public function __construct(
        int $id,
        int $userId,
        int $vendorId,
        string $orderedAt,
        int $deliveryTime,
        string $status
    ) {
        $this->setId($id);
        $this->setUserId($userId);
        $this->setVendorId($vendorId);
        $this->setOrderedAt($orderedAt);
        $this->setDeliveryTime($deliveryTime);
        $this->setStatus($status);
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param int $deliveryTime
     */
    public function setDeliveryTime(int $deliveryTime): void
    {
        $this->deliveryTime = $deliveryTime;
    }

    /**
     * @param string $orderedAt
     */
    public function setOrderedAt(string $orderedAt): void
    {
        $this->orderedAt = $orderedAt;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @param int $vendorId
     */
    public function setVendorId(int $vendorId): void
    {
        $this->vendorId = $vendorId;
    }

    /**
     * @return int
     */
    public function getDeliveryTime(): int
    {
        return $this->deliveryTime;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getOrderedAt(): string
    {
        return $this->orderedAt;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getVendorId(): int
    {
        return $this->vendorId;
    }
}
