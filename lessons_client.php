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
    <a class="logout-link" href="logout.php">Выйти</a>
    <h2>Факультативные занятия</h2>
    <table class="site-table">
        <thead>
        <tr>
            <th>No</th>
            <th>Предмет</th>
            <th>Время</th>
            <th>Аудитория</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($lessons as $lesson) { ?>
                <tr>
                    <td><?php echo $lesson['id'] ?></td>
                    <td><?php echo $lesson['subject'] ?></td>
                    <td><?php echo $lesson['time'] ?></td>
                    <td><?php echo $lesson['room'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php include("footer.php") ?>

