import tkinter as tk
from tkinter import messagebox, ttk
import mysql.connector

# Connect to MySQL database (replace with your MySQL credentials)
conn = mysql.connector.connect(
    host="localhost",
    user="root",  # Replace with your MySQL username
    password="",  # Replace with your MySQL password
    database="school_management"  # Replace with your database name
)
c = conn.cursor()

# Create main application window
root = tk.Tk()
root.title("School Management System")

# Function to add a student
def add_student():
    name = student_name.get()
    age = student_age.get()
    grade = student_grade.get()
    
    if name and age and grade:
        sql = "INSERT INTO students (name, age, grade) VALUES (%s, %s, %s)"
        values = (name, age, grade)
        c.execute(sql, values)
        conn.commit()
        messagebox.showinfo("Success", "Student added successfully!")
        clear_entries()
        view_students()
    else:
        messagebox.showerror("Error", "Please fill in all fields.")

# Function to view students
def view_students():
    students_list.delete(*students_list.get_children())
    c.execute("SELECT * FROM students")
    students = c.fetchall()
    
    for student in students:
        students_list.insert("", tk.END, values=student)

# Function to clear entry fields
def clear_entries():
    student_name.set("")
    student_age.set("")
    student_grade.set("")

# Create labels and entry fields for adding students
tk.Label(root, text="Student Name:").grid(row=0, column=0, padx=10, pady=5)
student_name = tk.StringVar()
tk.Entry(root, textvariable=student_name).grid(row=0, column=1, padx=10, pady=5)

tk.Label(root, text="Student Age:").grid(row=1, column=0, padx=10, pady=5)
student_age = tk.StringVar()
tk.Entry(root, textvariable=student_age).grid(row=1, column=1, padx=10, pady=5)

tk.Label(root, text="Student Grade:").grid(row=2, column=0, padx=10, pady=5)
student_grade = tk.StringVar()
tk.Entry(root, textvariable=student_grade).grid(row=2, column=1, padx=10, pady=5)

# Add student button
tk.Button(root, text="Add Student", command=add_student).grid(row=3, column=0, columnspan=2, padx=10, pady=10, sticky="WE")

# Frame for displaying students
students_frame = tk.LabelFrame(root, text="Students")
students_frame.grid(row=4, column=0, columnspan=2, padx=10, pady=10, sticky="WE")

# Treeview to display students
students_list = ttk.Treeview(students_frame, columns=("ID", "Name", "Age", "Grade"), show="headings", height=10)
students_list.grid(row=0, column=0, padx=5, pady=5, sticky="NSWE")

# Define columns
students_list.heading("ID", text="ID")
students_list.heading("Name", text="Name")
students_list.heading("Age", text="Age")
students_list.heading("Grade", text="Grade")

# Scrollbar for the listbox
students_scrollbar = ttk.Scrollbar(students_frame, orient="vertical", command=students_list.yview)
students_scrollbar.grid(row=0, column=1, sticky="NS")
students_list.config(yscrollcommand=students_scrollbar.set)

# Initial view of students
view_students()

# Function to close the database connection and exit
def on_closing():
    conn.close()
    root.destroy()

root.protocol("WM_DELETE_WINDOW", on_closing)
root.mainloop()
