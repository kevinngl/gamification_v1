-- auto-generated definition
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


-- auto-generated definition
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

-- auto-generated definition
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



-- auto-generated definition
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



-- auto-generated definition
create table quiz
(
    id         int auto_increment
        primary key,
    module_id  int                                not null,
    course_id  int                                null,
    question   text                               not null,
    option_a   varchar(255)                       null,
    option_b   varchar(255)                       null,
    option_c   varchar(255)                       null,
    option_d   varchar(255)                       null,
    answer     varchar(255)                       null,
    created_at datetime default CURRENT_TIMESTAMP null,
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

-- auto-generated definition
create table quiz_attempts
(
    id           int auto_increment
        primary key,
    user_id      int                                                                   not null,
    course_id    int                                                                   not null,
    score        int                                         default 0                 not null,
    result       enum ('gold', 'diamond', 'bronze', 'stone') default 'stone'           not null,
    coin_earned  int                                         default 0                 not null,
    completed_at timestamp                                   default CURRENT_TIMESTAMP null,
    constraint fk_quiz_attempts_course
        foreign key (course_id) references course (course_id)
            on update cascade on delete cascade,
    constraint fk_quiz_attempts_user
        foreign key (user_id) references users (user_id)
            on update cascade on delete cascade
)
    collate = utf8mb4_general_ci;

