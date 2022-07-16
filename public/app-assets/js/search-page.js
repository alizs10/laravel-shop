function checkboxHandler(btn) {
   var checkboxId = $(btn).attr('id')
   $('label[for=' + checkboxId + ']').find('span').toggleClass('bg-white bg-red-500')
   $(btn).attr('checked', !$(btn).attr('checked'))
}

function toggleFilters() {
   $('body').toggleClass('overflow-hidden');
   $('#filters').toggleClass('hidden');
}
function togglePriceFilter() {
   $('#price-filter').children().eq(1).toggleClass('hidden');
   $('#price-filter').children().eq(0).find('svg').toggleClass('fa-angle-left fa-angle-down');


}
function toggleCategoryFilter() {
   $('#category-filter').children().eq(1).toggleClass('hidden');
   $('#category-filter').children().eq(0).find('svg').toggleClass('fa-angle-left fa-angle-down');
}

function toggleBrandFilter() {
   $('#brand-filter').children().eq(1).toggleClass('hidden');
   $('#brand-filter').children().eq(0).find('svg').toggleClass('fa-angle-left fa-angle-down');
}

function toggleProductsExistFilter(btn) {
   let existsValue = $("input[name=exists]").val()
   existsValue = existsValue === "true" ? true : false;
   $("input[name=exists]").val(!existsValue)
   if ($(btn).hasClass('active')) {
      $(btn).animate({ "margin-right": "0" }, 200, null, function () {
         $(btn).removeClass('active')
         $(btn).parent().toggleClass('bg-gray-200 dark:bg-gray-700 bg-red-500')
      })
   } else {

      $(btn).animate({ "margin-right": "1.25rem" }, 200, null, function () {
         $(btn).addClass('active')
         $(btn).parent().toggleClass('bg-gray-200 dark:bg-gray-700 bg-red-500')
      })
   }

}



// filter on price

var rect = document.getElementById('price-filter-rect');
var priceRange = document.getElementById('price-filter-range');
var startPrice = document.getElementById('price-filter-start-btn');
var endPrice = document.getElementById('price-filter-end-btn');
var limitedWidth = startPrice.getBoundingClientRect().width + endPrice.getBoundingClientRect().width;

endPrice.addEventListener('pointerdown', e => {
   endPrice.setPointerCapture(e.pointerId)

   setEndPriceRangePosition(e)
   endPrice.addEventListener('pointermove', setEndPriceRangePosition)

   document.addEventListener('pointerup', () => {

      endPrice.removeEventListener('pointermove', setEndPriceRangePosition)
   })
})

function setEndPriceRangePosition(e) {
   let xEnd = e.clientX - rect.getBoundingClientRect().left;
   console.log(e);

   let endBtnPosition = e.clientX + endPrice.getBoundingClientRect().width;
   let startBtnPosition = startPrice.getBoundingClientRect().x;
   if (xEnd > 0) {

      if (endBtnPosition < startBtnPosition) {
         priceRange.style.left = `${xEnd}px`;
         setEndPrice()
      }

   } else {
      priceRange.style.left = `0`;
   }
}

startPrice.addEventListener('pointerdown', e => {
   startPrice.setPointerCapture(e.pointerId)
   setStartPriceRangePosition(e)

   startPrice.addEventListener('pointermove', setStartPriceRangePosition)

   document.addEventListener('pointerup', () => {

      startPrice.removeEventListener('pointermove', setStartPriceRangePosition)
   })
})

function setStartPriceRangePosition(e) {
   console.log(rect.getBoundingClientRect());
   let xEnd = e.clientX - rect.getBoundingClientRect().left;
   let movement = rect.getBoundingClientRect().width - xEnd;

   let endBtnPosition = endPrice.getBoundingClientRect().x + endPrice.getBoundingClientRect().width;
   let startBtnPosition = xEnd + rect.getBoundingClientRect().left - startPrice.getBoundingClientRect().width;


   if (movement > 0) {

      if (endBtnPosition < startBtnPosition) {
         priceRange.style.right = `${movement}px`;
         setStartPrice()
      }


   } else {
      priceRange.style.right = `0`;
   }


}

function e2pNumbers(number) {
   let pNumber = priceFormatter(number);
   let persianNumbers = ['۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '۰']
   let englishNumbers = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0']
   for (let i = 0; i < englishNumbers.length; i++) {
      let req = new RegExp(englishNumbers[i], "g");
      pNumber = pNumber.replace(req, persianNumbers[i])
   }

   return pNumber;
}
function p2eNumbers(number) {
   let persianNumbers = ['۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '۰']
   let englishNumbers = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0']
   for (let i = 0; i < persianNumbers.length; i++) {
      let req = new RegExp(persianNumbers[i], "g");
      number = number.replace(req, englishNumbers[i])
   }

   return number;
}

function priceFormatter(price) {
   return parseInt(price).toLocaleString('en-US');
}



function setStartPrice() {
   let ratio = 1 - ((priceRange.getBoundingClientRect().right - rect.getBoundingClientRect().left) / rect.getBoundingClientRect().width)
   let price = $("input[name=end-price]").attr('max') * ratio.toFixed(2);
   $("input[name=start-price]").val(e2pNumbers(price.toFixed(0)))
}

function setEndPrice() {
   let ratio = 1 - ((priceRange.getBoundingClientRect().left - rect.getBoundingClientRect().left) / rect.getBoundingClientRect().width)
   let price = $("input[name=end-price]").attr('max') * ratio.toFixed(2);
   $("input[name=end-price]").val(e2pNumbers(price.toFixed(0)))
}

function applySearchFilter() {
   let base_url = window.location.origin;
   let query = "?";
   let price_start = $("input[name=start-price]").val()
   let price_end = $("input[name=end-price]").val()
   let brandsObjs = $("input[name='brand[]']")
   let brands = [];

   brandsObjs.each(function (key, brandObj) {
      if ($(brandObj).is(':checked')) {
         brands.push($(brandObj).val())
      }
   })

   if (brands.length > 0) {
      query += `brands=${brands.toString()}&`
   }

   let price = `${p2eNumbers(price_start).replace(/[,]/g, "")}-${p2eNumbers(price_end).replace(/[,]/g, "")}`;
   let reg = new RegExp(/(\d{1,20})-(\d{1,20})/g)
   if (reg.test(price)) {
      query += `price=${price}&`
   }
   let existsValue = $("input[name=exists]").val()

   query += `exists=${existsValue}&`;
   let searchedWord = $("#searched-word").html();

   if (query.at(-1) === "&") {
      query = query.substring(0, query.length - 1);
   }


   window.location.href = base_url + "/search-filter/" + (searchedWord ? searchedWord :  '')  + query;

}