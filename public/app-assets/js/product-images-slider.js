var imgs = $('#slidershow-imgs img')
var imgsLength = imgs.length;
var xStart;
var xEnd;

$('#slidershow-imgs').on('mousedown', function (e) {
    e.preventDefault();
    xStart = e.clientX;

})

$('#slidershow-imgs').on('mouseup', function (e) {
    e.preventDefault();
    xEnd = e.clientX;

    // diff < 0 means draged left, > 0 means draged right
    let diff = xEnd - xStart;
    if (Math.abs(diff) > 50) {
        if (diff > 0) {
            prevSlide()
        } else {
            nextSlide()
        }
    }
})

function prevSlide() {
    let id = $('#slidershow-imgs .active').attr('id')
    id = id.slice(7, id.length)
    id = parseInt(id)

    let nextId = id <= 1 ? imgsLength : id - 1;

    toggleSliderBtn(id, nextId)
    $('#slider-' + id).removeClass('active').addClass('hidden')
    $('#slider-' + nextId).removeClass('hidden').addClass('active')

}

function nextSlide() {
    let id = $('#slidershow-imgs .active').attr('id')
    id = id.slice(7, id.length)
    id = parseInt(id)

    let nextId = id == imgsLength ? 1 : id + 1;

    toggleSliderBtn(id, nextId)
    $('#slider-' + id).removeClass('active').addClass('hidden')
    $('#slider-' + nextId).removeClass('hidden').addClass('active')
}

$('#s-btns span').on('click', function () {
    let id = $('#s-btns .bg-red-500').attr('id')
    id = id.slice(6, id.length)
    id = parseInt(id)

    let nextId = $(this).attr('id')
    nextId = nextId.slice(6, nextId.length)
    nextId = parseInt(nextId)

    if (id == nextId) return;

    toggleSliderBtn(id, nextId)

    $('#slider-' + id).removeClass('active').addClass('hidden')
    $('#slider-' + nextId).removeClass('hidden').addClass('active')
})

// for mobile devices
$('#slidershow-imgs').on('touchstart', function (e) {
   

   
    xStart =  e.changedTouches[0].screenX

})

$('#slidershow-imgs').on('touchend', function (e) {
   
    xEnd =  e.changedTouches[0].screenX

    // diff < 0 means draged left, > 0 means draged right
    let diff = xEnd - xStart;
    if (Math.abs(diff) > 50) {
        if (diff > 0) {
            prevSlide()
        } else {
            nextSlide()
        }
    }
})

function toggleSliderBtn(id, nextId) {

    $('#s-btn-' + id).removeClass('bg-red-500').addClass('bg-white')
    $('#s-btn-' + nextId).removeClass('bg-white').addClass('bg-red-500')

}