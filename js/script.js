
var shoppingBag = (function() {

  cart = [];
  
  // Constructor
  function Item(n, p, c) {
    this.name = n;
    this.price = p;
    this.count = c;
  }
  
  // Save to bag
  function saveCart() {
    sessionStorage.setItem('shoppingBag', JSON.stringify(cart));
  }
  
    // Load the bag
  function loadBag() {
    cart = JSON.parse(sessionStorage.getItem('shoppingBag'));
  }
  if (sessionStorage.getItem("shoppingBag") != null) {
    loadBag();
  }
  
  var obj = {};
  
  // Add item to bag
  obj.addToBag = function(n, p, c) {
    for(var item in cart) {
      if(cart[item].name === n) {
        cart[item].count ++;
        saveCart();
        return;
      }
    }
    var item = new Item(n, p, c);
    cart.push(item);
    saveCart();
  }
  // Count from item in bag
  obj.setCountForItem = function(n, c) {
    for(var i in cart) {
      if (cart[i].name === n) {
        cart[i].count = c;
        break;
      }
    }
  };
  // Take out item from bag
  obj.deleteItemFromBag = function(n) {
      for(var item in cart) {
        if(cart[item].name === n) {
          cart[item].count --;
          if(cart[item].count === 0) {
            cart.splice(item, 1);
          }
          break;
        }
    }
    saveCart();
  }

  // Take out all items from bag
  obj.deleteItemFromBagAll = function(n) {
    for(var item in cart) {
      if(cart[item].name === n) {
        cart.splice(item, 1);
        break;
      }
    }
    saveCart();
  }

  // Clean bag
  obj.clearCart = function() {
    cart = [];
    saveCart();
  }

  // Count bag 
  obj.totalCount = function() {
    var totalCount = 0;
    for(var item in cart) {
      totalCount += cart[item].count;
    }
    return totalCount;
  }

  // Entire total value in bag
  obj.totalCart = function() {
    var totalCart = 0;
    for(var item in cart) {
      totalCart += cart[item].price * cart[item].count;
    }
    return Number(totalCart.toFixed(2));
  }

  // List bag
  obj.listBag = function() {
    var cartCopy = [];
    for(i in cart) {
      item = cart[i];
      itemCopy = {};
      for(p in item) {
        itemCopy[p] = item[p];

      }
      itemCopy.total = Number(item.price * item.count).toFixed(2);
      cartCopy.push(itemCopy)
    }
    return cartCopy;
  }

  return obj;
})();


//Events

$('.add-to-cart').click(function(event) {
  event.preventDefault();
  var name = $(this).data('name');
  var price = Number($(this).data('price'));
  shoppingBag.addToBag(name, price, 1);
  displayCart();
});


$('.clear-cart').click(function() {
  shoppingBag.clearCart();
  displayCart();
});


function displayCart() {
  var cartArray = shoppingBag.listBag();
  var output = "";
  for(var i in cartArray) {
    output += "<tr>"
      + "<td>" + cartArray[i].name + "</td>" 
      + "<td>(" + cartArray[i].price + ")</td>"
      + "<td><div class='input-group'><button class='minus-item input-group-addon btn btn-primary' data-name=" + cartArray[i].name + ">-</button>"
      + "<input type='number' class='item-count form-control' data-name='" + cartArray[i].name + "' value='" + cartArray[i].count + "'>"
      + "<button class='plus-item btn btn-primary input-group-addon' data-name=" + cartArray[i].name + ">+</button></div></td>"
      + "<td><button class='delete-item btn btn-danger' data-name=" + cartArray[i].name + ">X</button></td>"
      + " = " 
      + "<td>" + cartArray[i].total + "</td>" 
      +  "</tr>";
  }
  $('.show-cart').html(output);
  $('.total-cart').html(shoppingBag.totalCart());
  $('.total-count').html(shoppingBag.totalCount());
}

// Delete item button

$('.show-cart').on("click", ".delete-item", function(event) {
  var name = $(this).data('name')
  shoppingBag.deleteItemFromBagAll(name);
  displayCart();
})



$('.show-cart').on("click", ".minus-item", function(event) {
  var name = $(this).data('name')
  shoppingBag.deleteItemFromBag(name);
  displayCart();
})

$('.show-cart').on("click", ".plus-item", function(event) {
  var name = $(this).data('name')
  shoppingBag.addToBag(name);
  displayCart();
})

$('.show-cart').on("change", ".item-count", function(event) {
   var name = $(this).data('name');
   var count = Number($(this).val());
  shoppingBag.setCountForItem(name, count);
  displayCart();
});

$('.order-now').click(function() {
  cart = JSON.parse(sessionStorage.getItem('shoppingBag'));
var sendData = function() {
  $.post('./storecart.php', {
    data: cart
  }, function(response) {
    //console.log(response);
    alert("Order placed successfully")
    window.location.href = "http://localhost/Officewears/index.php";
    shoppingBag.clearCart();
  });

  

}
sendData();

});

displayCart();



    
