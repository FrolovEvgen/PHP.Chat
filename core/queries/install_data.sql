USE `wchat`;

--
-- Запоминаем текущее время.
--

SET @TIME_NOW = UNIX_TIMESTAMP('2020-02-17 00:00:01');

-- --------------------------------------------------------

--
-- Добавляем пользователей.
--

INSERT INTO `users`
(`id`, `username`, `email`, `phone`, `icon`, `created`,`updated`)
VALUES
(NULL, "Петя", "petya@email.tst", "36456325462", "user1.jpg", @TIME_NOW, @TIME_NOW),
(NULL, "Вася", "vasya@email.tst", "54754785549", "user2.jpg", @TIME_NOW, @TIME_NOW),
(NULL, "Федя", "fedya@email.tst", "06856898658", "user3.jpg", @TIME_NOW, @TIME_NOW),
(NULL, "Вика", "vika80@email.tst", "3553534655", "user4.jpg", @TIME_NOW, @TIME_NOW),
(NULL, "Настя", "nastya12@email.tst", "4564765", "user5.jpg", @TIME_NOW, @TIME_NOW),
(NULL, "Юля", "yulja@email.tst", "567574757574", "user6.jpg", @TIME_NOW, @TIME_NOW),
(NULL, "Дима", "dima@email.tst", "965968958498", "user7.jpg", @TIME_NOW, @TIME_NOW),
(NULL, "Жорик", "zhora@email.tst", "6354635466", "user8.jpg", @TIME_NOW, @TIME_NOW),
(NULL, "Вадим", "vadim@email.tst", "3645635462", "user9.jpg", @TIME_NOW, @TIME_NOW),
(NULL, "Николай", "kolya@email.tst", "6546366", "user10.jpg", @TIME_NOW, @TIME_NOW),
(NULL, "Evgeniy", "evgen@email.tst", "3335355", "user11.jpg", @TIME_NOW, @TIME_NOW);

-- --------------------------------------------------------

--
-- Добавляем сообщения.
--

INSERT INTO `messages`
(`id`, `from_id`, `to_id`, `message`, `created`)
VALUES
(NULL, 11, 1, "Привет!;)", UNIX_TIMESTAMP('2020-02-17 01:00:00')),
(NULL, 11, 2, "Привет!;)", UNIX_TIMESTAMP('2020-02-17 01:05:00')),
(NULL, 11, 3, "Привет!;)", UNIX_TIMESTAMP('2020-02-17 01:10:00')),
(NULL, 11, 4, "Привет!;)", UNIX_TIMESTAMP('2020-02-17 01:15:00')),
(NULL, 11, 5, "Привет! Как дела?;)", UNIX_TIMESTAMP('2020-02-17 01:20:00')),
(NULL, 11, 6, "Привет! Как дела?;)", UNIX_TIMESTAMP('2020-02-17 01:25:00')),
(NULL, 11, 7, "Привет!;)", UNIX_TIMESTAMP('2020-02-17 01:30:03')),
(NULL, 11, 8, "Привет!;)", UNIX_TIMESTAMP('2020-02-17 01:35:00')),
(NULL, 11, 9, "=)", UNIX_TIMESTAMP('2020-02-17 01:40:00')),
(NULL, 11, 10, "Привет!;)", UNIX_TIMESTAMP('2020-02-17 01:45:10')),
(NULL, 1, 11, "О! Привет!", UNIX_TIMESTAMP('2020-02-17 02:10:01')),
(NULL, 1, 11, "Как дела?", UNIX_TIMESTAMP('2020-02-17 02:10:12')),
(NULL, 11, 1, "Нормально.. Сам как?", UNIX_TIMESTAMP('2020-02-17 02:20:15')),
(NULL, 1, 11, "Та я вот сижу и домашку пилю.", UNIX_TIMESTAMP('2020-02-17 02:22:00')),
(NULL, 1, 11, "А еще и приболел немного.", UNIX_TIMESTAMP('2020-02-17 02:24:10')),
(NULL, 11, 1, "Что нового?", UNIX_TIMESTAMP('2020-02-17 02:30:01')),
(NULL, 1, 11, "Та сваливаю на выхах.", UNIX_TIMESTAMP('2020-02-17 02:31:22')),
(NULL, 2, 11, "Дарова братан!!!", UNIX_TIMESTAMP('2020-02-17 03:11:01')),
(NULL, 3, 11, "Ты кто такой?!", UNIX_TIMESTAMP('2020-02-17 04:12:11')),
(NULL, 4, 11, "Ты где пропал?!", UNIX_TIMESTAMP('2020-02-17 05:33:30')),
(NULL, 5, 11, "Все норм! Только приехала..", UNIX_TIMESTAMP('2020-02-17 05:45:12')),
(NULL, 6, 11, "Все нормально =)", UNIX_TIMESTAMP('2020-02-17 06:12:01')),
(NULL, 7, 11, "Слушай..тут такая тема надо встретится..", UNIX_TIMESTAMP('2020-02-17 06:15:11')),
(NULL, 8, 11, "Приветы!", UNIX_TIMESTAMP('2020-02-17 06:20:01')),
(NULL, 9, 11, ";)", UNIX_TIMESTAMP('2020-02-17 06:34:00')),
(NULL, 10, 11, "Неть меня ))))))))", UNIX_TIMESTAMP('2020-02-17 06:40:00'));