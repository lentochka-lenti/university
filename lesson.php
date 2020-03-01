<?php
session_start();
if (isset($_SESSION['login'])) {
    $lesson = array(
      'id' => 0,
      'subject' => '',
      'time' => '',
      'room' => ''
    );
    if((int)$_GET['lesson_id'] > 0) {
        $db = new SQLite3('db.db');
        $results = $db->query('SELECT * FROM lesson');
        $lessons = array();
        while ($row = $results->fetchArray()) {
            $lesson = array(
                'id' => $row['id'],
                'subject' => $row['subject'],
                'time' => $row['time'],
                'room' =>  $row['room']
            );
        }
    }
} else {
    header("Status: 301 Moved Permanently");
    header("Location:index.php?error=Вы не авторизованы!");
    exit;
}
?>

<?php include("header.php") ?>
<div class="lesson-wrap">
    <a href="lessons_admin.php">Назад</a>
    <a class="logout-link" href="logout.php">Выйти</a>
    <?php if($_GET['lesson_id'] == 0) { ?>
        <h2>Добавить факультативное занятие</h2>
    <?php } else { ?>
        <h2>Редактировать факультативное занятие</h2>
    <?php }  ?>
    <form action="lesson_edit.php" method="post">
        <input type="hidden" name="lesson_id" value="<?php echo $_GET['lesson_id']; ?>">
        <div class="form-group">
            <input type="text" name="subject" class="site-control" value="<?php echo $lesson['subject']; ?>" placeholder="Предмет">
        </div>
        <div class="form-group">
            <input type="text" name="time" class="site-control" value="<?php echo $lesson['time']; ?>" placeholder="Время">
        </div>
        <div class="form-group">
            <input type="text" name="room" class="site-control" value="<?php echo $lesson['room']; ?>" placeholder="Аудитория">
        </div>
        <div class="form-btn-wrap">
            <button class="site-btn" type="submit">Сохранить</button>
        </div>
    </form>
</div>
<?php include("footer.php") ?>


