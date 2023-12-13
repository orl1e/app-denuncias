$(document).ready(function () {
    const maxLength = 150; // Establece la longitud máxima permitida

    // Llama a la función limitarTexto cuando la página carga
    limitarTexto($("#miTextarea"), $("#caracteresRestantes"));
    limitarTexto($("#miTextarea2"), $("#caracteresRestantes2"));

    // Maneja el evento de cambio en el textarea 1
    $("#miTextarea").on("input", function () {
        limitarTexto($(this), $("#caracteresRestantes"));
    });

    // Maneja el evento de cambio en el textarea 2
    $("#miTextarea2").on("input", function () {
        limitarTexto($(this), $("#caracteresRestantes2"));
    });

    function limitarTexto(textarea, contadorCaracteres) {
        const texto = textarea.val();
        const caracteresRestantes = maxLength - texto.length;

        // Actualiza el contador de caracteres restantes
        contadorCaracteres.text(caracteresRestantes);

        // Verifica si se excede la longitud máxima
        if (caracteresRestantes < 0) {
            // Trunca el texto excedente
            textarea.val(texto.slice(0, maxLength));

            // Muestra una alerta indicando que se ha alcanzado el límite
            Swal.fire({
                icon: 'warning',
                title: 'Límite de caracteres alcanzado',
                text: 'Se ha alcanzado el límite de caracteres permitidos.',
            });
        }
    }
});
