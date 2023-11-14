DROP DATABASE IF EXISTS `recept_beheer`;
CREATE DATABASE `recept_beheer`;
USE `recept_beheer`;
CREATE TABLE user (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL
);
CREATE TABLE category (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL
);
CREATE TABLE recipe (
  id INT AUTO_INCREMENT PRIMARY KEY,
  userID INT NOT NULL,
  title VARCHAR(100) NOT NULL,
  ingredients TEXT NOT NULL,
  instructions TEXT NOT NULL,
  category_id INT,
  cooking_time INT,
  FOREIGN KEY (userID) REFERENCES user(id),
  FOREIGN KEY (category_id) REFERENCES category(id)
);
INSERT INTO category (name)
VALUES ('Breakfast'),
  ('Lunch'),
  ('Dinner'),
  ('Dessert');
