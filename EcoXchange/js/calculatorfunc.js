const search = () => {
    const searchbox = document.getElementById("search-item").value.toUpperCase();
    const items = document.querySelectorAll(".items");

    items.forEach(item => {
        const title = item.querySelector(".title");
        if (title) {
            let textValue = title.textContent || title.innerHTML;
            if (textValue.toUpperCase().indexOf(searchbox) > -1) {
                item.style.display = "";
            } else {
                item.style.display = "none";
            }
        }
    });
}

function calculateSubtotal(itemId, price) {
    const weightInput = document.getElementById('weight-' + itemId);
    const subtotalInput = document.getElementById('subtotal-' + itemId);
    const weight = parseFloat(weightInput.value);
    const subtotal = weight * price;

    if(!isNaN(subtotal))
        subtotalInput.value = subtotal.toFixed(2);
    else
        subtotalInput.value = '0.00';

       // Recalculate the total whenever a subtotal changes
       calculateTotal();
}

function calculateTotal() {
    const subtotals = document.querySelectorAll('.subtotal');
    let total = 0;

    subtotals.forEach(subtotalInput => {
        const subtotal = parseFloat(subtotalInput.value);
        if (!isNaN(subtotal)) {
            total += subtotal;
        }
    });

    const totalInput = document.getElementById('total');
    totalInput.value = total.toFixed(2);
}