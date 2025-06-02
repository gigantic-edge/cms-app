&copy; <?= date('Y'); ?> My Website. All rights reserved.

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script>
  document.getElementById('image').addEventListener('change', previewImage);

  function previewImage() {
    const preview = document.getElementById('image-preview');
    const fileInput = document.querySelector('input[type="file"]');
    const file = fileInput.files[0];
    const reader = new FileReader();

    reader.onloadend = function() {
      preview.innerHTML = `
            <div class="position-relative d-inline-block mt-2">
                <img src="${reader.result}" style="max-width:250px; max-height:150px;" class="img-thumbnail">
                <span onclick="trashImage()" class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-danger" style="cursor:pointer; font-size: 1rem;">
                    <i class="fas fa-times"></i>
                </span>
            </div>
        `;
    };

    if (file) {
      reader.readAsDataURL(file);
    } else {
      preview.innerHTML = '';
    }
  }

  function trashImage() {
    document.getElementById('image-preview').innerHTML = '';
    document.querySelector('input[type="file"]').value = '';
  }


  document.getElementById('image').addEventListener('change', function (e) {
    const file = e.target.files[0];
    const preview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');
    const existingImg = document.getElementById('existing-image');

    if (file) {
        const reader = new FileReader();
        reader.onload = function (event) {
            previewImg.src = event.target.result;
            preview.style.display = 'block';

            if (existingImg) {
                existingImg.style.display = 'none';
            }
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
        if (existingImg) {
            existingImg.style.display = 'block';
        }
    }
});
</script>