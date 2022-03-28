<?php declare(strict_types=1);

namespace App\Model;

class Order
{
    private int $productId;
    private int $quantity;
    private int $priority;
    private \DateTime $createdAt;

    /**
     * @param int $productId
     * @param int $quantity
     * @param int $priority
     * @param \DateTime $createdAt
     */
    public function __construct(int $productId, int $quantity, int $priority, \DateTime $createdAt)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->priority = $priority;
        $this->createdAt = $createdAt;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     */
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority(int $priority): void
    {
        $this->priority = $priority;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }



}