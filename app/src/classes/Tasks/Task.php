<?php

namespace Tasks;

use DateTime;

class Task implements TaskInterface {
    private ?int $id;
    private string $name;
    private string $description;
    private string $status;
    private string $priority;
    private \DateTime $endDate;
    private string $category;

    // Identifiants seulement, les labels sont traduits via __t() dans les vues
    const STATUS = [
        'to_do' => 'to_do',
        'in_progress' => 'in_progress',
        'completed' => 'completed'
    ];

    const PRIORITIES = [
        'low' => 'low',
        'normal' => 'normal',
        'high' => 'high'
    ];

    const CATEGORIES = [
        'work' => 'work',
        'school' => 'school',
        'hobby' => 'hobby',
        'personal' => 'personal'
    ];

    public function __construct(?int $id, string $name, string $description, string $status, string $priority, \DateTime $endDate, string $category) {
        $this->setName($name);
        $this->setDescription($description);
        $this->setStatus($status);
        $this->setPriority($priority);
        $this->setEndDate($endDate);
        $this->setCategory($category);
        $this->id = $id;
    }

    // --- GETTERS ---
    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getPriority(): string {
        return $this->priority;
    }

    public function getEndDate(): \DateTime {
        return $this->endDate;
    }

    public function getCategory(): string {
        return $this->category;
    }

    // --- SETTERS ---
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        if (empty($name)) {
            throw new \InvalidArgumentException(__t('task_construct.empty_name'));
        } elseif (strlen($name) < 2) {
            throw new \InvalidArgumentException(__t('task_construct.invalid_name'));
        }
        $this->name = $name;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setStatus(string $status): void {
        if (empty($status)) {
            throw new \InvalidArgumentException(__t('task_construct.empty_status'));
        } elseif (!array_key_exists($status, self::STATUS)) {
            throw new \InvalidArgumentException(__t('task_construct.invalid_status'));
        }
        $this->status = $status;
    }

    public function setPriority(string $priority): void {
        if (empty($priority)) {
            throw new \InvalidArgumentException(__t('task_construct.empty_priority'));
        } elseif (!array_key_exists($priority, self::PRIORITIES)) {
            throw new \InvalidArgumentException(__t('task_construct.invalid_priority'));
        }
        $this->priority = $priority;
    }

    public function setEndDate(\DateTime $endDate): void {
        if (empty($endDate)) {
            throw new \InvalidArgumentException(__t('task_construct.empty_date'));
        } elseif (!$endDate instanceof \DateTime) {
            throw new \InvalidArgumentException(__t('task_construct.invalid_date'));
        }
        $this->endDate = $endDate;
    }

    public function setCategory(string $category): void {
        if (empty($category)) {
            throw new \InvalidArgumentException(__t('task_construct.empty_category'));
        } elseif (!array_key_exists($category, self::CATEGORIES)) {
            throw new \InvalidArgumentException(__t('task_construct.invalid_category'));
        }
        $this->category = $category;
    }
}
