'use strict';
var yeoman = require('yeoman-generator');
var chalk = require('chalk');
var yosay = require('yosay');

module.exports = yeoman.Base.extend({
    prompting: function () {
        // Have Yeoman greet the user.
        this.log(yosay(
            chalk.red('Altimea') + ' rules, bitch!'
        ));

        var prompts = [{
            type: 'input',
            name: 'themeName',
            message: '¿Qué nombre le quieres dar a la plantilla?',
            default: 'My Altimea Theme'
        },{
            type: 'input',
            name: 'themeSlashName',
            message: 'Nombre para la carpeta de la plantilla',
            default: 'altimea'
        },{
            type: 'input',
            name: 'themeDescription',
            message: 'Descripción de la plantilla',
            default: 'Theme developed by Altimea for their beloved client'
        },{
            type: 'input',
            name: 'className',
            message: '¿Qué nombre le quieres dar a la Class de la plantilla? (usar camelCase)',
            default: 'AltimeaTheme'
        },{
            type: 'input',
            name: 'themeUri',
            message: 'URI al repositorio de la plantilla',
            default: 'https://github.com/altimea/generator-wordpress-theme-altimea'
        }];

        return this.prompt(prompts).then(function (props) {
            // To access props later use this.props.someAnswer;
            this.props = props;
        }.bind(this));
    },

    writing: {
        //Copy the configuration files
        config: function () {
            this.fs.copyTpl(
                this.templatePath('config/_package.json'),
                this.destinationPath('package.json'), {
                    name: this.props.themeSlashName,
                    theme_uri: this.props.themeUri
                }
            );
            this.fs.copyTpl(
                this.templatePath('config/_gulpconfig.js'),
                this.destinationPath('gulpconfig.js'), {
                    name: this.props.themeSlashName
                }
            );
            this.fs.copyTpl(
                this.templatePath('config/_gulpfile.js'),
                this.destinationPath('gulpfile.js'), {
                    name: this.props.themeSlashName
                }
            );
            this.fs.copyTpl(
                this.templatePath('config/_bower.json'),
                this.destinationPath('bower.json'), {
                    name: this.props.themeSlashName
                }
            );
            this.fs.copy(
                this.templatePath('config/_editorconfig'),
                this.destinationPath('.editorconfig')
            );
            this.fs.copy(
                this.templatePath('config/_gitattributes'),
                this.destinationPath('.gitattributes')
            );
            this.fs.copy(
                this.templatePath('config/_gitignore'),
                this.destinationPath('.gitignore')
            );
            this.fs.copy(
                this.templatePath('config/_jshintrc'),
                this.destinationPath('.jshintrc')
            );
            this.fs.copyTpl(
                this.templatePath('config/_composer.json'),
                this.destinationPath('composer.json'), {
                    name: this.props.themeSlashName
                }
            );
            this.fs.copyTpl(
                this.templatePath('src/style.css'),
                this.destinationPath('style.css'), {
                    pretty_name: this.props.themeName
                }
            );

        },


        //Copy the configuration files
        app: function () {
            this.fs.copyTpl(
                this.templatePath('src/**'),
                this.destinationPath('src'),
                {
                    pretty_name: this.props.themeName,
                    name: this.props.themeSlashName,
                    name_function: this.props.themeSlashName.replace('-', '_'),
                    name_class: this.props.className,
                    description: this.props.themeDescription,
                    uri: this.props.themeUri
                }
            );

            /**
             * Theme Class Name
             */
            this.fs.move(
                this.destinationPath('src/inc/ClassName.php'),
                this.destinationPath('src/inc/' + this.props.className + '.php')
            );
        },

    },

    install: function () {
        this.installDependencies();
    }
});
