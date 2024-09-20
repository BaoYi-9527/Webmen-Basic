CREATE TABLE `v0_company`
(
    `id`           int(11) NOT NULL AUTO_INCREMENT,
    `name`         varchar(255) NOT NULL DEFAULT '' COMMENT '公司名称',
    `en_name`      varchar(255) NOT NULL DEFAULT '' COMMENT '公司英文名称',
    `is_listed`    tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否上市',
    `country_code` CHAR(2)      NOT NULL DEFAULT '' COMMENT '国家代码',
    `url`          varchar(255) NOT NULL DEFAULT '' COMMENT '公司网址',
    `logo_url`     varchar(255) NOT NULL DEFAULT '' COMMENT '公司logo',
    `desc`         varchar(255) NOT NULL DEFAULT '' COMMENT '公司描述',
    `created_at`   DATETIME              DEFAULT CURRENT_TIMESTAMP,
    `updated_at`   DATETIME              DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic COMMENT = 'company';

CREATE TABLE v0_company_tag
(
    `id`         INT AUTO_INCREMENT PRIMARY KEY,
    `company_id` INT NOT NULL,
    `tag_id`     INT NOT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE (company_id, tag_id),
    INDEX (tag_id)
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic COMMENT = 'company_tag';

CREATE TABLE v0_country
(
    `id`         INT AUTO_INCREMENT PRIMARY KEY,
    `code`       CHAR(2)      NOT NULL, -- 使用两位简码
    `name`       VARCHAR(100) NOT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE (code)               -- 确保简码唯一
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic COMMENT = 'country';


CREATE TABLE v0_tag
(
    `id`         INT AUTO_INCREMENT PRIMARY KEY,
    `name`       VARCHAR(100) NOT NULL DEFAULT '',
    `type`       int(10)   NOT NULL DEFAULT 0,
    `color`      VARCHAR(100) NOT NULL DEFAULT '',
    `desc`       VARCHAR(255) NOT NULL DEFAULT '',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic COMMENT = 'tag';

CREATE TABLE `v0_post`
(
    `id`           INT(11)             NOT NULL AUTO_INCREMENT,
    `type`         INT(11)             NOT NULL COMMENT '文章类型 1-company 2-issue',
    `status`       TINYINT(4)          NOT NULL COMMENT '文章状态 1-草稿 2-待审核 3-已发布 4-已隐藏 5-已删除 6-已过期',
    `is_top`       TINYINT(4)          NOT NULL DEFAULT 0 COMMENT '是否置顶',
    `is_original`  TINYINT(4)          NOT NULL DEFAULT 0 COMMENT '是否原创',
    `company_id`   INT(11)             NOT NULL DEFAULT 0 COMMENT '公司ID',
    `title`        VARCHAR(255)        NOT NULL COMMENT '文章标题',
    `desc`         VARCHAR(255)        NOT NULL COMMENT '文章描述',
    `content`      TEXT                NOT NULL COMMENT '文章内容',
    `cover`        VARCHAR(255)        NOT NULL DEFAULT '' COMMENT '文章封面',
    `author_id`    INT(11)             NOT NULL DEFAULT 0 COMMENT '作者ID',
    `slug`         VARCHAR(255)        NOT NULL COMMENT 'seo url',
    `original_url` VARCHAR(255)        NOT NULL DEFAULT '' COMMENT '原文链接',
    `created_at`   DATETIME                     DEFAULT CURRENT_TIMESTAMP,
    `updated_at`   DATETIME                     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci COMMENT ='Posts table';

CREATE TABLE `v0_post_statistics`
(
    `id`         INT(11) NOT NULL AUTO_INCREMENT,
    `post_id`    INT(11) NOT NULL,
    `views`      INT(11)  DEFAULT 0 COMMENT '浏览量',
    `likes`      INT(11)  DEFAULT 0 COMMENT '点赞数',
    `comments`   INT(11)  DEFAULT 0 COMMENT '评论数',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci COMMENT ='Post statistics table';

CREATE TABLE `v0_post_comment`
(
    `id`         INT(11) NOT NULL AUTO_INCREMENT,
    `post_id`    INT(11) NOT NULL,
    `is_top`     TINYINT(4) NOT NULL DEFAULT 0 COMMENT '是否置顶 1-是 0-否',
    `user_id`    INT(11) NOT NULL DEFAULT 0 COMMENT '评论者的用户ID, 0 为未注册用户',
    `comment_id` INT(11) NOT NULL DEFAULT 0 COMMENT '回复的评论ID, 0 为一级评论',
    `status`     TINYINT(4) NOT NULL COMMENT '评论状态 1-正常 2-隐藏 3-删除',
    `content`    TEXT    NOT NULL COMMENT '评论内容',
    `created_at` DATETIME                                 DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME                                 DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci COMMENT ='Post Comments table';

CREATE TABLE `v0_user`
(
    `id`         INT(11)      NOT NULL AUTO_INCREMENT,
    `username`   VARCHAR(50)  NOT NULL UNIQUE COMMENT '用户名',
    `status`     TINYINT(4)   NOT NULL DEFAULT 1 COMMENT '用户状态 1-正常 2-禁用',
    `email`      VARCHAR(100) NOT NULL UNIQUE COMMENT '邮箱',
    `head_img`   VARCHAR(255) NOT NULL DEFAULT '' COMMENT '头像',
    `phone`      VARCHAR(11)  NOT NULL UNIQUE COMMENT '手机号',
    `password`   VARCHAR(255) NOT NULL COMMENT '密码',
    `desc`       VARCHAR(255) NOT NULL DEFAULT '' COMMENT '描述',
    `created_at` DATETIME                                 DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME                                 DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci COMMENT ='Users table';

ALTER TABLE `v0_post` DROP INDEX `slug`;



