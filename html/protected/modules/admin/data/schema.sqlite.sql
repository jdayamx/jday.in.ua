CREATE TABLE access (
  module VARCHAR(64) NOT NULL,
  controller VARCHAR(64) NOT NULL,
  action VARCHAR(64) NOT NULL,
  name VARCHAR(64) NOT NULL,
  group_id INTEGER NOT NULL,
  aggress INTEGER NOT NULL DEFAULT '0'
);

INSERT INTO access (module,controller,action,name,group_id,aggress) VALUES ('','sitecontroller','error','Errors','-1','1');
INSERT INTO access (module,controller,action,name,group_id,aggress) VALUES ('','sitecontroller','index','Main Page','-1','1');
INSERT INTO access (module,controller,action,name,group_id,aggress) VALUES ('','sitecontroller','Register','Registration Page','-1','1');
INSERT INTO access (module,controller,action,name,group_id,aggress) VALUES ('','sitecontroller','login','Login Page','-1','1');

INSERT INTO access (module,controller,action,name,group_id,aggress) VALUES ('','sitecontroller','error','Errors','0','1');
INSERT INTO access (module,controller,action,name,group_id,aggress) VALUES ('','sitecontroller','index','Main Page','0','1');

INSERT INTO access (module,controller,action,name,group_id,aggress) VALUES ('','sitecontroller','error','Errors','1','1');
INSERT INTO access (module,controller,action,name,group_id,aggress) VALUES ('','sitecontroller','index','Main Page','1','1');

INSERT INTO access (module,controller,action,name,group_id,aggress) VALUES ('','sitecontroller','error','Errors','2','1');
INSERT INTO access (module,controller,action,name,group_id,aggress) VALUES ('','sitecontroller','index','Main Page','2','1');

INSERT INTO access (module,controller,action,name,group_id,aggress) VALUES ('','sitecontroller','Error','Errors','3','1');
INSERT INTO access (module,controller,action,name,group_id,aggress) VALUES ('','sitecontroller','Index','Main Page','3','1');
INSERT INTO access (module,controller,action,name,group_id,aggress) VALUES ('','sitecontroller','Login','Errors','3','1');
INSERT INTO access (module,controller,action,name,group_id,aggress) VALUES ('','sitecontroller','Logout','Main Page','3','1');

INSERT INTO access (module,controller,action,name,group_id,aggress) VALUES ('','sitecontroller','error','Errors','4','1');
INSERT INTO access (module,controller,action,name,group_id,aggress) VALUES ('','sitecontroller','index','Main Page','4','1');







CREATE TABLE logs (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  type INTEGER NOT NULL,
  uid INTEGER NOT NULL,
  user_group INTEGER NOT NULL,
  username VARCHAR(64) NOT NULL,
  ip VARCHAR(15) NOT NULL,
  text TEXT NOT NULL,
  tools TEXT NOT NULL,
  adddate VARCHAR(20) NOT NULL
);