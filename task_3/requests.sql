# 1. �������� ������ ������� ������� ���� ������������� � �������� �� 20 ��� � ����������� ���� ����� 5
SELECT u.id , u.first_name, u.last_name, u.age
FROM db_test_data.users u
	LEFT JOIN db_test_data.users_books ub ON ub.user_id = u.id
WHERE u.age >= 20
GROUP BY ub.user_id
HAVING COUNT(ub.book_id) > 5;

# 2. �������� ������ ������� ������� ������������� � ����� ������� ������������ ����� 3
SELECT u.id , u.first_name, u.last_name, u.age
FROM db_test_data.users u
WHERE u.first_name LIKE '%3%';

# 3. �������� ������ ������� ������� ������ ������������� ������� �� ����� ����� � ������ "Book #21"
SELECT u.id , u.first_name, u.last_name, u.age
FROM db_test_data.users u
WHERE u.id NOT IN (
  SELECT ub.user_id
  FROM db_test_data.users_books ub
  	INNER JOIN db_test_data.books b ON b.id = ub.book_id
   AND  b.title = 'Book #21'
);

# 4. �������� ������ ������� ������� ���� is_active � ������� users;
ALTER TABLE db_test_data.users
ADD COLUMN `is_active` TINYINT(1) NOT NULL DEFAULT '0' AFTER `age`;

# 5. �������� ������, ������� ��������� is_active = 1 ��� �������������, ������� ����� ��� ������� ���� �����
UPDATE db_test_data.users u
SET u.is_active = 1
WHERE u.id IN (
  SELECT ub.user_id
  FROM db_test_data.users_books ub
  GROUP BY ub.user_id
  HAVING COUNT(ub.user_id) >= 1
);

/* 6. �������� ������ ������� ������� ���� isbestseller (bool) � ������� books.
   � MYSQL BOOLEAN ���, ��� ������� TINYINT (1) */
ALTER TABLE db_test_data.books
ADD COLUMN `isbestseller` BOOLEAN NOT NULL DEFAULT FALSE AFTER `title`;

# 7. �������� ������ ������� �������� isbestseller = 1 ��� ����, ������� ���� ����� �������������� ����� 10 ���
UPDATE db_test_data.books b
SET b.isbestseller = 1
WHERE b.id IN (
  SELECT ub.book_id
  FROM db_test_data.users_books ub
  GROUP BY ub.book_id
  HAVING COUNT(ub.book_id) > 10
);