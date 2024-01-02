function changeAvatar(event) {
    const user_id = event.target.dataset.msAvatar;
    const selectedAvatar = document.getElementById("selectedAvatar" + user_id);
    const fileInput = document.getElementById("avatarInput" + user_id);
    const reader = new FileReader();

    if (fileInput.files.length !== 1) {
        return;
    } 

    const selectedFile = fileInput.files[0];

    reader.onload = function (e) {
        const currentAvatarData = e.target.result;
        selectedAvatar.src = currentAvatarData;
    };
    
    reader.readAsDataURL(selectedFile);
}