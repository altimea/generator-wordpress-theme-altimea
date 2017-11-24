# generator-wordpress-theme-altimea
> Generador para estructura de plantilla en WordPress para los proyectos de Altimea

## Installation

First, install [Yeoman](http://yeoman.io) and generator-wordpress-theme-altimea using [npm](https://www.npmjs.com/) (we assume you have pre-installed [node.js](https://nodejs.org/)).

```bash
sudo npm install -g yo
```
Clone the repository then go inside the directory:

```bash
sudo npm link
```

Then generate your new project:
* Create a folder called **themes-developing/your-theme-name** inside **wp-content**
* Go inside this new folder and run the generator.

```bash
yo wordpress-theme-altimea
```

## Installation the theme on wordpress

The theme will be called `mynewtheme`

I'm asume the configuration of your main project is already done.
Our VirtualHost will be: 

	local.mydomain.com

(This is a example config your selft VirtualHost)

01: We meed to create the following directories:

```bash
cd /var/www/html/wordpress
mkdir wp-content/themes-developing
mkdir wp-content/themes-developing/mynewtheme
cd wp-content/themes-developing/mynewtheme
```

02: Now execute the yeoman generator:

```bash
yo wordpress-theme-altimea
```

03: Config the VirtualHost made for BrowserSync in `thetheme/gulpconfig.js`
change the (proxy):

	proxy: 'local.mynewtheme.com'
to 
	proxy: 'local.mydomain.com'

04: Execute gulp for see the final result

```bash
gulp
```
