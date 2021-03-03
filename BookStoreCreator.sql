CREATE DATABASE BookStore;

USE BookStore;

CREATE TABLE BookInventory (
bookid INT NOT NULL AUTO_INCREMENT,
booktitle VARCHAR(100),
publicationyear INT,
author VARCHAR(255),
language VARCHAR(50),
quantity INT,
price DECIMAL(9,2),
PRIMARY KEY(bookid)
);

select * from BookInventory;



CREATE TABLE BookInventoryOrder (
orderid INT NOT NULL AUTO_INCREMENT,
firstname VARCHAR(255),
lastname VARCHAR(255),
item_ordered VARCHAR(255),
quantity_ordered INT,
PRIMARY KEY(orderid)
);


select * from BookInventoryOrder;

