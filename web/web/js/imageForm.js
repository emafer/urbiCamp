function getFileData(myFile){
    let file = myFile.files[0];
    let filename = file.name;
    $('#immagine-nome').val(filename);

    let img = document.createElement("img");
    img.setAttribute('width', 300);
    img.classList.add("obj");6
    img.file = file;
    $('#preview').html(img);

    let reader = new FileReader();
    reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
    reader.readAsDataURL(file);
}
