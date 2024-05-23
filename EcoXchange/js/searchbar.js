const searchcalc = () => {
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

function searchmember() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search-member");
    filter = input.value.toUpperCase();
    table = document.querySelector(".table1");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) {
        tr[i].style.display = "none";
        td = tr[i].getElementsByTagName("td");
        for (var j = 0; j < td.length; j++) {
            if (td[j]) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    break;
                }
            }
        }
    }
}