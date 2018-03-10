alter table users add column userType tinyint default 0 after updated_at;

CREATE TABLE `blogpr`.`posts` ( 
		`id` BIGINT(20) NOT NULL AUTO_INCREMENT , 
		`description` VARCHAR(500) NOT NULL , 
		`userId` BIGINT(20) NOT NULL , 
		PRIMARY KEY (`id`)
	) ENGINE = InnoDB;

alter table posts add column created_at timestamp after description;
alter table posts add column updated_at timestamp after userId;
alter table posts add column deleted_at timestamp after updated_at;
	

CREATE TABLE `blogpr`.`post_likes` ( 
		`id` BIGINT(20) NOT NULL AUTO_INCREMENT , 
		`postId` BIGINT(20) NOT NULL , 
		`userId` BIGINT(20) NOT NULL , 
		`action` boolean default NULL , 
		PRIMARY KEY (`id`)
	) ENGINE = InnoDB;
	
	
CREATE TABLE `blogpr`.`comments` ( 
		`id` BIGINT(20) NOT NULL AUTO_INCREMENT , 
		`description` VARCHAR(500) NOT NULL , 
		`postId` BIGINT(20) NOT NULL , 
		`userId` BIGINT(20) NOT NULL , 
		`parentCommentId` BIGINT(20) default NULL , 
		PRIMARY KEY (`id`)
	) ENGINE = InnoDB;
	
CREATE TABLE `blogpr`.`comment_likes` ( 
		`id` BIGINT(20) NOT NULL AUTO_INCREMENT , 
		`postId` BIGINT(20) NOT NULL , 
		`userId` BIGINT(20) NOT NULL , 
		`action` boolean default NULL , 
		PRIMARY KEY (`id`)
	) ENGINE = InnoDB;