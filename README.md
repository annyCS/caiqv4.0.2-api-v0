<p align="center"><a href="https://laravel.com" target="_blank"><img src="./storage/readme_sources/logo_alt.png" width="400"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## CAIQ v4.0.2 - CSA Questionnaire Application

# Descripción del proyecto
CAIQ es un acrónimo de Consensus Assessment Initiative Questionnaire. Se trata de un cuestionario de hoja de cálculo descargable de preguntas de sí o no que corresponden a los controles de Cloud Controls Matrix (CCM) de CSA , el marco de controles de seguridad cibernética para el cloud computing. Un proveedor de servicios en la nube (CSP) IaaS, PaaS o SaaS puede usar el CAIQ para documentar qué controles de seguridad existen en sus servicios. Esto aumenta la transparencia del control de seguridad para los clientes potenciales, quienes luego pueden determinar si los servicios en la nube del CSP son lo suficientemente seguros para los propósitos del cliente.

Este proyecto consiste en una API que te permite poder realizar este cuestionario de una manera más felxible y friendly, ideal para aquellos proveedores SaaS que se están iniciando en el abordaje de marcos de seguridad.

La herramienta, que contiene precargado toda la estrucutra base del cuestionario, te permite además de crear múltiples cuestionarios asociados a una misma organización, la siguientes funcionalidades:
- Crear una organización para centralizar diferentes cuestionarios y que estos puedan ser editados o completados por otros usuarios.

- Gestionar los cuestionarios pertenecientes a la organización del usuario.

- Obtener los resultados de todas preguntas completadas y ofrecerte un resumen del estado del cuestionario.

- Poder integrarlo con tu propia interfaz de usuario:
    * Es compatible con cualquier framework frontend tipo nuxt.js o next.js o incluso HTML puro.
    * Sólo debe realizarse las llamadas siguiendo la documentación de la API para poder realizar las peticiones que se necesitan.

- Las ventajas de esta herramienta frente a otras disponibles en el mercado son:
- Facilidad de instalación, configuración y ampliación.
- De bajo coste y sin requerir hardware adicional.


# Características
Para el desarrollo de esta API se ha empleado Laravel por si 
Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
