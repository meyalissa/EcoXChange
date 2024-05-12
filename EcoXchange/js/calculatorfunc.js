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