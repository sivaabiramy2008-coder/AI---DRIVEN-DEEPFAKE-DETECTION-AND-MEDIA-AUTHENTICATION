import mysql.connector

class Database:

    @staticmethod
    def get_connection():
        return mysql.connector.connect(
        host="127.0.0.1",
        user="root",
        password="",
        database="deepfake_db",
        port=3306
        )

    @staticmethod
    def test_connection():
        try:
            conn = Database.get_connection()
            conn.close()
            return True
        except:
            return False