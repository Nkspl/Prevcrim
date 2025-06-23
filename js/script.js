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


if (searchInput) {
  searchInput.addEventListener("invalid", () => {
    searchInput.setCustomValidity("Por favor, rellenar el campo.");
  });

  searchInput.addEventListener("input", () => {
    searchInput.setCustomValidity("");
  });
}



});
