CREATE TABLE post (
	id INT UNSIGNED AUTO_INCREMENT,
    user_id INT UNSIGNED NOT NULL,
    created_timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    post_text TEXT,
    likes INT UNSIGNED DEFAULT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE user (
    id INT UNSIGNED AUTO_INCREMENT,
    email TEXT,
    password TEXT,
    name VARCHAR(255),
    profile_picture VARCHAR(255),
    about_me TEXT,
    PRIMARY KEY (id)
);

CREATE TABLE image (
    post_id INT UNSIGNED NOT NULL,
    image_path VARCHAR(255),
    PRIMARY KEY (post_id, image_path)
);