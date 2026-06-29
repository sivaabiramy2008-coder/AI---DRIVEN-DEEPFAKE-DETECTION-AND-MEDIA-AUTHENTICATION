from flask import Flask, jsonify,request
from flask_cors import CORS
from datetime import datetime
from database import Database
import os
from werkzeug.utils import secure_filename

db = Database()
app = Flask(__name__)
CORS(app)
UPLOAD_FOLDER = "uploads"

if not os.path.exists(UPLOAD_FOLDER):
    os.makedirs(UPLOAD_FOLDER)

app.config["UPLOAD_FOLDER"] = UPLOAD_FOLDER


# Project Information
PROJECT_NAME = "AI-Driven Deepfake Detection & Media Authentication"
VERSION = "1.0"

@app.route("/")
def home():
    return jsonify({
        "project": PROJECT_NAME,
        "version": VERSION,
        "status": "Running",
        "message": "Backend Server Active",
        "timestamp": datetime.now().strftime("%Y-%m-%d %H:%M:%S")
    })

@app.route("/health")
def health():
    return jsonify({
        "server": "Online",
        "database": "Connected",
        "api_status": "Healthy"
    })
@app.route("/db-test")
def db_test():
    try:
        conn = Database.get_connection()
        conn.close()

        return jsonify({
            "database": "Connected Successfully"
        })

    except Exception as e:
        return jsonify({
            "database": "Connection Failed",
            "error": str(e)
        })   


@app.route("/register", methods=["POST"])
def register():
    try:
        data = request.get_json()

        full_name = data["full_name"]
        email = data["email"]
        password = data["password"]

        conn = Database.get_connection()
        cursor = conn.cursor()

        sql = """
        INSERT INTO users(full_name, email, password)
        VALUES (%s, %s, %s)
        """

        cursor.execute(sql, (full_name, email, password))
        conn.commit()

        cursor.close()
        conn.close()

        return jsonify({
            "status": "success",
            "message": "User Registered Successfully"
        })

    except Exception as e:
        return jsonify({
            "status": "error",
            "message": str(e)
        })  

@app.route("/login", methods=["POST"])
def login():
    try:
        data = request.get_json()

        email = data["email"]
        password = data["password"]

        conn = Database.get_connection()
        cursor = conn.cursor(dictionary=True)

        sql = "SELECT * FROM users WHERE email=%s AND password=%s"
        cursor.execute(sql, (email, password))

        user = cursor.fetchone()

        cursor.close()
        conn.close()

        if user:
            return jsonify({
                "status": "success",
                "message": "Login Successful",
                "user": user
            })

        return jsonify({
            "status": "error",
            "message": "Invalid Email or Password"
        })

    except Exception as e:
        return jsonify({
            "status": "error",
            "message": str(e)
        })


@app.route("/upload", methods=["POST"])
def upload_file():
    try:

        if "file" not in request.files:
            return jsonify({
                "status": "error",
                "message": "No file selected"
            })

        file = request.files["file"]

        if file.filename == "":
            return jsonify({
                "status": "error",
                "message": "Empty file"
            })

        filename = secure_filename(file.filename)

        filepath = os.path.join(
            app.config["UPLOAD_FOLDER"],
            filename
        )

        file.save(filepath)

        conn = Database.get_connection()
        cursor = conn.cursor()

        sql = """
        INSERT INTO upload_history
        (file_name, file_type)
        VALUES (%s, %s)
        """

        cursor.execute(sql, (filename, file.content_type))
        conn.commit()

        cursor.close()
        conn.close()

        return jsonify({
            "status": "success",
            "message": "File Uploaded Successfully",
            "file_name": filename
        })

    except Exception as e:
        return jsonify({
            "status": "error",
            "message": str(e)
        })

@app.route("/analyze", methods=["POST"])
def analyze_file():
    try:

        data = request.get_json()

        file_name = data["file_name"]

        # Temporary AI Result
        result = "Fake"
        confidence = 96.5

        conn = Database.get_connection()
        cursor = conn.cursor()

        sql = """
        INSERT INTO analysis_results
        (file_name, result, confidence)
        VALUES (%s, %s, %s)
        """

        cursor.execute(
            sql,
            (file_name, result, confidence)
        )

        conn.commit()

        cursor.close()
        conn.close()

        return jsonify({
            "status": "success",
            "file_name": file_name,
            "result": result,
            "confidence": confidence
        })

    except Exception as e:
        return jsonify({
            "status": "error",
            "message": str(e)
        })

        return jsonify({
            "status": "success",
            "message": "File Uploaded Successfully",
            "file_name": filename
        })

    except Exception as e:
        return jsonify({
            "status": "error",
            "message": str(e)
        })



@app.route("/analysis-history")
def analysis_history():

    conn = Database.get_connection()
    cursor = conn.cursor(dictionary=True)

    cursor.execute("""
        SELECT * FROM analysis_results
        ORDER BY analyzed_at DESC
    """)

    data = cursor.fetchall()

    cursor.close()
    conn.close()

    return jsonify(data)



@app.route("/reports", methods=["GET"])
def get_reports():

    conn = Database.get_connection()
    cursor = conn.cursor(dictionary=True)

    cursor.execute("""
        SELECT *
        FROM reports
        ORDER BY report_date DESC
    """)

    reports = cursor.fetchall()

    cursor.close()
    conn.close()

    return jsonify(reports)


@app.route("/users", methods=["GET"])
def get_users():

    conn = Database.get_connection()
    cursor = conn.cursor(dictionary=True)

    cursor.execute("""
        SELECT
        id,
        name,
        email,
        role,
        created_at
        FROM users
    """)

    users = cursor.fetchall()

    cursor.close()
    conn.close()

    return jsonify(users)


@app.route("/analytics", methods=["GET"])
def analytics():

    conn = Database.get_connection()
    cursor = conn.cursor(dictionary=True)

    cursor.execute("""
        SELECT
        COUNT(*) AS total_analysis,
        SUM(CASE WHEN result='Fake' THEN 1 ELSE 0 END) AS fake_detected,
        SUM(CASE WHEN result='Real' THEN 1 ELSE 0 END) AS real_detected
        FROM analysis_results
    """)

    data = cursor.fetchone()

    cursor.close()
    conn.close()

    return jsonify(data)


@app.route("/save-analysis", methods=["POST"])
def save_analysis():

    try:

        data = request.get_json()

        file_name = data["file_name"]
        result = data["result"]
        confidence = data["confidence"]

        conn = Database.get_connection()
        cursor = conn.cursor()

        sql = """
        INSERT INTO analysis_results
        (file_name,result,confidence)
        VALUES (%s,%s,%s)
        """

        cursor.execute(
            sql,
            (file_name,result,confidence)
        )

        conn.commit()

        cursor.close()
        conn.close()

        return jsonify({
            "status":"success",
            "message":"Analysis Saved Successfully"
        })

    except Exception as e:

        return jsonify({
            "status":"error",
            "message":str(e)
        })


@app.route("/dashboard-stats")
def dashboard_stats():

    conn = Database.get_connection()
    cursor = conn.cursor(dictionary=True)

    cursor.execute("SELECT COUNT(*) AS total_users FROM users")
    total_users = cursor.fetchone()["total_users"]

    cursor.execute("SELECT COUNT(*) AS total_uploads FROM upload_history")
    total_uploads = cursor.fetchone()["total_uploads"]

    cursor.execute("SELECT COUNT(*) AS total_analysis FROM analysis_results")
    total_analysis = cursor.fetchone()["total_analysis"]

    cursor.execute("""
        SELECT COUNT(*) AS fake_count
        FROM analysis_results
        WHERE result='Fake'
    """)
    fake_count = cursor.fetchone()["fake_count"]

    cursor.close()
    conn.close()

    return jsonify({
        "total_users": total_users,
        "total_uploads": total_uploads,
        "total_analysis": total_analysis,
        "fake_detected": fake_count
    })
@app.route("/latest-result", methods=["GET"])
def latest_result():

    conn = Database.get_connection()
    cursor = conn.cursor(dictionary=True)

    cursor.execute("""
        SELECT *
        FROM analysis_results
        ORDER BY id DESC
        LIMIT 1
    """)

    result = cursor.fetchone()

    cursor.close()
    conn.close()

    return jsonify(result)  

@app.route("/profile", methods=["GET"])
def profile():

    conn = Database.get_connection()
    cursor = conn.cursor(dictionary=True)

    cursor.execute("""
        SELECT full_name,email
        FROM users
        ORDER BY id DESC
        LIMIT 1
    """)

    user = cursor.fetchone()

    cursor.close()
    conn.close()

    return jsonify(user)

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000, debug=True)