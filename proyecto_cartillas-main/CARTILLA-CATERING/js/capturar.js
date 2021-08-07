
//Definimos el botón para escuchar su click, y también el contenedor del canvas
const $boton = document.querySelector("#btnCapturar"), // El botón que desencadena
  $objetivo = document.querySelector("#login"); // A qué le tomamos la foto
  $contenedorCanvas = document.querySelector("#contenedorCanvas"); // En dónde ponemos el elemento canvas

// Agregar el listener al botón
$boton.addEventListener("click", () => {
    html2canvas($objetivo) // Llamar a html2canvas y pasarle el elemento
      .then(canvas => {
        // Cuando se resuelva la promesa traerá el canvas
        // Crear un elemento <a>
        let enlace = document.createElement('a');
        enlace.download = "Captura_catering_and_cooking.png";
        // Convertir la imagen a Base64
        enlace.href = canvas.toDataURL();
        // Hacer click en él
        enlace.click();
      });
  });