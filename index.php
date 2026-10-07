<?php

require_once 'vendor/autoload.php';

use App\Student;
use App\Group;
use function App\printStudentInfo;
use function App\printGroupInfo;

function readLineTrimmed(string $prompt): string
{
    echo $prompt;
    $line = fgets(STDIN);
    return trim($line === false ? '' : $line);
}

function readIntInRange(string $prompt, int $min, int $max): int
{
    while (true) {
        $value = readLineTrimmed($prompt);
        if (ctype_digit($value) && (int)$value >= $min && (int)$value <= $max) {
            return (int)$value;
        }
        echo "Ошибка: введите целое число от $min до $max.\n";
    }
}

function readNonEmptyString(string $prompt): string
{
    while (true) {
        $value = readLineTrimmed($prompt);
        if ($value !== '') {
            return $value;
        }
        echo "Ошибка: значение не может быть пустым.\n";
    }
}

function readGrade(string $prompt): float
{
    while (true) {
        $value = readLineTrimmed($prompt);
        if (is_numeric($value) && $value >= 0 && $value <= 10) {
            return (float)$value;
        }
        echo "Ошибка: оценка должна быть числом от 0 до 10.\n";
    }
}

function inputStudent(): Student
{
    $firstName = readNonEmptyString('Имя студента: ');
    $lastName  = readNonEmptyString('Фамилия студента: ');

    $student = new Student($firstName, $lastName);

    $gradesCount = readIntInRange('Сколько оценок будет введено (1-20): ', 1, 20);
    for ($i = 1; $i <= $gradesCount; $i++) {
        $grade = readGrade("  Оценка #$i (0-10): ");
        $student->addGrade($grade);
    }

    return $student;
}

function inputGroup(): Group
{
    $groupName = readNonEmptyString('Название группы: ');
    $group = new Group($groupName);

    $studentsCount = readIntInRange('Сколько студентов добавить в группу (1-50): ', 1, 50);
    for ($i = 1; $i <= $studentsCount; $i++) {
        echo "\n--- Студент #$i ---\n";
        $group->addStudent(inputStudent());
    }

    return $group;
}

echo "=== Система учёта студентов и оценок ===\n\n";

$group = inputGroup();

echo "\n=== Информация о студентах ===\n";
foreach ($group->getStudents() as $student) {
    printStudentInfo($student);
}

printGroupInfo($group);

$best = $group->getBestStudent();
if ($best !== null) {
    echo "\nЛучший студент группы:\n";
    printStudentInfo($best);
}
