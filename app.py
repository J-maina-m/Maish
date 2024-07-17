import tkinter as tk
from tkinter import messagebox, ttk
import sqlite3

# Connect to SQLite database (create or connect to an existing database)
conn = sqlite3.connect('shop.db')
c = conn.cursor()

# Create products table if not exists
c.execute('''CREATE TABLE IF NOT EXISTS products
             (id INTEGER PRIMARY KEY AUTOINCREMENT,
              name TEXT NOT NULL,
              price REAL NOT NULL,
              quantity INTEGER NOT NULL)''')
conn.commit()

class ShopkeeperApp:
    def __init__(self, root):
        self.root = root
        self.root.title("Shopkeeper App")

        # Create GUI elements
        tk.Label(root, text="Name:").grid(row=0, column=0, padx=10, pady=5)
        self.name_entry = tk.Entry(root)
        self.name_entry.grid(row=0, column=1, padx=10, pady=5)

        tk.Label(root, text="Price:").grid(row=1, column=0, padx=10, pady=5)
        self.price_entry = tk.Entry(root)
        self.price_entry.grid(row=1, column=1, padx=10, pady=5)

        tk.Label(root, text="Quantity:").grid(row=2, column=0, padx=10, pady=5)
        self.quantity_entry = tk.Entry(root)
        self.quantity_entry.grid(row=2, column=1, padx=10, pady=5)

        self.add_button = tk.Button(root, text="Add Product", command=self.add_product)
        self.add_button.grid(row=3, column=0, columnspan=2, padx=10, pady=10, sticky="WE")

        self.products_frame = tk.LabelFrame(root, text="Products")
        self.products_frame.grid(row=4, column=0, columnspan=2, padx=10, pady=10, sticky="WE")

        self.products_list = ttk.Treeview(self.products_frame, columns=("Name", "Price", "Quantity"), show="headings", height=10)
        self.products_list.grid(row=0, column=0, padx=5, pady=5, sticky="NSWE")

        self.products_list.heading("Name", text="Name")
        self.products_list.heading("Price", text="Price")
        self.products_list.heading("Quantity", text="Quantity")

        self.view_products()

    def add_product(self):
        name = self.name_entry.get()
        price = self.price_entry.get()
        quantity = self.quantity_entry.get()

        if name and price and quantity:
            try:
                price = float(price)
                quantity = int(quantity)
                c.execute("INSERT INTO products (name, price, quantity) VALUES (?, ?, ?)", (name, price, quantity))
                conn.commit()
                messagebox.showinfo("Success", "Product added successfully!")
                self.view_products()
                self.clear_entries()
            except ValueError:
                messagebox.showerror("Error", "Invalid price or quantity. Please enter numeric values.")
        else:
            messagebox.showerror("Error", "Please fill in all fields.")

    def view_products(self):
        self.products_list.delete(*self.products_list.get_children())
        c.execute("SELECT * FROM products")
        products = c.fetchall()

        for product in products:
            self.products_list.insert("", tk.END, values=product)

    def clear_entries(self):
        self.name_entry.delete(0, tk.END)
        self.price_entry.delete(0, tk.END)
        self.quantity_entry.delete(0, tk.END)

    def on_closing(self):
        conn.close()
        self.root.destroy()

# Initialize Tkinter root window
if __name__ == "__main__":
    root = tk.Tk()
    app = ShopkeeperApp(root)
    root.protocol("WM_DELETE_WINDOW", app.on_closing)
    root.mainloop()
