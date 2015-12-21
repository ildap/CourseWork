create table orders(
  id INT PRIMARY KEY AUTO_INCREMENT UNIQUE,
  printer_id INT,
  client_id INT,
  count INT DEFAULT '1',
  SUMM INT,
  date DATETIME,
  FOREIGN KEY (printer_id) REFERENCES printers(id),
  FOREIGN KEY (client_id) REFERENCES clients(id)
)