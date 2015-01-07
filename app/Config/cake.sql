create table posts(
	id int not null auto_increment primary key,
	title varchar(50),
	body text,
	created datetime default null,
	modified datetime default null
);

insert into posts(title,body,created,modified)values
('title 1','body 1',now(),now()),
('title 2','body 2',now(),now()),
('title 3','body 3',now(),now());

desc posts;

select * from posts;