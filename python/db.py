import mysql.connector

class SchoolDB:
    def __init__(self, host, user, password, database):
        self.host = host
        self.user = user
        self.password = password
        self.database = database
        self.conn = None
        self.cursor = None

    def connect(self):
        try:
            self.conn = mysql.connector.connect(
                host=self.host,
                user=self.user,
                password=self.password,
                database=self.database
            )
            self.cursor = self.conn.cursor()
            print("Connected to MySQL database")
        except mysql.connector.Error as e:
            print(f"Error connecting to MySQL database: {e}")

    def disconnect(self):
        if self.conn:
            self.conn.close()
            print("Disconnected from MySQL database")

    def add_student(self, name, age, grade):
        try:
            sql = "INSERT INTO students (name, age, grade) VALUES (%s, %s, %s)"
            values = (name, age, grade)
            self.cursor.execute(sql, values)
            self.conn.commit()
            print("Student added successfully")
            return True
        except mysql.connector.Error as e:
            print(f"Error adding student: {e}")
            return False

    def view_students(self):
        try:
            self.cursor.execute("SELECT * FROM students")
            students = self.cursor.fetchall()
            return students
        except mysql.connector.Error as e:
            print(f"Error viewing students: {e}")
            return []

    def add_teacher(self, name, subject):
        try:
            sql = "INSERT INTO teachers (name, subject) VALUES (%s, %s)"
            values = (name, subject)
            self.cursor.execute(sql, values)
            self.conn.commit()
            print("Teacher added successfully")
            return True
        except mysql.connector.Error as e:
            print(f"Error adding teacher: {e}")
            return False

    def view_teachers(self):
        try:
            self.cursor.execute("SELECT * FROM teachers")
            teachers = self.cursor.fetchall()
            return teachers
        except mysql.connector.Error as e:
            print(f"Error viewing teachers: {e}")
            return []

    def add_class(self, class_name):
        try:
            sql = "INSERT INTO classes (class_name) VALUES (%s)"
            values = (class_name,)
            self.cursor.execute(sql, values)
            self.conn.commit()
            print("Class added successfully")
            return True
        except mysql.connector.Error as e:
            print(f"Error adding class: {e}")
            return False

    def view_classes(self):
        try:
            self.cursor.execute("SELECT * FROM classes")
            classes = self.cursor.fetchall()
            return classes
        except mysql.connector.Error as e:
            print(f"Error viewing classes: {e}")
            return []

    def add_subject(self, subject_name):
        try:
            sql = "INSERT INTO subjects (subject_name) VALUES (%s)"
            values = (subject_name,)
            self.cursor.execute(sql, values)
            self.conn.commit()
            print("Subject added successfully")
            return True
        except mysql.connector.Error as e:
            print(f"Error adding subject: {e}")
            return False

    def view_subjects(self):
        try:
            self.cursor.execute("SELECT * FROM subjects")
            subjects = self.cursor.fetchall()
            return subjects
        except mysql.connector.Error as e:
            print(f"Error viewing subjects: {e}")
            return []

    def add_enrollment(self, student_id, class_id):
        try:
            sql = "INSERT INTO enrollments (student_id, class_id) VALUES (%s, %s)"
            values = (student_id, class_id)
            self.cursor.execute(sql, values)
            self.conn.commit()
            print("Enrollment added successfully")
            return True
        except mysql.connector.Error as e:
            print(f"Error adding enrollment: {e}")
            return False

    def view_enrollments(self):
        try:
            self.cursor.execute("SELECT * FROM enrollments")
            enrollments = self.cursor.fetchall()
            return enrollments
        except mysql.connector.Error as e:
            print(f"Error viewing enrollments: {e}")
            return []

    def add_attendance(self, student_id, date, status):
        try:
            sql = "INSERT INTO attendance (student_id, date, status) VALUES (%s, %s, %s)"
            values = (student_id, date, status)
            self.cursor.execute(sql, values)
            self.conn.commit()
            print("Attendance added successfully")
            return True
        except mysql.connector.Error as e:
            print(f"Error adding attendance: {e}")
            return False

    def view_attendance(self):
        try:
            self.cursor.execute("SELECT * FROM attendance")
            attendance = self.cursor.fetchall()
            return attendance
        except mysql.connector.Error as e:
            print(f"Error viewing attendance: {e}")
            return []

    def add_fee(self, student_id, amount, date):
        try:
            sql = "INSERT INTO fees (student_id, amount, date) VALUES (%s, %s, %s)"
            values = (student_id, amount, date)
            self.cursor.execute(sql, values)
            self.conn.commit()
            print("Fee added successfully")
            return True
        except mysql.connector.Error as e:
            print(f"Error adding fee: {e}")
            return False

    def view_fees(self):
        try:
            self.cursor.execute("SELECT * FROM fees")
            fees = self.cursor.fetchall()
            return fees
        except mysql.connector.Error as e:
            print(f"Error viewing fees: {e}")
            return []

# Example usage
if __name__ == "__main__":
    # Replace with your MySQL database credentials
    db = SchoolDB(
        host="localhost",
        user="root",
        password="",
        database="school_managemnt"
    )
    
    db.connect()

   

    db.disconnect()
