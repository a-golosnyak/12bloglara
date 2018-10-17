// This shows a full config file!
module.exports = function (grunt) {
    grunt.initConfig({
        watch: {
            files: 'public/scss/**/*.scss',
            tasks: ['sass']
        },
        sass: {
            dev: {
                options: {
                    style: 'expanded',
                    compass: true
                },
                files: {
                    'public/css/style.css': 'public/scss/main.scss'
                }
            }
        },
        browserSync: {
            dev: {
                bsFiles: {
                    src : [
                        'public/css/*.css',
                        'public/*.html',
                        'public/js/*.js'
                    ]
                },
                options: {
                    open: false,
                    host: "0.0.0.0",
                    ui: {
                        port: 8000
                    },
                    port: 8001,
                    watchTask: true,
                    server: './public'
                }
            }
        }
    });

    // load npm tasks
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-browser-sync');

    // define default task
    grunt.registerTask('default', ['browserSync', 'watch']);

};