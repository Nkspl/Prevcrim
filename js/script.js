// js/script.js

/**
 * Limpia el RUT: elimina puntos, guiones y pasa a mayúsculas.
 */
function limpiarRut(rut) {
  return rut.replace(/[^0-9kK]/g, '').toUpperCase();
}

/**
 * Calcula el dígito verificador con factores 2‑7.
 */
function calcularDigitoVerificador(rutSinDv) {
  let sum = 0;
  let factor = 2;
  for (let i = rutSinDv.length - 1; i >= 0; i--) {
    sum += parseInt(rutSinDv.charAt(i), 10) * factor;
    factor = (factor === 7) ? 2 : factor + 1;
  }
  const dv = 11 - (sum % 11);
  if (dv === 11) return '0';
  if (dv === 10) return 'K';
  return dv.toString();
}

/**
 * Valida el RUT completo.
 */
function validarRut(rut) {
  const limpio = limpiarRut(rut);
  if (limpio.length < 2) return false;
  const cuerpo = limpio.slice(0, -1);
  const dvIngresado = limpio.slice(-1);
  const dvCalculado = calcularDigitoVerificador(cuerpo);
  return dvIngresado === dvCalculado;
}

document.addEventListener("DOMContentLoaded", () => {
  // Validación de RUT en todos los inputs[name="rut"]
  document.querySelectorAll('input[name="rut"]').forEach(field => {
    field.addEventListener("blur", () => {
      if (field.value && !validarRut(field.value)) {
        alert(`El RUT ingresado (${field.value}) no es válido.`);
        field.focus();
      }
    });
  });

  // Toggle del sidebar
  const btn = document.getElementById('btnToggleSidebar');
  if (btn) {
    btn.addEventListener('click', () => {
      document.getElementById('sidebar').classList.toggle('hidden');
    });
  }

  // Autocompletar coordenadas usando Nominatim
  const lugarInput = document.getElementById('ultimo_lugar');
  const latInput = document.getElementById('latitud');
  const lonInput = document.getElementById('longitud');
  if (lugarInput && latInput && lonInput) {
    lugarInput.addEventListener('blur', () => {
      const query = lugarInput.value.trim();
      if (!query) return;
      const url =
        `https://nominatim.openstreetmap.org/search?format=json&limit=1&q=${encodeURIComponent(query)}`;
      fetch(url, { headers: { 'User-Agent': 'prevcrim-app' } })
        .then(r => r.json())
        .then(data => {
          if (data.length) {
            latInput.value = data[0].lat;
            lonInput.value = data[0].lon;
          }
        })
        .catch(err => {
          console.error('Geocoding error', err);
        });
    });
  }

// Avisar al usuario con un mensaje informativo en caso de que le de al boton sin rellenar el formulario en reportes
const input = document.getElementById("ing_list_del");

input.addEventListener("invalid", (event) => {
  input.setCustomValidity("Por favor, rellenar el campo.");
});

input.addEventListener("input", (event) => {
  input.setCustomValidity("");
});



});
