create table printers(
  id INT PRIMARY KEY AUTO_INCREMENT UNIQUE,
  #модель
  model VARCHAR(50) CHARACTER SET UTF8 DEFAULT NULL,
  #тип
  type VARCHAR(50) CHARACTER SET UTF8 DEFAULT NULL,
  #цена
  price FLOAT DEFAULT NULL,
  #описание
  description VARCHAR(255) CHARACTER SET UTF8 DEFAULT NULL,
  #разрешение печати
  resolution INT DEFAULT NULL,
  #формат бумаги
  scale VARCHAR(4) CHARACTER SET UTF8 DEFAULT NULL,
  #скорость печати
  speed INT DEFAULT NULL
  )