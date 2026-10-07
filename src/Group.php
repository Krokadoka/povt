<?php

namespace App;

class Group
{
    private string $groupName;
    private array $students = [];

    public function __construct(string $groupName)
    {
        $this->groupName = $groupName;
    }

    public function addStudent(Student $student): void
    {
        $this->students[] = $student;
    }

    public function getGroupAverage(): float
    {
        if (empty($this->students)) {
            return 0.0;
        }

        $sum = 0.0;
        foreach ($this->students as $student) {
            $sum += $student->getAverage();
        }

        return $sum / count($this->students);
    }

    public function getBestStudent(): ?Student
    {
        if (empty($this->students)) {
            return null;
        }

        $best = $this->students[0];
        foreach ($this->students as $student) {
            if ($student->getAverage() > $best->getAverage()) {
                $best = $student;
            }
        }

        return $best;
    }

    public function getGroupName(): string
    {
        return $this->groupName;
    }

    public function getStudents(): array
    {
        return $this->students;
    }
}
