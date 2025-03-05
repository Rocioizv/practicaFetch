document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('update-btn').addEventListener('click', function () {
        let form = document.getElementById('editForm');
        let formData = new FormData(form);

        fetch(updateReservationUrl, {
            method: "POST", 
            headers: {
                "X-CSRF-TOKEN": csrfToken,
                "X-Requested-With": "XMLHttpRequest"
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Error en la actualización");
            }
            return response.json();
        })
        .then(data => {
            alert("Reserva actualizada correctamente");
            window.location.href = reservationsIndexUrl; 
        })
        .catch(error => {
            alert("Hubo un problema: " + error.message);
        });
    });
});
