import { showToast } from "./products";

function addToCart(productId) {
  if (!productId) return;

  const btn = document.querySelector(`button[onclick="addToCart(${productId})"]`);

  if (btn) {
    btn.disabled = true;
    btn.innerHTML = `<i class="fa-solid fa-spinner fa-spin text-sm"></i> Adding...`;
  }

  fetch("/cart/store", {
    method: "POST",
    headers: {
      "Content-type": "application/json",
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
      "Accept": "application/json"
    },
    body: JSON.stringify({ product_id: productId }),
    })
    .then((res) => {

      if (res.status === 401) {
        showToast("You have to login first!", "error");

        setTimeout(() => {
          window.location.href = "/login";
        }, 1000);
        return;
      }
      if (!res.ok) {
        if (btn) {
            btn.disabled = false;
            btn.innerHTML = `<i class="fa-solid fa-cart-shopping text-sm"></i> Add to Cart`;
        }
        throw new Error('Netwerk response was niet ok');
      }
      return res.json();
    })
    .then((data) => {
      if (data) {
        showToast(data.message, data.status);
        if (btn) {
          btn.classList.replace('bg-blue-600', 'bg-red-600');
          btn.innerHTML = `<i class="fa-solid fa-check text-sm"></i> In Cart`;
        }
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      if (btn) {
        btn.disabled = false;
        btn.innerHTML = `<i class="fa-solid fa-cart-shopping text-sm"></i> Add to Cart`;
      }    
    });
}
window.addToCart = addToCart;


function updateQty(cartItemId, change) {
  const qtyElement = document.getElementById(`qty-${cartItemId}`);

  if (!qtyElement) {
    console.error(`Element qty-${cartItemId} not founded`);
  }

  const currentQty = parseInt(qtyElement.innerText);
  const newQty = currentQty + change;
  if (newQty < 1) {
    showToast(`The Quantity of this product is "${currentQty}" In order to removeit click on the Remove button `, "error");
    return;
  }

  fetch(`/cart/update/${cartItemId}`, {
    method: 'PATCH',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'X-CSRF-TOKEN':   document.querySelector('meta[name="csrf-token"]').content,
    },
    body: JSON.stringify({ 
      quantity: newQty
    }),
  })
  .then(response => {
    if (!response.ok && response.status !== 401) {
      throw new Error(`HTTP erroe! status: ${response.status}`);
    }
    return response.json();
  }) 
    .then(data => {
      if (data.status === 'success') {
        if (qtyElement) {
          qtyElement.innerHTML = newQty;
        }
        
        if (data.newTotal) {
          document.querySelectorAll('.total-price').forEach(element => {
            element.innerText = '€' + data.newTotal;
          });
        }
        else {
          console.warn("'newTotal' is missing in response");
        }
      } else {
        console.error("Server returned an error status:", data.status, "Message:", data.message);
        showToast(data.message || "An error occurred", "error");
      }
  })
  .catch(error => {
    console.error("Fetch error:", error);
    showToast("Connection error. Please try again.", "error");
  });
}
window.updateQty = updateQty;
