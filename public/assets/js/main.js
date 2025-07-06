// Shopping cart functionality
function addToCart(productId, size, quantity) {
  if (!size) {
    alert("Vui lòng chọn size");
    return;
  }

  fetch("add_to_cart.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `product_id=${productId}&size=${size}&quantity=${quantity}`,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        alert("Đã thêm vào giỏ hàng!");
        updateCartCount();
      } else {
        alert("Có lỗi xảy ra!");
      }
    });
}

function updateCartCount() {
  fetch("get_cart_count.php")
    .then((response) => response.json())
    .then((data) => {
      document.querySelector(".cart-count").textContent = data.count;
    });
}

// Size selector
document.addEventListener("DOMContentLoaded", function () {
  const sizeOptions = document.querySelectorAll(".size-option");
  let selectedSize = null;

  sizeOptions.forEach((option) => {
    option.addEventListener("click", function () {
      sizeOptions.forEach((opt) => opt.classList.remove("selected"));
      this.classList.add("selected");
      selectedSize = this.dataset.size;
    });
  });

  // Add to cart button
  // const addToCartBtn = document.getElementById("add-to-cart-btn");
  // if (addToCartBtn) {
  //   addToCartBtn.addEventListener("click", function () {
  //     const productId = this.dataset.productId;
  //     const quantity = document.getElementById("quantity").value;
  //     addToCart(productId, selectedSize, quantity);
  //   });
  // }
  const addToCartBtn = document.getElementById("add-to-cart-btn");
  if (addToCartBtn) {
    addToCartBtn.addEventListener("click", function () {
      const productId = this.dataset.productId;
      const quantity = document.getElementById("quantity").value;
      // Kiểm tra xem kích thước đã được chọn chưa
      if (!selectedSize) {
        alert("Vui lòng chọn size");
        return; // Dừng lại nếu không có kích thước được chọn
      }
      // Thêm sản phẩm vào giỏ hàng
      addToCart(productId, selectedSize, quantity);
    });
  }

  // Quantity controls
  const quantityInput = document.getElementById("quantity");
  const minusBtn = document.getElementById("quantity-minus");
  const plusBtn = document.getElementById("quantity-plus");

  if (minusBtn && plusBtn) {
    minusBtn.addEventListener("click", function () {
      let value = parseInt(quantityInput.value);
      if (value > 1) {
        quantityInput.value = value - 1;
      }
    });

    plusBtn.addEventListener("click", function () {
      let value = parseInt(quantityInput.value);
      quantityInput.value = value + 1;
    });
  }
});

// Mobile menu toggle
function toggleMobileMenu() {
  const nav = document.querySelector(".main-nav");
  nav.classList.toggle("mobile-open");
}

// Search functionality
function performSearch() {
  const searchInput = document.querySelector(".search-box input");
  const query = searchInput.value.trim();
  if (query) {
    window.location.href = `search.php?q=${encodeURIComponent(query)}`;
  }
}

// Admin functions
function deleteItem(type, id) {
  if (confirm("Bạn có chắc chắn muốn xóa?")) {
    window.location.href = `delete.php?type=${type}&id=${id}`;
  }
}

function updateOrderStatus(orderId, status) {
  fetch("update_order_status.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `order_id=${orderId}&status=${status}`,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        location.reload();
      } else {
        alert("Có lỗi xảy ra!");
      }
    });
}
