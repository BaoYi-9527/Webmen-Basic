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