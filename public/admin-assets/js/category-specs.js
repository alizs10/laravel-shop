$(document).ready(function () {
    $(window).keydown(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            addSpec();
            return false;
        }
    });
});

$('#add-spec').on('click', addSpec);
var specsSection = $('#specs')
var specName = $('#name')
var specDefaultValue = $('#default_value')
var specStatus = $('#status')

var spec_iteration = 1;

function addSpec() {
    if (specName.val() === "") return;
    let inputVal = {
        name: specName.val(),
        default_value: specDefaultValue.val(),
        status: specStatus.val()
    }
    let specId = Math.floor(Math.random() * 10000000);
    console.log(specId);
    let input = "<input type='hidden' name='spec[]' value='" + JSON.stringify(inputVal) + "'/>";
    let span = "<span>" + spec_iteration + ". " + specName.val() + " - " + (specDefaultValue.val() === "" ? "بدون مقدار" : specDefaultValue.val()) + " - " + specStatus.find(":selected").text(); + "</span>";
    let btn = "<button type='button' onclick='delSpec(" + specId + ")' class='text-red-500'><i class='fa-solid fa-xmark'></i></button>";
    let specContainer = '<span  id="spec-' + specId + '" class="flex gap-x-2">' + span + "</span>";
    specContainer += btn;
    specContainer += input;
    specsSection.append(specContainer)


    specName.val("")
    specDefaultValue.val("")
    specStatus.val("1")
    spec_iteration++;
    specName.focus()
}

function delSpec(id) {
    $('#spec-' + id).remove()


}