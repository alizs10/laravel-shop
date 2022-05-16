ClassicEditor
    .create(document.querySelector('#cke'), {
        language: 'fa',
        placeholder: 'توضیحات محصول را وارد کنید...'
    })
    .catch(error => {
        console.error(error);
    });

