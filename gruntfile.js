module.exports = function(grunt) {
  
  grunt.initConfig({
    // Concatenate JavaScript files
    concat: {
      options: {
        separator: ';',
      },
      libs: {
        src: 'assets/scripts/libs/**/*.js',
        dest: 'public/scripts/libs.js'
      },
      main: {
        src: 'assets/scripts/*.js',
        dest: 'public/scripts/main.js'
      }
    },
    // Compress JavaScript files
    uglify: {
      libs: {
        files: {
          'public/scripts/libs.min.js': 'public/scripts/libs.js'
        }
      },
      main: {
        files: {
          'public/scripts/main.min.js': 'public/scripts/main.js'
        }
      },
    },
    // Compile SCSS files
    sass: {
      dist: {
        options: {
          style: 'expanded'
        },
        files: {
          'public/styles/main.css': ['assets/fonts/**/*.scss', 'assets/styles/main.scss']
        }
      }
    },
    // Compress CSS files
    cssmin: {
      combine:{
        files: {
          'public/styles/main.min.css': 'public/styles/main.css'
        }
      }
    },
    // Generate sprites
    sprite:{
      all: {
        src: 'assets/images/sprites/*.png',
        destImg: 'assets/images/sprite.png',
        destCSS: 'assets/styles/sprite.scss',
        cssFormat: 'scss',
        padding: 2
      }
    },
    // Compress PNG
    tinypng: {
      options: {
        apiKey: 'qU61jdX7AIcNvxk8gBgIN10K09rD1cS4',
        summarize: true,
        showProgress: true
      },
      compress: {
        expand: true,
        cwd: 'assets/images/',
        src: ['**/*.png', '!sprites/*.png'], 
        dest: 'public/images/',
        ext: '.png'
      },
    },
    // Compress images
    imagemin: {
      png: {
        options: {
          optimizationLevel: 3
        },
        files: [{
          expand: true,
          cwd: 'assets/images/',
          src: ['**/*.png', '!sprites/*.png'],
          dest: 'public/images/'
        }]
      },
      jpg: {
        options: {
          progressive: true
        },
        files: [{
          expand: true,
          cwd: 'assets/images/',
          src: ['**/*.{jpg,jpeg}'],
          dest: 'public/images/'
        }]
      }
    },
    // Watch for changes
    watch: {
      js: {
        files: ['assets/scripts/*.js'],
        tasks: ['compile-js'],
        options: {
          livereload: true,
        }
      },
      sass: {
        files: ['assets/**/*.scss'],
        tasks: ['compile-style'],
      },
      css: {
        files: ['public/styles/**/*.css'],
        options: {
          livereload: true,
        }
      },
      html: {
        files: ['public/**/*.php', 'public/**/*.html'],
        options: {
          livereload: true,
        }
      },
      images: {
        files: ['assets/images/**/*.{png,jpg,jpeg,gif}'],
        tasks: ['compile-images'],
        options: {
          spawn: false,
        }
      }
    },
  });

  // Load the plugins
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-spritesmith');
  grunt.loadNpmTasks('grunt-tinypng');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-newer');

  // Task definition
  grunt.registerTask('compile-js', ['concat', 'uglify']);
  grunt.registerTask('compile-style', ['sass', 'cssmin']);
  grunt.registerTask('compile-sprite', ['sprite', 'newer:imagemin']);
  grunt.registerTask('compile-images', ['newer:imagemin']);
  grunt.registerTask('compile-images-all', ['imagemin']);
  grunt.registerTask('compile-tinypng', ['newer:tinypng']);
  grunt.registerTask('compile-tinypng-all', ['tinypng']);
  grunt.registerTask('compile-all', ['concat', 'uglify', 'sass', 'cssmin', 'sprite', 'imagemin']);
  grunt.registerTask('default', ['watch']);
};