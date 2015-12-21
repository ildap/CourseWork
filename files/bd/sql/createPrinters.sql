create table printers(
  id INT PRIMARY KEY AUTO_INCREMENT UNIQUE,
  #������
  model VARCHAR(50) CHARACTER SET UTF8 DEFAULT NULL,
  #���
  type VARCHAR(50) CHARACTER SET UTF8 DEFAULT NULL,
  #����
  price FLOAT DEFAULT NULL,
  #��������
  description VARCHAR(255) CHARACTER SET UTF8 DEFAULT NULL,
  #���������� ������
  resolution INT DEFAULT NULL,
  #������ ������
  scale VARCHAR(4) CHARACTER SET UTF8 DEFAULT NULL,
  #�������� ������
  speed INT DEFAULT NULL
  )