<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animación al hacer Scroll</title>
    <style>
        body {
            height: 200vh; /* Para permitir el scroll */
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .caja {
            width: 100px;
            height: 100px;
            background-color: blue;
            opacity: 0; /* Oculta el elemento hasta que se active la animación */
            transform: translateY(50px);
            transition: opacity 0.5s ease-out, transform 0.5s ease-out;
        }

        .caja.mostrar {
            opacity: 1;
            transform: translateX(100px);
        }
    </style>
</head>
<body>

    <h2>Desplázate hacia abajo</h2>
    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facere officia possimus voluptatem repellendus voluptate, quis dolor ipsam perspiciatis cum alias magni id dolorum rem praesentium omnis quaerat consequatur numquam atque, laboriosam nobis commodi neque ad. In voluptatibus ipsum similique quidem deleniti beatae consequatur placeat ducimus, consequuntur excepturi totam, iure non error sequi quibusdam nihil. Dolores aliquam est iusto. Veniam mollitia quidem velit earum, excepturi dolorum, laborum neque officiis aliquid dignissimos ad a, aut quae temporibus hic blanditiis ratione ullam. Repellat beatae aut, laboriosam vel sapiente, doloremque non ea autem quidem ipsam tempore quas nulla? Aut dolorem sint eum culpa earum, numquam ullam cupiditate, ad quod laudantium amet similique impedit dicta, magni commodi expedita perspiciatis repudiandae explicabo quasi praesentium qui. Veniam alias impedit expedita laborum iure! A itaque tempora minus quia dolor excepturi ipsam id doloremque possimus fugit tempore fugiat dolorum, maxime sint odio animi et blanditiis est dolore, assumenda voluptatibus vitae? Mollitia in eos molestias ipsum sapiente rem repudiandae animi porro numquam, eum excepturi est voluptatem odio? Praesentium pariatur deserunt alias possimus magni amet similique consequatur, repudiandae quae, dolore libero, quasi impedit repellendus voluptates id perferendis necessitatibus! Amet inventore aliquam sequi iure facilis deleniti earum, deserunt optio fuga rem odio explicabo facere necessitatibus perspiciatis officiis voluptas tenetur voluptatum? Temporibus assumenda commodi totam blanditiis esse id numquam nam aliquam quis aspernatur atque, cupiditate officia autem expedita. Iure, quae cupiditate, exercitationem dolorum deleniti accusantium odio fugiat nulla nesciunt ipsam impedit modi error excepturi culpa alias delectus rem natus? Incidunt fugiat, facilis ducimus perspiciatis rem assumenda adipisci nihil cum quaerat natus velit obcaecati vel pariatur doloribus odit earum possimus molestiae. Nostrum, temporibus illo, hic maxime amet error nesciunt blanditiis eos nulla aliquid officia, repudiandae tempora corrupti dignissimos veniam vitae itaque possimus? Qui, quisquam eligendi expedita fuga accusantium eos laboriosam nostrum repellendus ipsam vel. Deserunt fuga voluptas accusamus odit voluptatum laboriosam eligendi blanditiis totam mollitia qui illum officiis saepe obcaecati ex facilis placeat omnis veritatis consectetur voluptatibus molestiae expedita, maiores quidem. Fugiat incidunt suscipit perspiciatis deserunt ea error rem, quasi cum aut ad adipisci ex consequuntur quam temporibus, eveniet sit porro magni unde tempora. Est odio fugit provident quis vero! Ipsa earum nulla quaerat. Doloremque dicta fuga placeat distinctio blanditiis possimus a porro repellat laborum non, iste sit debitis sunt quo! Temporibus aliquid inventore sunt at laboriosam? Laudantium eveniet pariatur harum maxime commodi illo velit? Non delectus molestiae id ut, eligendi optio eveniet adipisci quo numquam repudiandae incidunt quia quam eius totam? Repellat quas nesciunt eaque laborum culpa ea eum numquam odit expedita amet. Vel corporis facilis earum eligendi illum repudiandae nemo reiciendis laboriosam maiores cupiditate in sunt perspiciatis fugit laudantium deserunt, animi nulla rem veritatis deleniti consequuntur nesciunt qui molestias nobis. Nostrum dolor accusantium enim cumque doloribus eligendi perspiciatis omnis molestiae numquam! Nisi reiciendis non, at cumque fuga, natus perspiciatis corrupti dicta, enim doloribus nam necessitatibus ad et explicabo consequuntur? Iste accusamus nemo, minus maiores ipsam modi voluptates nisi consequatur, odit ea porro voluptatem eum natus quas sapiente, qui quaerat optio. Obcaecati, odio.
    <div style="height: 50vh;"></div> <!-- Espacio para hacer scroll -->
    <div class="caja" id="caja"></div>
    <div style="height: 100vh;"></div> <!-- Más espacio -->

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let caja = document.getElementById("caja");

            let observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        caja.classList.add("mostrar");
                        observer.unobserve(entry.target); // Dejar de observar después de activarse una vez
                    }
                });
            }, { threshold: 0.5 }); // Se activa cuando el 50% del elemento es visible

            observer.observe(caja);
        });
    </script>

</body>
</html>
