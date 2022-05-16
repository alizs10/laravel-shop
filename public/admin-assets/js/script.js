ClassicEditor
    .create(document.querySelector('#editor'), {
        language: 'fa',
        placeholder: 'متن خود را تایپ کنید...'
    })
    .catch(error => {
        console.error(error);
    });

    ClassicEditor
    .create(document.querySelector('#editor1'), {
        language: 'fa',
        placeholder: 'متن خود را تایپ کنید...'
    })
    .catch(error => {
        console.error(error);
    });

    ClassicEditor
    .create(document.querySelector('#editor2'), {
        language: 'fa',
        placeholder: 'متن خود را تایپ کنید...'
    })
    .catch(error => {
        console.error(error);
    });
