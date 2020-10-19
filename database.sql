CREATE DATABASE IF NOT EXISTS carlosgram;
use carlosgram;
CREATE TABLE IF NOT EXISTS users(
    id  int(255) auto_increment not null,
    rol varchar(20),
    name  varchar(100),
    surname varchar(200),
    nick varchar(100),
    email varchar(200),
    pass varchar(255),
    image varchar(255),
    created_at datetime,
    updated_at datetime,
    remember_token varchar(255),

    CONSTRAINT pk_users PRIMARY KEY (id)


) ENGINE=InnoDb;
INSERT INTO users VALUES(null,'user','Carlos','luna','cl72506','cl72506@gmail.com','123456',null,CURTIME(),CURTIME(),null); 
INSERT INTO users VALUES(null,'user','Miguel','Jimenez','miguelJ','miguel@gmail.com','123456',null,CURTIME(),CURTIME(),null); 
INSERT INTO users VALUES(null,'user','Andrea','luna','AndreaL','andrea@gmail.com','123456',null,CURTIME(),CURTIME(),null); 

CREATE TABLE IF NOT EXISTS images(
    id int(255) auto_increment not null,
    user_id int(255) not null,
    image_path varchar(255),
    description text,
    created_at datetime,
    updated_at datetime,

    CONSTRAINT pk_images PRIMARY KEY (id),
    CONSTRAINT fk_images_users FOREIGN KEY (user_id) REFERENCES users(id)
)ENGINE=InnoDb;

INSERT INTO images VALUES(null,1,'test.jpg', 'Descripcion de prueba',CURTIME(),CURTIME());
INSERT INTO images VALUES(null,1,'playa.jpg', 'Descripcion de prueba 2',CURTIME(),CURTIME());
INSERT INTO images VALUES(null,1,'arena.jpg', 'Descripcion de prueba 3',CURTIME(),CURTIME());
INSERT INTO images VALUES(null,3,'familia.jpg', 'Descripcion de prueba 4',CURTIME(),CURTIME());

CREATE TABLE IF NOT EXISTS comments(
    id int(255) auto_increment not null,
    user_id int(255) not null,
    image_id int(255) not null,
    content text,
    created_at datetime,
    updated_at datetime,

    CONSTRAINT pk_comments PRIMARY KEY (id),
    CONSTRAINT fk_comments_users FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT fk_commemts_image FOREIGN KEY (image_id) REFERENCES images(id)

)ENGINE=InnoDb;

    INSERT INTO comments VALUES(null,1,4,'Espectacular Familia', CURTIME(),CURTIME());
    INSERT INTO comments VALUES(null,2,1,'Espectacular TEST', CURTIME(),CURTIME());
    INSERT INTO comments VALUES(null,2,4,'Buena Familia', CURTIME(),CURTIME());

CREATE TABLE IF NOT EXISTS likes(
    id int(255) auto_increment not null,
    user_id int(255) not null,
    image_id int(255) not null,
    created_at datetime,
    updated_at datetime,

    CONSTRAINT pk_likes PRIMARY KEY (id),
    CONSTRAINT fk_likes_users FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT fk_likes_image FOREIGN KEY (image_id) REFERENCES images(id)

)ENGINE=InnoDb;
INSERT INTO likes VALUES(null,1,4, CURTIME(),CURTIME());
    INSERT INTO likes VALUES(null,2,4, CURTIME(),CURTIME());
    INSERT INTO likes VALUES(null,3,1, CURTIME(),CURTIME());
    INSERT INTO likes VALUES(null,3,2, CURTIME(),CURTIME());
    INSERT INTO likes VALUES(null,2,1, CURTIME(),CURTIME());