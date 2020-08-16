<?php
// Подключаем файл с общими функциями
include("common.php");
// Функция для создания новой сессии или открытия предыдущей сессии.
session_start();

// Проверяем авторизированы  ли мы
if (isset($_SESSION['login'])) {
    // Подключаемся к базе данных
    $db =  connect_to_mysql();
    // Формируем сложный SQL запрос, частью которого является user_id, который храниться в переменных сессии. user_id=id авторизированного пользователя из таблицы users 
    $sqlquery='SELECT lessons.*,  count(records.lessons_id)>0 as is_described FROM lessons LEFT JOIN records ON lessons.id=records.lessons_id and records.user_id='. $_SESSION['user_id'] .' GROUP BY lessons.id';
    // Выполняем запрос.
    $results = $db->query($sqlquery);
    $lessons = array();
    // Сохраняем ответ в локальной переменной.
    while ($row = $results->fetch_array()) {
        $lessons[] = $row;
    }
} else {
    // В случае если пользоваетель не авторизирован => перенаправляем на страницу входа с ошибокй "Вы не авторизованы!"
    header("Status: 301 Moved Permanently");
    header("Location:index.php?error=Вы не авторизованы!");
    exit;
}
?>

<?php 
// Начинаем выводить страницу с шапки страницы. За формирование шапки страницы отвечает header.php
include("header.php") ?>
<div class="lessons-wrap">
    <!-- Формиуем кнопку выхода из сервсиа -->
    <a class="logout-link" href="logout.php">Выйти</a>
    <h2>Факультативные занятия</h2>
    <!-- Таблица со списком занятий. Сначала заголовок таблицы-->
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
        <!-- Тело таблицы в котором мы выводим значения из ранее сохранненого локального массива -->
            <?php foreach ($lessons as $lesson) { ?>
                <tr>
                    <td><?php echo $lesson['id'] ?></td>
                    <td><?php echo $lesson['subject'] ?></td>
                    <td><?php echo $lesson['time'] ?></td>
                    <td><?php echo $lesson['room'] ?></td>
                    <td><?php 
                    // В поле "Действие" мы выводим либо записатся либо отписаться в зависимости от того заисан ли пользоваетель на данной занятие.
                    // Кнопка "Описаться" выделяется красным цеветом.
                    if($lesson['is_described']){ ?> 
                                  <a style="background-color: red;" href="lesson_unsubscribe.php?lesson_id=<?php echo $lesson['id'] ?>">Отписаться</a>
                        <?php }else{ ?>
                                  <a href="lesson_subscribe.php?lesson_id=<?php echo $lesson['id'] ?>">Записаться</a>
                        <?php } ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <!-- Конец таблицы -->
</div>
<!-- ВЫводим нижню часть страницы за  которую отвечает footer.php -->
<?php include("footer.php") ?>

