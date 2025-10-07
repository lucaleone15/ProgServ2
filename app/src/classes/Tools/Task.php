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

    const STATUS = [
        'to_do' => 'À faire',
        'in_progress' => 'En cours',
        'completed' => 'Terminé'
    ];

    const PRIORITIES = [
        'low' => 'Faible',
        'normal' => 'Normal',
        'high' => 'Élevé'
    ];

    const CATEGORIES = [
        'work' => 'Travail',
        'school' => 'Études',
        'hobby' => 'Loisir',
        'personnal' => 'Personnel'
    ];

    public function __construct(?int $id, string $name, string $description, string $status, string $priority, \DateTime $endDate, string $category) {
        if (empty($name)) {
            throw new \InvalidArgumentException("Le nom de la tâche est requis.");
        } else if (strlen($name) < 2) {
            throw new \InvalidArgumentException("Le nom de la tâche doit contenir au moins 2 caractères.");
        }

        if (empty($status)) {
            throw new \InvalidArgumentException("Le statut de la tâche est requis.");
        } else if (!array_key_exists($status, self::STATUS)) {
            throw new \InvalidArgumentException("Le statut de la tâche est invalide.");
        }

        if (empty($priority)) {
            throw new \InvalidArgumentException("La priorité de la tâche est requise.");
        } else if (!array_key_exists($priority, self::PRIORITIES)) {
            throw new \InvalidArgumentException("La priorité de la tâche est invalide.");
        }

        if (empty($endDate)) {
            throw new \InvalidArgumentException("La date limite est requise.");
        } elseif (!$endDate instanceof \DateTime) {
            throw new \InvalidArgumentException("La date limite doit être au format AAAA-MM-JJ.");
        }

        if (empty($category)) {
            throw new \InvalidArgumentException("La catégorie de la tâche est requise.");
        } else if (!array_key_exists($category, self::CATEGORIES)) {
            throw new \InvalidArgumentException("La catégorie de la tâche est invalide.");
        }

        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->status = $status;
        $this->priority = $priority;
        $this->endDate = $endDate;
        $this->category = $category;
    }

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

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        if (empty($name)) {
            throw new \InvalidArgumentException("Le nom de la tâche est requis.");
        } else if (strlen($name) < 2) {
            throw new \InvalidArgumentException("Le nom de la tâche doit contenir au moins 2 caractères.");
        }

        $this->name = $name;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setStatus(string $status): void {
        if (empty($status)) {
            throw new \InvalidArgumentException("Le type de la tâche est requis.");
        } else if (!array_key_exists($status, self::STATUS)) {
            throw new \InvalidArgumentException("Le type de la tâche est invalide.");
        }

        $this->status = $status;
    }

    public function setPriority(string $priority): void {
        if (empty($priority)) {
            throw new \InvalidArgumentException("La priorité de la tâche est requise.");
        } else if (!array_key_exists($priority, self::PRIORITIES)) {
            throw new \InvalidArgumentException("La priorité de la tâche est invalide.");
        }

        $this->priority = $priority;
    }

    public function setEndDate(\DateTime $endDate): void {
        if (empty($endDate)) {
            throw new \InvalidArgumentException("La date limite est requise.");
        } elseif (!$endDate instanceof \DateTime) {
            throw new \InvalidArgumentException("La date limite doit être au format AAAA-MM-JJ.");
        }

        $this->endDate = $endDate;
    }

    public function setCategory(string $category): void {
        if (empty($category)) {
            throw new \InvalidArgumentException("La catégorie de la tâche est requise.");
        } else if (!array_key_exists($category, self::CATEGORIES)) {
            throw new \InvalidArgumentException("La catégorie de la tâche est invalide.");
        }

        $this->category = $category;
    }
}