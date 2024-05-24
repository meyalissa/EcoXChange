

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