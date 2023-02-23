CREATE DATABASE IF NOT EXISTS test;
USE test;

CREATE TABLE IF NOT EXISTS users
(
    id         BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    login      VARCHAR(128)    NOT NULL UNIQUE KEY,
    password   VARCHAR(255)    NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS articles
(
    id         BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    author_id  BIGINT UNSIGNED NOT NULL,
    title      VARCHAR(512)    NOT NULL,
    image_url  VARCHAR(256)    NOT NULL,
    text       TEXT            NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (author_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS article_comments
(
    id         BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    article_id BIGINT UNSIGNED NOT NULL,
    name       VARCHAR(128),
    url        VARCHAR(256),
    email      VARCHAR(128),
    text       TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (article_id) REFERENCES articles(id)
);


INSERT INTO test.users (login, password, created_at, updated_at) VALUES ('test', '$2y$10$x8pGHW756rr2yNGhqh0Bte3uDFJcM6M8cqDsQYBqYnZqWtqglwfIW', '2023-02-23 09:12:41', '2023-02-23 10:52:57');

INSERT INTO test.articles (author_id, title, image_url, text, created_at, updated_at) VALUES (1, 'test', 'https://via.placeholder.com/150', 'text', '2023-02-22 09:12:56', '2023-02-23 10:12:12');
INSERT INTO test.articles (author_id, title, image_url, text, created_at, updated_at) VALUES (1, 'test2', 'https://via.placeholder.com/150', 'The lorem ipsum is a placeholder text used in publishing and graphic design. This filler text is a short paragraph that contains all the letters of the alphabet. The characters are spread out evenly so that the reader\'s attention is focused on the layout of the text instead of its content. The lorem ipsum is a placeholder text used in publishing and graphic design. This filler text is a short paragraph that contains all the letters of the alphabet. The characters are spread out evenly so that the reader\'s attention is focused on the layout of the text instead of its content. The lorem ipsum is a placeholder text used in publishing and graphic design. This filler text is a short paragraph that contains all the letters of the alphabet. The characters are spread out evenly so that the reader\'s attention is focused on the layout of the text instead of its content.', '2023-02-23 09:12:56', '2023-02-23 09:37:16');
INSERT INTO test.articles (author_id, title, image_url, text, created_at, updated_at) VALUES (1, 'test3', 'https://via.placeholder.com/150', 'The lorem ipsum is a placeholder text used in publishing and graphic design. This filler text is a short paragraph that contains all the letters of the alphabet. The characters are spread out evenly so that the reader\'s attention is focused on the layout of the text instead of its content. The lorem ipsum is a placeholder text used in publishing and graphic design. This filler text is a short paragraph that contains all the letters of the alphabet. The characters are spread out evenly so that the reader\'s attention is focused on the layout of the text instead of its content. The lorem ipsum is a placeholder text used in publishing and graphic design. This filler text is a short paragraph that contains all the letters of the alphabet. The characters are spread out evenly so that the reader\'s attention is focused on the layout of the text instead of its content.', '2023-02-23 09:12:56', '2023-02-23 09:37:16');
INSERT INTO test.articles (author_id, title, image_url, text, created_at, updated_at) VALUES (1, 'test4', 'https://via.placeholder.com/150', 'The lorem ipsum is a placeholder text used in publishing and graphic design. This filler text is a short paragraph that contains all the letters of the alphabet. The characters are spread out evenly so that the reader\'s attention is focused on the layout of the text instead of its content. The lorem ipsum is a placeholder text used in publishing and graphic design. This filler text is a short paragraph that contains all the letters of the alphabet. The characters are spread out evenly so that the reader\'s attention is focused on the layout of the text instead of its content. The lorem ipsum is a placeholder text used in publishing and graphic design. This filler text is a short paragraph that contains all the letters of the alphabet. The characters are spread out evenly so that the reader\'s attention is focused on the layout of the text instead of its content. The lorem ipsum is a placeholder text used in publishing and graphic design. This filler text is a short paragraph that contains all the letters of the alphabet. The characters are spread out evenly so that the reader\'s attention is focused on the layout of the text instead of its content. The lorem ipsum is a placeholder text used in publishing and graphic design. This filler text is a short paragraph that contains all the letters of the alphabet. The characters are spread out evenly so that the reader\'s attention is focused on the layout of the text instead of its content.', '2023-02-21 09:12:56', '2023-02-23 10:12:12');
INSERT INTO test.articles (author_id, title, image_url, text, created_at, updated_at) VALUES (1, 'test', 'https://via.placeholder.com/150', 'test article', '2023-02-23 13:21:52', '2023-02-23 13:21:52');
