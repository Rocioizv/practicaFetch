async function submitReservation() {
    const formData = {
        user_id: "{{ auth()->id() }}", // Obtenemos el ID del usuario autenticado
        table_id: document.getElementById('table_id').value,
        date: document.getElementById('date').value,
    };

    try {
        const response = await fetch(reservationStoreUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken // Asegúrate de enviar el CSRF token aquí
            },
            body: JSON.stringify(formData)
        });

        const data = await response.json();
        console.log("Parsed response:", data);

        if (response.ok) {
            document.getElementById("responseMessage").innerHTML =
                `<div class="alert alert-success">${data.message}</div>`;
            document.getElementById("reservationForm").reset();
        } else {
            document.getElementById("responseMessage").innerHTML =
                `<div class="alert alert-danger">${data.error}</div>`;
        }
    } catch (error) {
        console.error("Error en la solicitud:", error);
        document.getElementById("responseMessage").innerHTML =
            `<div class="alert alert-danger">Error en la solicitud</div>`;
    }
}
