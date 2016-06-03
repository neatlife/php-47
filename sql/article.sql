-- 文章数据表的设计

-- id 主键
-- category 分类的名字 字符串 (及其不推荐这种写法)
--  提升,更灵活的写法
-- category_id 分类的id(category.id) 数字 不能为空 默认值为0
-- author 作者的名字 字符串(极其不推荐这种写法)
--  提升，更灵活的写法
-- author_id 作者的id(user.id) 数字 不能为空 没有默认值
-- title 标题 字符串 不能为空 没有默认值
-- published_date 发布日期时间戳 数字 不能为空 没有默认值
-- status 状态(公开 草稿 隐藏) enum('公开', '草稿', '隐藏') 不能为空 默认值为‘公开’(不推荐这种写法)
--  提升，更灵活的写法
-- status 状态 数字(1.公开 2.草稿 3.隐藏) 不能为空 默认值是1
-- content 文章的正文内容 超长的字符串
-- top    是否置顶 enum('是', '否') 不能为空 默认值是'否'
--  提升，更灵活的写法
-- top    是否指定 数字（1.置顶，2.未置顶） 不能为空，默认值是2

CREATE TABLE `article` (
  `id` INT PRIMARY KEY auto_increment,
  `category_id` INT NOT NULL DEFAULT 0,
  `author_id` INT NOT NULL,
  `title` varchar(25) NOT NULL,
  `published_date` INT NOT NULL,
  `status` TINYINT NOT NULL DEFAULT 1
) ENGINE=innodb DEFAULT CHARSET utf8;

ALTER TABLE `article`  ADD COLUMN `content` TEXT;-- text类型没有设置默认值的选项，没有not null。
ALTER TABLE `article` ADD COLUMN `top` TINYINT NOT NULL DEFAULT 2;