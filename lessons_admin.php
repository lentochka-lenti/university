<?php
session_start();
if (isset($_SESSION['login'])) {
    $db = new SQLite3('db.db');
    $results = $db->query('SELECT * FROM lesson');
    $lessons = array();
    while ($row = $results->fetchArray()) {
        $lessons[] = $row;
    }
} else {
    header("Status: 301 Moved Permanently");
    header("Location:index.php?error=Вы не авторизованы!");
    exit;
}
?>

<?php include("header.php") ?>
<div class="lessons-wrap">
    <a href="lesson.php?lesson_id=0">Добавить</a>
    <a class="logout-link" href="logout.php">Выйти</a>
    <h2>Факультативные занятия</h2>
    <table class="site-table">
        <thead>
        <tr>
            <th>No</th>
            <th>Предмет</th>
            <th>Время</th>
            <th>Аудитория</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($lessons as $lesson) { ?>
        <tr>
            <td><?php echo $lesson['id'] ?></td>
            <td><?php echo $lesson['subject'] ?></td>
            <td><?php echo $lesson['time'] ?></td>
            <td><?php echo $lesson['room'] ?></td>
            <td>
                <a href="lesson_remove.php?lesson_id=<?php echo $lesson['id'] ?>">Удалить</a>&nbsp;|&nbsp;
                <a href="lesson.php?lesson_id=<?php echo $lesson['id'] ?>">Редактировать</a>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php include("footer.php") ?>

