# MdCart (Shpping Cart)

This is a simple ShppingCart package for Laravel


# How to add this package to your project

1. Open your project

2. Create a folder named 'packages' in root of your project

3. Open 'composer.json' (root of your project) and add following line to 'autoload{ prs-4{} }' :
    ```
      "Md\\Wcart\\" : "packages/md/wcart/src"
    ```
4. Open 'config/app.php' in root of your project and add following line to 'providers' :

    ```
      Md\Wcart\CartServiceProvider::class,
    ```
5. Open 'config/app.php' in root of your project and add following line to 'aliases' :

  ```
     'Cart' => Md\Wcart\Facade\Cart::class,
  ```
6. Make sure you have connected to the database and then run these commands:

  ```
     php artisan vendor:publish --provider="Md\Wcart\CartServiceProvider"
     php artisan migrate
  ```

# How to use ?

In your class that you want to use this package you have to import following :

  ```
  use Md\Wcart\Facades\Cart;
  ```
  
1. Add new item to the cart :

  ```
  Cart::add('product id' , 'product name' , qty , price);
  ```  
  
2. Update Qty :

  ```
  Cart::updateQty('product id' , qty);
  ```
  
3. Store cart to the database by product ID :

  ```
  Cart::storeDbById('product id');
  ```
4. Set tax :

  ```
  Cart::setTax('product id' , percent);
  
  ```
5. Remove By Id and remove All:

  ```
  Cart::removeById('product id');
  Cart::removeAll();
  ```
  
6. All items:

  ```
  Cart::all();
  ```
7. Delete item form database by id :

  ```
  Cart::deleteFromDbById('product id');
  ```
  
  

  
