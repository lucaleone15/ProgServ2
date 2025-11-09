<?php

namespace Tasks;

use DateTime;
use InvalidArgumentException;

class Task {
    private ?int $id;
    private int $userId;
    private string $name;
    private string $description;
    private string $status;
    private string $priority;
    private DateTime $endDate;
    private string $category;

    const STATUSES = [
        'todo' => 'tasks.status.todo',
        'in_progress' => 'tasks.status.in_progress',
        'done' => 'tasks.status.done'
    ];

    const PRIORITIES = [
        'low' => 'tasks.priority.low',
        'medium' => 'tasks.priority.medium',
        'high' => 'tasks.priority.high'
    ];

    const CATEGORIES = [
        'work' => 'tasks.category.work',
        'personal' => 'tasks.category.personal',
        'shopping' => 'tasks.category.shopping',
        'other' => 'tasks.category.other'
    ];

    public function __construct(
        ?int $id,
        int $userId,
        string $name,
        string $description,
        string $status,
        string $priority,
        DateTime $endDate,
        string $category
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->setName($name);
        $this->description = $description;
        $this->setStatus($status);
        $this->setPriority($priority);
        $this->endDate = $endDate;
        $this->setCategory($category);
    }

    // Getters
    public function getId(): ?int {
        return $this->id;
    }

    public function getUserId(): int {
        return $this->userId;
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

    public function getEndDate(): DateTime {
        return $this->endDate;
    }

    public function getCategory(): string {
        return $this->category;
    }

    // Setters avec validation
    public function setName(string $name): void {
        if (empty(trim($name))) {
            throw new InvalidArgumentException(__t('tasks.error.empty_name'));
        }
        if (strlen($name) < 2) {
            throw new InvalidArgumentException(__t('tasks.error.name_too_short'));
        }
        $this->name = trim($name);
    }

    public function setStatus(string $status): void {
        if (!array_key_exists($status, self::STATUSES)) {
            throw new InvalidArgumentException(__t('tasks.error.invalid_status'));
        }
        $this->status = $status;
    }

    public function setPriority(string $priority): void {
        if (!array_key_exists($priority, self::PRIORITIES)) {
            throw new InvalidArgumentException(__t('tasks.error.invalid_priority'));
        }
        $this->priority = $priority;
    }

    public function setCategory(string $category): void {
        if (!array_key_exists($category, self::CATEGORIES)) {
            throw new InvalidArgumentException(__t('tasks.error.invalid_category'));
        }
        $this->category = $category;
    }

    // Méthodes pour obtenir les traductions
    public function getTranslatedStatus(): string {
        return __t(self::STATUSES[$this->status]);
    }

    public function getTranslatedPriority(): string {
        return __t(self::PRIORITIES[$this->priority]);
    }

    public function getTranslatedCategory(): string {
        return __t(self::CATEGORIES[$this->category]);
    }

    // Méthodes statiques pour obtenir les listes traduites
    public static function getTranslatedStatuses(): array {
        $translated = [];
        foreach (self::STATUSES as $key => $translationKey) {
            $translated[$key] = __t($translationKey);
        }
        return $translated;
    }

    public static function getTranslatedPriorities(): array {
        $translated = [];
        foreach (self::PRIORITIES as $key => $translationKey) {
            $translated[$key] = __t($translationKey);
        }
        return $translated;
    }

    public static function getTranslatedCategories(): array {
        $translated = [];
        foreach (self::CATEGORIES as $key => $translationKey) {
            $translated[$key] = __t($translationKey);
        }
        return $translated;
    }
}