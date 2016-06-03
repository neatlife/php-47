-- 1.1.1.1 7
-- 192.168.1.100 13
-- 255.255.255.255 15
-- 7-15字符

-- char(15) 固定长度，占用的空间永远是15字符，造成空间浪费，优点：查询数度快
-- varchar(15) 占用的空间可变，1.1.1.1 使用7个字符的空间， 优点：占用的空间小，缺点：比char要慢一点

-- 主键 数字 int 不能为空 没有默认值
-- 用户名 字符串 varchar(20) 不能为空 没有默认值
-- 昵称 字符串 varchar(16) 不能为空 默认值为空字符串''，（昵称不使用null的原因是因为null值不能被mysql索引，空字符串可以被mysql索引）
-- 邮箱 字符串 varchar(80) 不能为空 没有默认值(视具体情况而定)
-- 上次登录时间的时间戳 last_login_time? 数字 int unsigned 不能为空 默认值为0
-- 上次登录ip 字符串 varchar(15) 不能为空 默认值为''
-- 密码 字符串 varchar(32) 不能为空 没有默认值

CREATE TABLE `user` (
  `id` INT NOT NULL PRIMARY KEY auto_increment,
  `username` varchar(20) NOT NULL,
  `nickname` varchar(16) NOT NULL DEFAULT '',
  `email` varchar(80) NOT NULL
)ENGINE=innodb DEFAULT CHARSET utf8;

ALTER TABLE `user` ADD COLUMN password VARCHAR(32) NOT NULL;