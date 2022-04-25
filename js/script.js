
var bag = (function() {

  cart = [];
  
  function Item(name, price, count) {
    this.name = name;
    this.price = price;
    this.count = count;
  }
  
  // Save bag
  function saveBag() {
    sessionStorage.setItem('bag', JSON.stringify(cart));
  }
  
    // Load bag
  function loadBag() {
    cart = JSON.parse(sessionStorage.getItem('bag'));
  }
  if (sessionStorage.getItem("bag") != null) {
    loadBag();
  }
  
  var obj = {};
  
  // Add to bag
  obj.addToBag = function(name, price, count) {
    for(var item in cart) {
      if(cart[item].name === name) {
        cart[item].count ++;
        saveBag();
        return;
      }
    }
    var item = new Item(name, price, count);
    cart.push(item);
    saveBag();
  }
  // Set count from item of bag
  obj.setCountForItem = function(name, count) {
    for(var i in cart) {
      if (cart[i].name === name) {
        cart[i].count = count;
        break;
      }
    }
  };
  // Remove item from bag
  obj.removeItemFromBag = function(name) {
      for(var item in cart) {
        if(cart[item].name === name) {
          cart[item].count --;
          if(cart[item].count === 0) {
            cart.splice(item, 1);
          }
          break;
        }
    }
    saveBag();
  }

  // delete everything from bag
  obj.removeItemFromBagAll = function(name) {
    for(var item in cart) {
      if(cart[item].name === name) {
        cart.splice(item, 1);
        break;
      }
    }
    saveBag();
  }

  // Clean bag
  obj.clearBag = function() {
    cart = [];
    saveBag();
  }

  // Count items in bag
  obj.totalCount = function() {
    var totalCount = 0;
    for(var item in cart) {
      totalCount += cart[item].count;
    }
    return totalCount;
  }

  // Bag in total
  obj.totalBag = function() {
    var totalBag = 0;
    for(var item in cart) {
      totalBag += cart[item].price * cart[item].count;
    }
    return Number(totalBag.toFixed(2));
  }

  // Bag List
  obj.listBag = function() {
    var bagCopy = [];
    for(i in bag) {
      item = bag[i];
      itemCopy = {};
      for(p in item) {
        itemCopy[p] = item[p];

      }
      itemCopy.total = Number(item.price * item.count).toFixed(2);
      bagCopy.push(itemCopy)
    }
    return cartCopy;
  }

  return obj;
})();


// *****************************************
// Triggers / Events
// ***************************************** 
// Add item
$('.add-to-cart').click(function(event) {
  event.preventDefault();
  var name = $(this).data('name');
  var price = Number($(this).data('price'));
  bag.addToBag(name, price, 1);
  displayCart();
});

// Clear items
$('.clear-cart').click(function() {
  bag.clearBag();
  displayCart();
});


function displayCart() {
  var cartArray = bag.listBag();
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
  $('.total-cart').html(bag.totalBag());
  $('.total-count').html(bag.totalCount());
}

// Delete item button

$('.show-cart').on("click", ".delete-item", function(event) {
  var name = $(this).data('name')
  bag.removeItemFromBagAll(name);
  displayCart();
})


// -1
$('.show-cart').on("click", ".minus-item", function(event) {
  var name = $(this).data('name')
  bag.removeItemFromBag(name);
  displayCart();
})
// +1
$('.show-cart').on("click", ".plus-item", function(event) {
  var name = $(this).data('name')
  bag.addToBag(name);
  displayCart();
})

// Item count input
$('.show-cart').on("change", ".item-count", function(event) {
   var name = $(this).data('name');
   var count = Number($(this).val());
  bag.setCountForItem(name, count);
  displayCart();
});

$('.order-now').click(function() {
  cart = JSON.parse(sessionStorage.getItem('bag'));
  //$.post("./cart.php",{cart:cart});
var sendData = function() {
  $.post('./storecart.php', {
    data: cart
  }, function(response) {
    //console.log(response);
    alert("Order placed successfully")
    window.location.href = "http://localhost/Officewears/index.php";
    bag.clearBag();
  });

  

}
sendData();

});

displayCart();



    