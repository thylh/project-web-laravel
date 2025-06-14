const dropArea = document.getElementById('drop-area');
const fileInput = document.getElementById('fileInput');
const uploadForm = document.getElementById('uploadForm');
const fileInfo = document.getElementById('file-info');

dropArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropArea.classList.add('hover');
});

dropArea.addEventListener('dragleave', () => {
    dropArea.classList.remove('hover');
});

dropArea.addEventListener('drop', (e) => {
    e.preventDefault();
    dropArea.classList.remove('hover');
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        fileInput.files = files;
        uploadForm.submit();
    }
});
function openModal() {
    document.getElementById("infoModal").style.display = "block";
}

function closeModal() {
    document.getElementById("infoModal").style.display = "none";
}

window.onclick = function(event) {
    const modal = document.getElementById("infoModal");
    if (event.target === modal) {
        modal.style.display = "none";
    }
}
document.getElementById('fileInput').addEventListener('change', function () {
    if (this.files.length > 0) {
        document.getElementById('uploadForm').submit();
    }
});
;function validateAndSubmit() {
    return true;
}

    fileInput.addEventListener('change', handleFile);

    function handleFile() {
        const file = fileInput.files[0];
        if (!file) return;

        const allowedTypes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'image/jpeg',
            'image/png',
            'application/vnd.ms-excel',
            'application/zip',
            'application/x-zip-compressed'
        ];

        const sizeMB = file.size / (1024 * 1024);
        let message = `<strong>Tên:</strong> ${file.name}<br>`;
        message += `<strong>Kích thước:</strong> ${sizeMB.toFixed(2)} MB<br>`;

        if (!allowedTypes.includes(file.type)) {
            message += `<span style="color:red;">Định dạng không hợp lệ!</span>`;
        } else if (sizeMB > 100) {
            message += `<span style="color:red;">File vượt quá giới hạn 100MB!</span>`;
        }

        fileInfo.innerHTML = message;
    }
