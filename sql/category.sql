
-- 序号 数字,主键 不能为空 没有默认值
-- 排序 数字     不能为空 默认值为0
-- 名称 字符串    不能为空 没有默认值
-- 别名  字符串    不能为空 默认值为''
-- 父分类的id 数字  不能为空 默认值是0

CREATE TABLE `category` (
  `id` INT PRIMARY KEY NOT NULL auto_increment,
  `sort` INT NOT NULL DEFAULT 0,
  `name` varchar(10) NOT NULL,
  `nickname` varchar(30) NOT NULL DEFAULT '',
  `parent_id` INT NOT NULL DEFAULT 0
)ENGINE=Innodb DEFAULT CHARSET utf8;



-- 插入数据
insert into category (id, name, nickname, parent_id, sort) values
  (null,'科技','',0,50), -- 1
  (null,'武侠','',0,50), -- 2
  (null,'旅游','',0,50), -- 3
  (null,'美食','',0, 50), -- 4
  (null,'IT','',1,50),   -- 5
  (null,'生物','',1,50), -- 6
  (null,'鸟类','',6,50), -- 7
  (null,'湘菜','',4,50), -- 8
  (null,'粤菜','',4,50), -- 9
  (null,'川菜','',4,50), -- 10
  (null,'跳跳蛙','',8,50), -- 11
  (null,'口味虾','',8,50), -- 12
  (null,'臭豆腐','',8,50), -- 13
  (null,'白切鸡','',9,50), -- 14
  (null,'隆江猪脚','',9,50); -- 15