function previewImage() {
    const image = document.querySelector('#image');
    const imgPreview = document.querySelector('.img-preview');
    const iconImage = document.querySelector('#icon-image');

    imgPreview.style.display = 'inline';
    imgPreview.classList.remove('d-none');
    iconImage.style.display = 'none';

    $("label[for='image']").removeClass();

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
    };
}

function previewImageAdmin() {
    const image = document.querySelector('#image');
    const imgPreview = document.querySelector('.img-preview');
    const imgPreviewId = document.querySelector('#img-preview');
    const avatar = document.querySelector('#avatar');

    avatar.style.display = 'none';
    imgPreview.style.display = 'block';
    imgPreviewId.classList.remove('d-none');

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
    }
}

function previewImageProperty() {
    const image = document.querySelector('#photo');
    const imgPreview = document.querySelector('.img-preview');

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
    }
}