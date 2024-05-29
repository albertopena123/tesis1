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

// Obtiene una referencia a la base de datos
const database = getDatabase(app);


document.getElementById("miFormulario").addEventListener("submit", async function(event) {
  // Evita que el formulario se envíe automáticamente
  event.preventDefault();
  const dniE = document.getElementById("dni").value;

  const fileInput = document.getElementById("fotocarnet");
  const file = fileInput.files[0];

  const storageReference = storageRef(storage, dniE); // Utiliza un nombre de referencia único para el almacenamiento
  try {
    // Subir el archivo al almacenamiento de Firebase
    const snapshot = await uploadBytes(storageReference, file);
    console.log("Imagen subida con éxito:", snapshot);
    
    // Obtén la URL de descarga de la imagen
    const downloadURL = await getDownloadURL(storageReference);
    console.log("URL de descarga:", downloadURL);

    // Continúa con el resto del proceso, como guardar la URL de descarga en la base de datos.
    
  } catch (error) {
    console.error("Error al subir la imagen:", error);
  }

  // Obtener los valores de los campos del formulario
  const dni = document.getElementById("dni").value;
  const gremio = document.getElementById("gremio").value;
  const placa = document.getElementById("placanumero").value;
  const apellidom = document.getElementById('apellidom').value;
  const apellidop = document.getElementById('apellidop').value;
  const nombresfinal = document.getElementById('nombresfinal').value;

  
  // Definir los datos a agregar a Firebase
  const newData = {
    apellidos: apellidop +' '+ apellidom,
    estado: true,
    gremio: gremio,
    nombres: nombresfinal,
    placa: placa,
    dni:dni
  };

  // Obtiene la referencia específica donde deseas agregar los datos
  const newDataRef = databaseRef(database, 'placa/' + newData.dni); // Usa el alias único para la referencia de la base de datos

  // Agrega los datos a la base de datos utilizando el método set()
  set(newDataRef, newData)
    .then(() => {
      console.log("Datos agregados correctamente.");
      // Envía el formulario después de agregar los datos a Firebase
      document.getElementById("miFormulario").submit();
    })
    .catch((error) => {
      console.error("Error al agregar los datos:", error);
    });

  console.log(newData); // Solo para verificar que se han obtenido los valores correctamente
});
