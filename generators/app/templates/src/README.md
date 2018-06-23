
# <%= pretty_name %>


### APACHE
Basic configuration of the virtualhost mode developer: ` /etc/apache2/sites-available/local.project.com.conf`

	<VirtualHost *:80>
		ServerName local.project.com
		DocumentRoot /var/www/html/project/app/
		<Directory /var/www/html/project/app/>
			Options Indexes FollowSymLinks Multiviews
			AllowOverride All
			Order allow,deny
			allow from all
			RewriteEngine on
		</Directory>
		SetEnv WP_ENV dev
		ErrorLog ${APACHE_LOG_DIR}/local.project.com-error.log
	</VirtualHost>

### Use breakpoints bootsrap4.1.1
[Ver documentación](https://getbootstrap.com/docs/4.1/layout/overview/#responsive-breakpoints)

```scss
.my-component{
    // use max-width
    @include media-breakpoint-down(sm){
        // props
    }
    @include media-breakpoint-down(xs){
        // props
        &__head{
            // props
        }
    }
    // use min-width
    @include media-breakpoint-up(xs){
        // props
    }
}
```

#### Alternative for custom breakpoints: Input sass example use mixin mq and style code sass for component

Use sass mixin responsive helpers file in `sass/mixin/_media_queries.scss`
Use BEM for write css: https://css-tricks.com/bem-101/

```scss
.my-component{
    // use max-width mq custom
    @include maxw(360px){
        // props
    }
    // use min-width mq custom
    @include minw(360px){
        // props
    }
}
```
