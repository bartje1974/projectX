CREATE TABLE IF NOT EXISTS users (  id int(10) NOT NULL AUTO_INCREMENT,
                                    username varchar(30) COLLATE utf8_bin NOT NULL,
                                    password varchar(255) COLLATE utf8_bin NOT NULL,
                                    email varchar(50) COLLATE utf8_bin NOT NULL,
                                    created_at datetime NOT NULL,
                                    last_login datetime NOT NULL,
                                    login_hash varchar(255) COLLATE utf8_bin NOT NULL,
                                    group_id INT(10) DEFAULT '1',
                                    permission_id INT(10),
                                    PRIMARY KEY (id),
                                    UNIQUE KEY email (email)
                                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS usergroups ( group_id int(10) NOT NULL AUTO_INCREMENT,
                                        group_name VARCHAR(100) NOT NULL,
                                        PRIMARY KEY (group_id)
                                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS permissions ( pid INT(10) NOT NULL AUTO_INCREMENT,
                                         permission_name VARCHAR(100) NOT NULL,
                                         PRIMARY KEY (pid)
                                       ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;

ALTER TABLE
    users
ADD
    FOREIGN KEY(group_id)
        REFERENCES usergroups (group_id)
ON DELETE RESTRICT
ON UPDATE CASCADE

ALTER TABLE
    users
ADD
    FOREIGN KEY(permission_id)
        REFERENCES user_permission (user_pid)
ON DELETE RESTRICT
ON UPDATE CASCADE