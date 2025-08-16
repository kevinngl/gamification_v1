-- Quiz
create table quiz
(
    id             int auto_increment
        primary key,
    module_id      int                                not null,
    course_id      int                                null,
    question       text                               not null,
    option_a       varchar(255)                       null,
    option_b       varchar(255)                       null,
    option_c       varchar(255)                       null,
    option_d       varchar(255)                       null,
    correct_answer varchar(255)                       null,
    created_at     datetime default CURRENT_TIMESTAMP null,
    constraint fk_quiz_course
        foreign key (course_id) references course (course_id)
            on update cascade on delete cascade,
    constraint quiz_ibfk_1
        foreign key (module_id) references module (module_id)
            on update cascade on delete cascade
)
    collate = utf8mb4_general_ci;

create index module_id
    on quiz (module_id);

-- Insert Quiz

INSERT INTO gamification.quiz (id, module_id, course_id, question, option_a, option_b, option_c, option_d, correct_answer, created_at) VALUES (2, 1, 1, 'apakah kita perlu adili jokowi?', 'a', 'b', 'c', 'd', 'option_a', '2025-08-09 21:26:49');
INSERT INTO gamification.quiz (id, module_id, course_id, question, option_a, option_b, option_c, option_d, correct_answer, created_at) VALUES (3, 1, 1, 'formData.appendformData.append', 'a', 'b', 'c', 'd', 'option_a', '2025-08-09 21:27:54');
INSERT INTO gamification.quiz (id, module_id, course_id, question, option_a, option_b, option_c, option_d, correct_answer, created_at) VALUES (4, 1, 1, 'formData.appendformData.append', 'j', 'ih', 'nj', 'nj', 'option_a', '2025-08-09 21:28:08');
INSERT INTO gamification.quiz (id, module_id, course_id, question, option_a, option_b, option_c, option_d, correct_answer, created_at) VALUES (5, 1, 1, 'formData.appendformData.append', 'bj', 'bj', 'bj', 'bj', 'option_a', '2025-08-09 21:28:20');
INSERT INTO gamification.quiz (id, module_id, course_id, question, option_a, option_b, option_c, option_d, correct_answer, created_at) VALUES (6, 1, 1, 'formData.appendformData.append', 'tt', 't', 't', 't', 'option_a', '2025-08-09 21:28:37');
INSERT INTO gamification.quiz (id, module_id, course_id, question, option_a, option_b, option_c, option_d, correct_answer, created_at) VALUES (7, 1, 1, 'formData.append', 'oko', 'ok', 'ko', 'ko', 'option_a', '2025-08-09 21:28:51');
INSERT INTO gamification.quiz (id, module_id, course_id, question, option_a, option_b, option_c, option_d, correct_answer, created_at) VALUES (8, 1, 1, 'formData.appendformData.append', 'kml', 'ml', 'ml', 'ml', 'option_a', '2025-08-09 21:28:57');
INSERT INTO gamification.quiz (id, module_id, course_id, question, option_a, option_b, option_c, option_d, correct_answer, created_at) VALUES (9, 1, 1, 'formData.appendformData.append', 'mk', 'km', 'knm', 'ki', 'option_a', '2025-08-09 21:29:03');
INSERT INTO gamification.quiz (id, module_id, course_id, question, option_a, option_b, option_c, option_d, correct_answer, created_at) VALUES (10, 1, 1, 'formData.appendformData.append', 'oh', 'oih', 'oh', 'oh', 'option_a', '2025-08-09 21:29:26');
INSERT INTO gamification.quiz (id, module_id, course_id, question, option_a, option_b, option_c, option_d, correct_answer, created_at) VALUES (11, 1, 1, 'formData.append', 'kj', 'pk', 'poj', 'jpo', 'option_a', '2025-08-09 21:29:33');

-- Course

create table course
(
    course_id   int auto_increment
        primary key,
    name        varchar(255)                         not null,
    description text                                 null,
    image       varchar(255)                         null,
    link        varchar(255)                         null,
    material    varchar(255)                         null,
    coin        int                                  null,
    challenge   tinyint(1) default 0                 null,
    created_at  datetime   default CURRENT_TIMESTAMP null
)
    collate = utf8mb4_general_ci;

-- Insert Course
INSERT INTO gamification.course (course_id, name, description, image, link, material, coin, challenge, created_at) VALUES (1, 'Pengenalan SQL untuk Pemula', 'Ini adalah kursus pengantar yang dirancang untuk memperkenalkan Anda pada dasar-dasar pemrograman PHP dan database MySQL.', 'image_656f4ce697d3c.jpg', 'https://www.youtube.com/embed/dQw4w9WgXcQ', 'gam_688a1d8019033.pdf', 20, 0, '2025-07-30 20:26:24');

-- Module

create table module
(
    module_id   int auto_increment
        primary key,
    course_id   int                                not null,
    name        varchar(255)                       not null,
    description text                               null,
    created_at  datetime default CURRENT_TIMESTAMP null,
    constraint module_ibfk_1
        foreign key (course_id) references course (course_id)
            on update cascade on delete cascade
)
    collate = utf8mb4_general_ci;

create index course_id
    on module (course_id);

-- Insert Module
INSERT INTO gamification.module (module_id, course_id, name, description, created_at) VALUES (1, 1, 'Pengenalan Sintaks Dasar SQL', 'Pengenalan Sintaks Dasar SQLPengenalan Sintaks Dasar SQLPengenalan Sintaks Dasar SQLPengenalan Sintaks Dasar SQLPengenalan Sintaks Dasar SQL', '2025-07-30 21:07:55');

-- Track
create table track
(
    id              int auto_increment
        primary key,
    user_id         int                                not null,
    course_id       int                                not null,
    progress        int      default 0                 null,
    completion_date datetime                           null,
    created_at      datetime default CURRENT_TIMESTAMP null,
    win             varchar(50)                        null,
    score           int      default 0                 null,
    constraint user_id
        unique (user_id, course_id),
    constraint track_ibfk_1
        foreign key (user_id) references users (user_id)
            on update cascade on delete cascade,
    constraint track_ibfk_2
        foreign key (course_id) references course (course_id)
            on update cascade on delete cascade
)
    collate = utf8mb4_general_ci;

create index course_id
    on track (course_id);

-- Insert Track
INSERT INTO gamification.track (id, user_id, course_id, progress, completion_date, created_at, win, score) VALUES (1, 3, 1, 0, null, '2025-08-10 12:39:49', 'stone', 45);

-- Users
create table users
(
    user_id    int auto_increment
        primary key,
    username   varchar(255)                          not null,
    email      varchar(255)                          not null,
    password   varchar(255)                          not null,
    role       varchar(50) default 'user'            null,
    created_at datetime    default CURRENT_TIMESTAMP null,
    earnings   int         default 0                 null,
    xps_coin   int         default 0                 not null,
    constraint email
        unique (email)
)
    collate = utf8mb4_general_ci;


-- Insert Users
INSERT INTO gamification.users (user_id, username, email, password, role, created_at, earnings, xps_coin) VALUES (1, 'oliver', 'oliver@gmail.com', '$2y$10$H5m0Fvt2dlJttCPUTQ2QWuF.FKyC8Zad6jWgeHeFVshfFoV2RBrQ6', 'user', '2025-07-30 19:49:03', 0, 0);
INSERT INTO gamification.users (user_id, username, email, password, role, created_at, earnings, xps_coin) VALUES (2, 'admin', 'admin@admin.com', '$2y$10$dA8cloqU2tNDDFBE/iifq.Qu9gWuJn520PKzo1o7PcpKg137UwRy2', 'admin', '2025-07-30 19:50:03', 0, 0);
INSERT INTO gamification.users (user_id, username, email, password, role, created_at, earnings, xps_coin) VALUES (3, 'kevinngl', 'kevinngl@gmail.com', '$2y$10$PdMwJL7w3Oq1fiBF1tH33uzi7iZqvGv7uu1OrJiIjs5MGoDtO2R7K', 'user', '2025-08-10 07:18:43', 60, 0);
INSERT INTO gamification.users (user_id, username, email, password, role, created_at, earnings, xps_coin) VALUES (4, 'pragoyang', 'pragoyang@gmail.com', '$2y$10$s.KQSh9ENqjaFKG3duYcaOst9lyi32FsBqN/5I5azmXr4GTXVEE9a', 'user', '2025-08-10 13:23:01', 0, 0);
INSERT INTO gamification.users (user_id, username, email, password, role, created_at, earnings, xps_coin) VALUES (5, 'test123', 'test123@gmail.com', '$2y$10$.9tYFdAGdSBE7Gs0o0uTZerdQ5Im0L.N3n2K5E9WLrebTWAe2Q8Ui', 'user', '2025-08-10 13:23:48', 20, 0);
