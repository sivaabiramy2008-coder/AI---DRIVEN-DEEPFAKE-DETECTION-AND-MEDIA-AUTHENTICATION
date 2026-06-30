import mysql.connector


class Database:

    @staticmethod
    def get_connection():
        return mysql.connector.connect(
            host="mysql-22ce5cf0-sivaabiramy2008-3abf.l.aivencloud.com",
            user="avnadmin",
            password="YOUR_AIVEN_PASSWORD"
            database="defaultdb",
            port=16507
        )

    @staticmethod
    def test_connection():
        try:
            conn = Database.get_connection()
            conn.close()
            return True
        except Exception as e:
            print(e)
            return False