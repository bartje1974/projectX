CREATE TABLE IF NOT EXISTS users (  id int(10) NOT NULL AUTO_INCREMENT,
                                    username varchar(30) COLLATE utf8_bin NOT NULL,
                                    password varchar(255) COLLATE utf8_bin NOT NULL,
                                    email varchar(50) COLLATE utf8_bin NOT NULL,
                                    created_at datetime NOT NULL,
                                    last_login datetime NOT NULL,
                                    login_hash varchar(255) COLLATE utf8_bin NOT NULL,
                                    PRIMARY KEY (id),
                                    UNIQUE KEY email (email)
                                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;