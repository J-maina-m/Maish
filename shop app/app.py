class Product:
    def __init__(self, name, price, quantity):
        self.name = name
        self.price = price
        self.quantity = quantity

class ShopkeeperApp:
    def __init__(self):
        self.products = []

    def add_product(self, name, price, quantity):
        product = Product(name, price, quantity)
        self.products.append(product)
        print(f"Product '{name}' added successfully.")

    def update_product_quantity(self, name, new_quantity):
        for product in self.products:
            if product.name == name:
                product.quantity = new_quantity
                print(f"Quantity updated for '{name}' to {new_quantity}.")
                return
        print(f"Product '{name}' not found.")

    def calculate_bill(self, cart):
        total = 0
        for item in cart:
            found = False
            for product in self.products:
                if product.name == item["name"]:
                    total += product.price * item["quantity"]
                    found = True
                    break
            if not found:
                print(f"Product '{item['name']}' not found in inventory.")
                return None
        return total

# Example usage
if __name__ == "__main__":
    shop = ShopkeeperApp()

    # Adding products
    shop.add_product("Apple", 2.5, 50)
    shop.add_product("Banana", 1.0, 100)
    shop.add_product("Orange", 3.0, 30)

    # Updating product quantity
    shop.update_product_quantity("Apple", 40)

    # Calculating bill
    cart = [
        {"name": "Apple", "quantity": 5},
        {"name": "Banana", "quantity": 2},
        {"name": "Orange", "quantity": 3},
    ]
    total_bill = shop.calculate_bill(cart)
    if total_bill is not None:
        print(f"Total bill: ${total_bill}")

