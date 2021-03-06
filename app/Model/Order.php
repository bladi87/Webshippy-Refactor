<?php declare(strict_types=1);

namespace App\Model;

class Order
{
    const LOW = "low";
    const MEDIUM = "medium";
    const HIGH = "high";

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
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    public function getPriorityAsText(): string
    {
        return match ($this->priority) {
            1 => self::LOW,
            2 => self::MEDIUM,
            default => self::HIGH,
        };
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

}