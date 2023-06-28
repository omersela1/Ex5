function showData(data) {
    var categoryList = document.getElementById("categoryList")
    if (categoryList.childElementCount === 0) {
        var h2 = document.createElement("h2");
        h2.innerHTML = "Categories";
        categoryList.appendChild(h2);
         const ulFrag = document.createDocumentFragment();
        for (const key in data.categories) {
        var li = document.createElement("li");
        if (`${data.categories[key].name}` == "All Books")
        li.innerHTML = `<a href='index.php'>All Books</a>`;
        else
        li.innerHTML = `<a href='index.php?categoryId=${data.categories[key].name}'>${data.categories[key].name}</a>`;
        ulFrag.appendChild(li);
    }
    categoryList.appendChild(ulFrag);
}
}
fetch("categories.json")
.then(response => response.json())
.then(data => showData(data));