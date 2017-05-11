DROP DATABASE ecommerce;
CREATE DATABASE ecommerce CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ecommerce;

CREATE TABLE IF NOT EXISTS user
(
  id INT AUTO_INCREMENT PRIMARY KEY ,
  email VARCHAR(255) NOT NULL ,
  password VARCHAR(255) NOT NULL ,
  customer_id INT
);

CREATE TABLE  IF NOT EXISTS customer
(
  id INT AUTO_INCREMENT PRIMARY KEY ,
  first_name VARCHAR(255),
  last_name VARCHAR(255),
  address_id INT
);

CREATE TABLE IF NOT EXISTS address
(
  id INT AUTO_INCREMENT PRIMARY KEY,
  street VARCHAR(255),
  region_id int
);

CREATE TABLE IF NOT EXISTS region (
  id INT AUTO_INCREMENT PRIMARY KEY ,
  nation VARCHAR(255),
  country VARCHAR(255),
  city VARCHAR(255),
  zip VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS product
(
  id INT AUTO_INCREMENT PRIMARY KEY ,
  name VARCHAR(255),
  price DECIMAL,
  description TEXT,
  uuid VARCHAR(255) UNIQUE
);

CREATE TABLE IF NOT EXISTS product_image
(
  id INT AUTO_INCREMENT PRIMARY KEY ,
  file_name VARCHAR(255),
  alt_text VARCHAR(255),
  product_id INT
);

CREATE TABLE IF NOT EXISTS cart
(
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_id INT
);

CREATE TABLE IF NOT EXISTS bill
(
  id INT AUTO_INCREMENT PRIMARY KEY ,
  credit_card_number VARCHAR(255),
  cart_id INT,
  payment_status VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS cart_composition
(
  id INT AUTO_INCREMENT PRIMARY KEY,
  product_id INT,
  cart_id INT,
  product_count INT
);

ALTER TABLE user
  ADD CONSTRAINT user_customer FOREIGN KEY (customer_id) REFERENCES customer (id);

ALTER TABLE customer
  ADD CONSTRAINT customer_address FOREIGN KEY (address_id) REFERENCES address (id);

ALTER TABLE address
  ADD CONSTRAINT address_region FOREIGN KEY (region_id) REFERENCES region (id);

ALTER TABLE product_image
  ADD CONSTRAINT product_image_product FOREIGN KEY (product_id) REFERENCES product (id);

ALTER TABLE cart
  ADD CONSTRAINT cart_customer FOREIGN KEY (customer_id) REFERENCES customer (id);

ALTER TABLE cart_composition
  ADD CONSTRAINT cart_composition_product FOREIGN KEY (product_id) REFERENCES product (id),
  ADD CONSTRAINT cart_composition_cart FOREIGN KEY (cart_id) REFERENCES cart (id);

ALTER TABLE bill
  ADD CONSTRAINT bill_cart FOREIGN KEY  (cart_id) REFERENCES cart (id);

INSERT INTO region (id, nation, country, city, zip) VALUES (1, 'Austria', 'Vienna', 'Vienna', '1020');