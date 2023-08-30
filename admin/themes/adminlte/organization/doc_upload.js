const file1 = document.getElementById("file1");
const file2 = document.getElementById("file2");
const textArea = document.getElementById("textArea");
const textArea2 = document.getElementById("textArea2");

const convertBase64 = (file) => {
return new Promise((resolve, reject) => {
    const fileReader = new FileReader();
    fileReader.readAsDataURL(file);

    fileReader.onload = () => {
        resolve(fileReader.result);
    };

    fileReader.onerror = (error) => {
        reject(error);
    };
});
};

function bin2hex (s) {
let i
let l
let o = ''
let n
s += ''
for (i = 0, l = s.length; i < l; i++) {
n = s.charCodeAt(i)
  .toString(16)
o += n.length < 2 ? '0' + n : n
}
return o
}

const uploadImage = async (event) => {
const file = event.target.files[0];
const base64 = await convertBase64(file); 

console.log(base64);

//avatar.src = base64;
textArea.value = bin2hex(base64);
};

const uploadImage_v2 = async (event) => {
    const file = event.target.files[0];
    const base64 = await convertBase64(file); 

    console.log(base64);

    //avatar.src = base64;
    textArea2.value = bin2hex(base64);
};

const uploadImage_v3 = async (event) => {
    const file = event.target.files[0];
    const base64 = await convertBase64(file); 

    console.log(base64);

    //avatar.src = base64;
    textArea3.value = bin2hex(base64);
};

file1.addEventListener("change", (e) => {
    var file = event.target.files[0]; // Get the selected file

    // File type check
    var allowedTypes = ['image/jpeg']; // Allowed file types
    if (allowedTypes.indexOf(file.type) === -1) {
    alert('Invalid file type. Please select a jpeg file.');
    document.getElementById("file1").value=''; 
    document.getElementById("textArea").value='';
    return false;
    }

    // File size check
    var maxSizeInBytes = 1 * 1024 * 100; // 100 KB maximum size
    if (file.size > maxSizeInBytes) {
    alert('File size exceeds the maximum limit of 100 KB.');
    document.getElementById("file1").value=''; 
    document.getElementById("textArea").value='';
    return false;
    }
    uploadImage(e);
});

file2.addEventListener("change", (e) => {
    var file = event.target.files[0]; // Get the selected file

    // File type check
    var allowedTypes = ['image/jpeg']; // Allowed file types
    if (allowedTypes.indexOf(file.type) === -1) {
    alert('Invalid file type. Please select a jpeg file.');
    document.getElementById("file2").value=''; 
    document.getElementById("textArea2").value='';
    return false;
    }

    // File size check
    var maxSizeInBytes = 1 * 1024 * 50; // 50 KB maximum size
    if (file.size > maxSizeInBytes) {
    alert('File size exceeds the maximum limit of 50 KB.');
    document.getElementById("file2").value=''; 
    document.getElementById("textArea2").value='';
    return false;
    }
    uploadImage_v2(e);
});


file3.addEventListener("change", (e) => {
    var file = event.target.files[0]; // Get the selected file

    // File type check
    var allowedTypes = ['application/pdf']; // Allowed file types
    if (allowedTypes.indexOf(file.type) === -1) {
    alert('Invalid file type. Please select a pdf file.');
    document.getElementById("file3").value=''; 
    document.getElementById("textArea3").value='';
    return false;
    }

    // File size check
    var maxSizeInBytes = 1 * 1024 * 200; // 200 KB maximum size
    if (file.size > maxSizeInBytes) {
    alert('File size exceeds the maximum limit of 200 KB.');
    document.getElementById("file3").value=''; 
    document.getElementById("textArea3").value='';
    return false;
    }
    uploadImage_v3(e);
});