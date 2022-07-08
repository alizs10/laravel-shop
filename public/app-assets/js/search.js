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

function searchFor(word) {
    let base_url = window.location.origin;
    let url = base_url + "/search?search=" + word;
    $.ajax({
        type: "get",
        url,
        success: function (response) {
            let productsContainer = productsItemsGenerator(response.products)
            $('#search-window div').children().eq(2).after(productsContainer)
        }
    });
}

// function categoriesItemsGenerator(items) {

// }

function productsItemsGenerator(items) {
    let base_url = window.location.origin;
    let productsContainer = `
    <span class="text-sm mr-4">
                        در محصولات
                    </span>
    <ul class="mx-4 flex flex-nowrap gap-x-2 overflow-x-scroll">`;
    items.map(item => {
        productsContainer += `<a href="${base_url}/products/${item.id}"
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