<?php

namespace App;

function printStudentInfo(Student $student): void
{
    printf(
        "Студент: %s %s | Средний балл: %.2f\n",
        $student->getFirstName(),
        $student->getLastName(),
        $student->getAverage()
    );
}

function printGroupInfo(Group $group): void
{
    printf(
        "\nГруппа: %s | Студентов: %d | Средний балл по группе: %.2f\n",
        $group->getGroupName(),
        count($group->getStudents()),
        $group->getGroupAverage()
    );
}
