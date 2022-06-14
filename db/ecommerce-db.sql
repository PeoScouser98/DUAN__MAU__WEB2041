
-- drop database ecommerce;

CREATE DATABASE ecommerce;
USE ecommerce;  
-- TẠO BẢNG VAI TRÒ 
DROP TABLE IF EXISTS user_role;
CREATE TABLE user_role(
role_id INT(2) NOT NULL PRIMARY KEY AUTO_INCREMENT,
role_name VARCHAR(20) NOT NULL
);




-- TẠO BẢNG NGƯỜI DÙNG
DROP TABLE IF EXISTS users;
CREATE TABLE users(
user_id VARCHAR(20) NOT NULL PRIMARY KEY,
user_password VARCHAR(20) NOT NULL,
user_name VARCHAR(20) NOT NULL,
avatar VARCHAR(255) NOT NULL,
address VARCHAR(100) NOT NULL,
email VARCHAR(255) NOT NULL,
phone VARCHAR(11) NOT NULL,
role_id INT(2) NOT NULL,
FOREIGN KEY (role_id) REFERENCES user_role(role_id)
); 




-- TẠO BẢNG LOẠI HÀNG
DROP TABLE IF EXISTS category;
CREATE TABLE category (
cate_id int(10) PRIMARY KEY AUTO_INCREMENT NOT NULL,
cate_name varchar(50) NOT NULL
);




-- TẠO BẢNG SẢN PHẨM
DROP TABLE IF EXISTS product;
CREATE TABLE product(
product_id INT(10) PRIMARY KEY AUTO_INCREMENT,
cate_id INT(10) NOT NULL,
product_name VARCHAR(100) NOT NULL,
price INT(10) NOT NULL,
product_img VARCHAR(255) NOT NULL,
discount FLOAT(10) NOT NULL,
product_description TEXT(999) NOT NULL,
wish_list_id INT(10) NULL
);
ALTER TABLE  product ADD FOREIGN KEY(cate_id) REFERENCES category(cate_id) ON DELETE NO ACTION;
ALTER TABLE  product ADD FOREIGN KEY(wish_list_id) REFERENCES wish_list(wish_list_id) ON DELETE NO ACTION;





-- TẠO BẢNG ĐƠN HÀNG CHI TIẾT
DROP TABLE IF EXISTS order_detail;
CREATE TABLE order_detail(
order_detail_id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
order_id INT(10) NOT NULL,
product_id INT(10) NOT NULL,
quantity INT(10) NOT NULL,
amount INT(10) NOT NULL
);
ALTER TABLE order_detail ADD FOREIGN KEY (product_id) REFERENCES product(product_id);
ALTER TABLE order_detail ADD FOREIGN KEY (order_id) REFERENCES orders(order_id);



-- TẠO BẢNG ĐƠN HÀNG
DROP TABLE IF EXISTS orders;
CREATE TABLE orders(
order_id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
user_id VARCHAR(20) NOT NULL,
placed_on TIMESTAMP NOT NULL,
FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE NO ACTION
);


-- TẠO BẢNG BÌNH LUẬN
DROP TABLE IF EXISTS comments;
CREATE TABLE comments(
comment_id INT(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
content VARCHAR(255) NOT NULL,
user_id VARCHAR(20) NOT NULL,
product_id INT(10),
comment_date TIMESTAMP NOT NULL,
FOREIGN KEY (user_id) REFERENCES users(user_id),
FOREIGN KEY (product_id) REFERENCES product(product_id)
);



-- TẠO BẢNG WISH LIST
DROP TABLE IF EXISTS wish_list;
CREATE TABLE wish_list(
wish_list_id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
user_id VARCHAR(20) NOT NULL,
FOREIGN KEY(user_id) REFERENCES users(user_id) ON DELETE NO ACTION
);

