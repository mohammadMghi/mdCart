<?php

namespace Md\Wcart;

 
use Illuminate\Bus\Dispatcher;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Session\SessionManager;
use PSpell\Config;

class Cart{
    public $SESSION_NAME ="cart";
    public Database $db;
    protected SessionManager $sessionManager;
    public function __construct(SessionManager $sessionManager , Database $db){
        $this->sessionManager = $sessionManager;
        $this->db = $db;
    }

    public function add($id , $productName = null, $qty = null , $price =null ){
        //get content
        $currentSession = $this->getCurrentSession();

        $cart[$id] = array(
            "id" => $id,
            "nama_product" => $productName,
            "price" => $price,
            "qty" => $qty,
       
        );
  
        foreach($currentSession as $key=>$item){
        
   
            if(in_array($id,$item)){
                
          
                 $item['qty'] = $item['qty'] +$cart[$id]['qty'];
                //get all cart and add this item to that
                $item['price'] = $item['price'] +$cart[$id]['price'];
                 unset($currentSession[$key]);
                 //$currentSession[$id] = $item;
                 array_push($currentSession , $item);
         
                
      

                $this->sessionManager->put('cart' , $currentSession );
 
                $this->sessionManager->flash('cart'  , $currentSession);
                return;
            }   
        }

        array_push($currentSession , $cart[$id]);
        // if product existed on the basket then increase qty
 

     
 
  

        $this->sessionManager->put($this->SESSION_NAME , $currentSession);
        $this->sessionManager->flash('cart'  , $currentSession);
        return;
    }

    
    public function removeById($id){
        $cart[$id] = array(
            "id" => $id,
        );
        $this->sessionManager->forget($cart['id']);
    }


    public function removeAll(){
        $this->sessionManager->forget('cart');
 
    }

    public function countAll(){
        $currentSession = $this->getCurrentSession();
        $total = 0 ;
        foreach($currentSession as $key=>$item){
            $total = $total  + $item['qty'];
        }
        
        return $total;
    }

    public function updateQty($id , $newQty){
        $currentSession = $this->getCurrentSession();
 

        foreach($currentSession as $key=>$item)
        {
          
            if($item['id'] == $id)
            {
 
                $item['qty'] = $item['qty'] +$newQty;
                unset($currentSession[$key]);
                array_push($currentSession , $item);

                $this->sessionManager->put('cart' , $currentSession );
 
                $this->sessionManager->flash('cart'  , $currentSession);
            }

            return;
        }
        return;
    }

    public function get($id){
 
        $currentSession = $this->getCurrentSession();
        $result = [];
        foreach($currentSession as $key=>$item){
            if($item['id'] == $id){
                $result = $item;
            }
        }

        return $result;
    }

    public function total(){
        $total = 0;
        $currentSession = $this->getCurrentSession();
 
        foreach($currentSession as $item){
 
            $total = $total +  $item['price'];
        }

        return $total;
    }

    public function searchByID($id){
        $currentSession = $this->getCurrentSession();
        $result = array_search($id,$currentSession);
        return $result;
    }

    public function tableName(){
        return Config('cart.db.table' , 'shoppingCart');
    }


    public function storeDbById($cartId){
        if($this->cartExsitedInDb($cartId)){
            return ;
        }
 

        $cartById = $this->get($cartId);



         $this->db->connection()->table($this->tableName())
            ->insert([ 
                "id" => $cartId,
                "nama_product" => $cartById->product_name,
                "price" => $cartById->price,
                "qty" => $cartById->qty,
            
            ])->store();

    }

 
   

    public function cartExsitedInDb($cartId){
        return $this->db->connection()->table($this->tableName())->where('id', $cartId)->exists();    
    }

    

    public function setTax($id , $taxRate){
        $item = $this->get($id);
        $currentSession = $this->getCurrentSession();
        if(is_numeric($taxRate)){
   
            $tax = $item['price'] / $taxRate;
            $item['price'] = $item['price'] + $tax;
            unset($currentSession[$item['id']]);
            array_push($currentSession , $item);

            $this->sessionManager->put('cart' , $currentSession );
 
            $this->sessionManager->flash('cart'  , $currentSession);
            return;
        }else{

            //throw exception
 
        }
        return;
    }

    public function all(){
        return $this->sessionManager->all()['cart'];
    }

    public function getCurrentSession()  
    {
        $currentSession = $this->sessionManager->all();
        
        if(array_key_exists('cart',$currentSession )){
     
            return $this->sessionManager->all()['cart'];
 
        }
        return [];
    }

    public function toJson(){
        $currentSession = $this->getCurrentSession();
        return json_decode($currentSession);
    }
}