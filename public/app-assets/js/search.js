let searchWinVisibility = false;

function toggleSearchWindow() {
    $('#search-window').toggleClass('hidden')
    $('body').toggleClass('overflow-hidden')
    if (!searchWinVisibility) {
        searchWinVisibility = true
        $('#search-input').focus();
    } else {
        searchWinVisibility = false
    }
}

function handleSearchInp() {
    $('#search-inp-value').parent().removeClass('hidden')
    $('#search-inp-value').html('"' + + '"')
    $('#search-inp-value').html(`"${$('#search-input').val()}"`)

    searchFor($('#search-input').val())
}
var base_url = window.location.origin;
function searchFor(word) {

    let url = base_url + "/search?search=" + word;
    if (word.length > 0) {

        $.ajax({
            type: "get",
            url,
            success: function (response) {
                $("#search-results-container").children().remove();
                let categoriesContainer = categoriesItemsGenerator(response.categories)
                if (categoriesContainer) {
                    $('#search-results-container').append(categoriesContainer)
                } else {
                    $("#categories-results-header").remove();
                    $("#categories-results-list").remove();
                }

                let productsContainer = productsItemsGenerator(response.products)
                if (productsContainer) {
                    $('#search-results-container').append(productsContainer)
                } else {
                    $("#products-results-header").remove();
                    $("#products-results-list").remove();

                }

            }
        });
    } else {
        $("#search-results-container").children().remove();
    }

}

function categoriesItemsGenerator(items) {
    if (items.length == 0) return false;
    let categoriesContainer = `<span id="categories-results-header" class="text-sm mr-4">
                                    در دسته بندی ها
                                </span>
                                <ul id="categories-results-list" class="mx-4 flex flex-nowrap gap-x-2 overflow-x-scroll">`;

    items.map(item => {
        categoriesContainer += `<a href=""
        class="min-w-fit bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 hover-transition rounded-lg p-2 flex items-center gap-x-2">
        <img class="w-20 rounded-lg" src="${base_url}/storage/${item.image['indexArray']['medium']}" alt="">
        <span class="flex flex-col gap-y-1">
            <span class="text-sm font-bold">${item.name}</span>
            <span class="text-xs">دسته بندی ها</span>
        </span>
    </a>`;
    })

    categoriesContainer += `</ul>`;

    return categoriesContainer;
}

function productsItemsGenerator(items) {

    if (items.length == 0) return false;

    let productsContainer = `
    <span id="products-results-header" class="text-sm mr-4">
                        در محصولات
                    </span>
    <ul id="products-results-list" class="mx-4 flex flex-nowrap gap-x-2 overflow-x-scroll">`;
    items.map(item => {
        productsContainer += `<a href="${base_url}/product/${item.id}"
        class="min-w-fit bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 hover-transition rounded-lg p-2 flex items-center gap-x-2 w-fit">
        <img class="w-20 rounded-lg" src="${base_url}/storage/${item.image['indexArray']['medium']}" alt="">
        <span class="flex flex-col gap-y-1">
            <span class="text-sm font-bold">${item.name}</span>
            <span class="text-xs">در دسته بندی</span>
        </span>
    </a>`;
    })

    productsContainer += `</ul>`;

    return productsContainer;
}