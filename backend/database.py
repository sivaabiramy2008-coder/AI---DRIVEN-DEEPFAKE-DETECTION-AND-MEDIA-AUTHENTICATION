import os
import mysql.connector

class Database:

    @staticmethod
    def get_connection():
        return mysql.connector.connect(
            host=os.getenv("DB_HOST"),
            user=os.getenv("DB_USER"),
            password=os.getenv("DB_PASSWORD"),
            database=os.getenv("DB_NAME"),
            port=int(os.getenv("DB_PORT"))
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