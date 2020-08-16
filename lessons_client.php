<?php
include("common.php");
session_start();

if (isset($_SESSION['login'])) {
    $db =  connect_to_mysql();
    $sqlquery='SELECT lessons.*,  count(records.lessons_id)>0 as is_described FROM lessons LEFT JOIN records ON lessons.id=records.lessons_id and records.user_id='. $_SESSION['user_id'] .' GROUP BY lessons.id';
    $results = $db->query($sqlquery);
    $lessons = array();
    while ($row = $results->fetch_array()) {
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
            <th>Действие</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($lessons as $lesson) { ?>
                <tr>
                    <td><?php echo $lesson['id'] ?></td>
                    <td><?php echo $lesson['subject'] ?></td>
                    <td><?php echo $lesson['time'] ?></td>
                    <td><?php echo $lesson['room'] ?></td>
                    <td><?php if($lesson['is_described']){ ?> 
                                  <a style="background-color: red;" href="lesson_unsubscribe.php?lesson_id=<?php echo $lesson['id'] ?>">Отписаться</a>
                        <?php }else{ ?>
                                  <a href="lesson_subscribe.php?lesson_id=<?php echo $lesson['id'] ?>">Подписаться</a>
                        <?php } ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php include("footer.php") ?>

