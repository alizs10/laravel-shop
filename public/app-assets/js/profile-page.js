function toggleEditUserInfos()
{
    $('body').toggleClass('overflow-hidden')
    $('#edit-user-infos-backdrop').toggleClass('hidden flex-center')
}

function profileBack()
{
    $('#profile-section').toggleClass('hidden')
    $('#user-infos-section').toggleClass('hidden')
}