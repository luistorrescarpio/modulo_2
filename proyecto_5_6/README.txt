APLICATIVO PARA CONTROL DE RECOLECCION DE RESIDUOS DEL PROGRAMA DE SEGREGACION

> Enlaces de descargas de plataformas y complementos requeridos:

i)   FrameWork: HowEasy v3.4.3 (Incluido en WebServer)

ii)  Lenguaje Servidor: PHP 7.4.1
     https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/7.4.1/ (7.4.1 sugerido)

iii) Plataforma DroidScript
     https://play.google.com/store/apps/details?id=com.smartphoneremote.androidscriptfree&hl=es_PE&gl=US


>Pasos para Instalación y configuración de WebServer
- Instalar xampp 7.4.1 y ejecutarlo (Recomendado)
- Asegurar tener habilitada "short_open_tag=On" y timezone en "America/Lima" en php.ini 
- Crear base de datos denominado "mcl_proyecto_5" y subir base de datos ubicado en "database/mcl_proyecto_5.sql"
- CD/mcl_proyecto_5 // Mover la carpeta del proyecto a una ubicación dentro de su servidor web (localhost)
- Dentro del proyecto buscar el archivo "webserver/system/start.php" y modificar su ruta del proyecto en $base_url
- En system/mysql.php Indicar las credenciales de acceso de su base de datos (Por defecto suele ser user:"root", pw: "" )

>Pasos para instalación y configuración de DroidScript
- Instalación de Droidscript desde playstore (iii)
- Instalar el SPK desde la carpeta del proyecto /droidscript/mcl_proyecto_5.spk en su Smartphone
- Abrir editor del proyecto mcl_proyecto_5 como edición, buscar el archivo init.js dentro de su entorno de edición, 
  y asignar la IP y la dirección de su webserver del proyecto para comunicación.

Info adicional: 
Autor del Proyecto 5: Luis Torres Carpio 
Correo: webmaster@solsitecinnova.com
Pagina: https://www.facebook.com/developer.ltc