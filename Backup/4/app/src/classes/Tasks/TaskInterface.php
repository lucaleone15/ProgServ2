<?php

namespace Tasks;

interface TaskInterface {
    public function getId(): ?int;
    public function getName(): string;
    public function getDescription(): string;
    public function getStatus(): string;
    public function getPriority(): string;
    public function getEndDate(): \DateTime;
    public function getCategory(): string;

    public function setId(int $id): void;
    public function setName(string $name): void;
    public function setDescription(string $description): void;
    public function setStatus(string $status): void;
    public function setPriority(string $priority): void;
    public function setEndDate(\DateTime $endDate): void;
    public function setCategory(string $category): void;
}