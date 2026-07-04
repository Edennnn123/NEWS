ALTER TABLE news ADD COLUMN summary text AFTER content;
ALTER TABLE news ADD COLUMN thumbnail varchar(200) AFTER attachment;
ALTER TABLE news ADD COLUMN is_top tinyint(1) DEFAULT 0 AFTER thumbnail;
