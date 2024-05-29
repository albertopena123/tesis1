import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.6/firebase-app.js";
import { getDatabase, ref as databaseRef, set } from "https://www.gstatic.com/firebasejs/9.6.6/firebase-database.js";
import { getStorage, ref as storageRef, uploadBytes, getDownloadURL } from "https://www.gstatic.com/firebasejs/9.6.6/firebase-storage.js";

const firebaseConfig = {
apiKey: "AIzaSyCP90awy18PadIJs6ihetSTzIfLjAU3E5U",
authDomain: "placavision-43d14.firebaseapp.com",
databaseURL: "https://placavision-43d14-default-rtdb.firebaseio.com",
projectId: "placavision-43d14",
storageBucket: "placavision-43d14.appspot.com",
messagingSenderId: "61424825675",
appId: "1:61424825675:web:48447a3ce94a216aa3a4ce",
measurementId: "G-XMDV86GQD0"
};


// Inicializa Firebase
const app = initializeApp(firebaseConfig);
const storage = getStorage(app); // Obtener una referencia al almacenamiento

const imageRef = storageRef(storage, '77493318.jpg');

// Obtener la URL de descarga de la imagen
getDownloadURL(imageRef)
.then((url) => {
// Asignar la URL de descarga al atributo src de la etiqueta <img>
document.getElementById('preview').src = url;
})
.catch((error) => {
// Manejar cualquier error que ocurra
console.error('Error al obtener la URL de descarga de la imagen:', error);
});