<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base Login</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            font-family: 'Tomasa', sans-serif;
            color: white;
            /* Cambio del color del texto a blanco */
            background: linear-gradient(to right, #5C7DF3 20%, #1D22DC 50%, #B96493 60%, #C55042 80%, #E28E25 100%);
        }

        .content {
            position: relative;
            z-index: 1;
            background: rgba(255, 255, 255, 0);
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            text-align: center;
        }

        .menu-container {
            display: flex;
            justify-content: flex-end;
            padding: 1rem;
            /* Agregar un espacio alrededor de los enlaces */
        }

        .menu-links {
            display: flex;
        }

        .menu-links a {
            margin: 0.25rem 1rem;
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 1rem;
            transition: color 0.3s;
            /* Agregar transición de color al enlace */
        }

        .menu-links a:hover {
            color: #5C7DF3;
            /* Cambiar el color al pasar el mouse */
        }

        .content button {
            width: auto;
            margin-top: 1rem;
            background: linear-gradient(to right, #5C7DF3 20%, #1D22DC 50%, #B96493 60%, #C55042 80%, #E28E25 100%);
            border: none;
            border-radius: 5px;
            color: white;
            padding: 10px 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.062);
            transition: background 0.3s, transform 0.1s;
            cursor: pointer;
            font-weight: bold;
            font-size: 1rem;
        }

        .content button:hover {
            background: linear-gradient(to right, #1D22DC 20%, #5C7DF3 50%, #C55042 60%, #B96493 80%, #E28E25 100%);
            transform: scale(1.05);
        }

        .affirmation-text {
            font-size: 1.75rem;
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <div class="menu-container">
        <div class="menu-links">
            @auth
            <a href="{{ url('/dashboard') }}">Dashboard</a>
            @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </div>

    <div class="content">
        <main>
            <img src="https://assets.codepen.io/3174/t-rex.png?width=448&height=448&format=webp&quality=50"
                alt="T-rex, drawn in pixel art" style="margin-bottom: 0.1rem;">
            <div class="font-georgia text-1.75xl sm:text-4vw md:text-2.25xl text-blue-500 affirmation-text"
                style="margin-top: 0.1rem;">
                Soy suficiente tal como soy.
            </div>

            <div class="mix-blend-color-burn">
                <div class="img"></div>
                <div class="div"></div>
            </div>
            <button id="generateAffirmation">Generate Affirmation</button>
        </main>
    </div>

    <script>
        // Arreglo de afirmaciones
        const affirmations = [
            "Merezco amor y respeto.",
            "Estoy creciendo y evolucionando cada día.",
            "Tengo el control de mi felicidad.",
            "Soy capaz de lograr mis metas.",
            "Merezco todas las cosas buenas que suceden en mi vida.",
            "Soy resiliente y puedo superar los momentos difíciles.",
            "Soy libre para crear la vida que deseo.",
            "Soy amado y apoyado por quienes me rodean.",
            "Soy fuerte e independiente.",
            "Estoy mejorándome constantemente y creciendo como persona.",
            "Estoy rodeado de abundancia.",
            "Estoy lleno de potencial y posibilidades infinitas.",
            "Tengo el control de mi vida y de nadie más.",
            "Merezco mis sueños y aspiraciones.",
            "Soy un pensador positivo y solo atraigo cosas positivas.",
            "Estoy abierto a nuevas aventuras en mi vida.",
            "Merezco estabilidad financiera.",
            "No soy definido por mis errores.",
            "Estoy lleno de creatividad sin límites.",
            "Soy una persona amable y cariñosa.",
            "Estoy orgulloso de todo lo que he logrado.",
            "No soy mi pasado ni mis imperfecciones.",
            "Merezco todo lo bueno que llega a mi vida.",
            "Siempre estoy aprendiendo y creciendo.",
            "Soy suficiente tal como soy.",
            "Soy un imán para el éxito y la prosperidad.",
            "Estoy enfocado y soy persistente.",
            "Merezco el amor, al igual que todos los demás.",
            "No estoy solo en mis luchas.",
            "Soy más valiente de lo que creo.",
            "Soy un faro de amor y compasión.",
            "Merezco el tiempo y el espacio necesarios para sanar.",
            "Soy capaz de lograr la grandeza.",
            "Siempre estoy avanzando en la dirección correcta.",
            "Merezco amor, compasión y empatía.",
            "No soy definido por las opiniones de los demás.",
            "Merezco toda la belleza que la vida ofrece.",
            "Puedo superar cualquier desafío que se presente en mi camino.",
            "Siempre hago lo mejor que puedo, y eso es suficiente.",
            "Merezco respeto y amabilidad.",
            "Estoy a cargo de mi destino.",
            "Soy poderoso y capaz de hacer grandes cosas.",
            "Estoy rodeado de personas que creen en mí.",
            "Soy un individuo único y especial.",
            "Merezco toda la felicidad del mundo.",
            "Soy más fuerte que cualquier obstáculo que se interponga en mi camino.",
            "Siempre estoy creciendo y desarrollándome.",
            "Merezco respeto y admiración.",
            "Tengo un lugar merecido en el mundo.",
            "Estoy viviendo mi mejor vida cada día.",
            "Merezco el éxito y la prosperidad.",
            "Estoy abierto al amor y la bondad.",
            "Soy un faro de luz y esperanza.",
            "Soy amado por quienes me rodean.",
            "Estoy creando la vida que merezco.",
            "Merezco paz y tranquilidad.",
            "Soy un poderoso creador.",
            "Soy amado y respaldado por el universo.",
            "Merezco la felicidad y la alegría.",
            "Estoy a cargo de cómo me siento.",
            "Estoy orgulloso de quien soy.",
            "Soy amado y valorado.",
            "Soy un imán para el amor y la positividad.",
            "Soy más fuerte de lo que pienso.",
            "Estoy viviendo mi mejor vida en este momento.",
        ];

        // Función para elegir aleatoriamente una afirmación del arreglo
        function getRandomAffirmation() {
            const randomIndex = Math.floor(Math.random() * affirmations.length);
            return affirmations[randomIndex];
        }

        const affirmationDiv = document.querySelector(".affirmation-text");
        const affirmationButton = document.getElementById("generateAffirmation");

        // Mostrar una afirmación al cargar la página
        affirmationDiv.innerText = getRandomAffirmation();

        // Escuchar clics en el botón y mostrar una nueva afirmación
        affirmationButton.addEventListener("click", () => {
            affirmationDiv.innerText = getRandomAffirmation();
        });
    </script>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>