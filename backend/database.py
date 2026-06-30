import mysql.connector

class Database:

    @staticmethod
    def get_connection():
        return mysql.connector.connect(
            host="YOUR_AIVEN_HOST",
            user="avnadmin",
            password="YOUR_AIVEN_PASSWORD",
            database="defaultdb",
            port=16507
        )

    @staticmethod
    def test_connection():
        try:
            conn = Database.get_connection()
            conn.close()
            return True
        except:
            return False