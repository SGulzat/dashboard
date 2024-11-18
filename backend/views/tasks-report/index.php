<?php
/* @var $this yii\web\View */
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<canvas id="tasksByDepartment"></canvas>
<script>
    // первый отчет
    let departments = <?= $departments ?>;
    let departmentsCounts = <?= $departmentsCounts ?>;


    const ctx = document.getElementById('tasksByDepartment').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: departments,
            datasets: [
                {
                    label: 'Количество задач',
                    data: departmentsCounts, // Замените на реальные данные
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
</script>

<hr />

<canvas id="tasksByLevel"></canvas>
<script>
    let taskLevels = <?= $taskLevels ?>;
    let taskLevelsCounts = <?= $taskLevelsCounts ?>;
    const ctx2 = document.getElementById('tasksByLevel').getContext('2d');
    new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: taskLevels,
            datasets: [
                {
                    data: taskLevelsCounts, // Замените на реальные данные
                    backgroundColor: [
                        'rgb(75, 192, 192)',
                        'rgb(255, 205, 86)',
                        'rgb(255, 99, 132)',
                    ],
                },
            ],
        },
    });
</script>

<hr />


<canvas id="tasksLevelsByDepartment"></canvas>
<script>
    let departments2 = <?= $departments ?>;
    let datasetsForThirdChart = <?= $datasetsForThirdChart ?>;

    const ctx6 = document
        .getElementById('tasksLevelsByDepartment')
        .getContext('2d');
    new Chart(ctx6, {
        type: 'bar',
        data: {
            labels: departments2,
            datasets: datasetsForThirdChart
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
</script>

<hr />


<?php if ($allDepartments): ?>
<select class="form-control" name="department-select" id="department-select">
    <?php foreach ($allDepartments as $department): ?>
        <option value="<?= $department['id'] ?>" <?php if ($departmentId != null && $departmentId == $department['id']) { echo 'selected';} ?>><?= $department['name'] ?></option>
    <?php endforeach; ?>
</select>
<?php endif; ?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<canvas id="tasksStatusByEmployee"></canvas>
<script>

    $("#department-select").change(function(){
        window.location.href = '/tasks-report/index?departmentId=' + $(this).val();
    });

    let allEmployess = <?=$allEmployess ?>;
    let taskStatuses = <?= $taskStatuses ?>;
    let datasetsForFourChart = <?= $datasetsForFourChart ?>;


    const ctx7 = document
        .getElementById('tasksStatusByEmployee')
        .getContext('2d');
    new Chart(ctx7, {
        type: 'bar',
        data: {
            labels: allEmployess,
            datasets: datasetsForFourChart
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
</script>

