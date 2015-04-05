'use strict';
module.exports = function(grunt) {
	require('load-grunt-tasks')(grunt);
	require('time-grunt')(grunt);

	var jsFileList = [
		'assets/vendor/bootstrap/js/transition.js',
		'assets/vendor/bootstrap/js/alert.js',
		'assets/vendor/bootstrap/js/button.js',
		'assets/vendor/bootstrap/js/carousel.js',
		'assets/vendor/bootstrap/js/collapse.js',
		'assets/vendor/bootstrap/js/dropdown.js',
		'assets/vendor/bootstrap/js/modal.js',
		'assets/vendor/bootstrap/js/tooltip.js',
		'assets/vendor/bootstrap/js/popover.js',
		'assets/vendor/bootstrap/js/scrollspy.js',
		'assets/vendor/bootstrap/js/tab.js',
		'assets/vendor/bootstrap/js/affix.js',
		'assets/js/_main.js',
	];

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		jshint: {
			options: {
				jshintrc: '.jshintrc'
			},
			all: [
				'Gruntfile.js',
				'assets/js/_*.js'
			]
		},

		less: {
			dev: {
				files: {
					'assets/css/<%= pkg.name %>.css': [
						'assets/less/<%= pkg.name %>.less'
					]
				},
				options: {
					compress: false,
					sourceMap: true,
					sourceMapFilename: 'assets/css/<%= pkg.name %>.css.map'
				}
			},

			build: {
				files: {
					'assets/css/<%= pkg.name %>.min.css': [
						'assets/less/<%= pkg.name %>.less'
					]
				},
				options: {
					compress: true
				}
			}
		},

		concat: {
			options: {
				separator: ';',
			},
			dist: {
				src: [jsFileList],
				dest: 'assets/js/<%= pkg.name %>.js',
			},
		},

		uglify: {
			dist: {
				files: {
					'assets/js/<%= pkg.name %>.min.js': [jsFileList]
				}
			}
		},

		autoprefixer: {
			options: {
				browsers: ['last 2 versions', 'ie 9', 'android 2.3', 'android 4', 'opera 12']
			},
			dev: {
				options: {
					map: {
						prev: 'assets/css/'
					}
				},
				src: 'assets/css/<%= pkg.name %>.css'
			},
			build: {
				src: 'assets/css/<%= pkg.name %>.min.css'
			}
		},

		watch: {
			less: {
				files: [
					'assets/less/**'
				],
				tasks: ['less:dev', 'autoprefixer:dev']
			},
			js: {
				files: [
					jsFileList,
					'<%= jshint.all %>'
				],
				tasks: ['concat', 'uglify']
			},
			livereload: {
				options: {
					livereload: false
				},
				files: [
					'assets/css/**',
					'assets/js/**',
					'*.php'
				]
			}
		},

		copy: {
			assets: {
				expand: true,
				cwd: 'assets/vendor/fontawesome/font/',
				src: ['**'],
				dest: 'dist/assets/font/',
				filter: 'isFile'
			}
		},

		makepot: {
      target: {
        options: {
          cwd: '.',
          domainPath: '/languages',
          exclude: [ 'node_modules', 'release', 'assets' ],
          type: 'wp-theme',
        }
      }
    },

		compress: {
			main: {
				options: {
					archive: 'release/<%= pkg.name %>-<%= pkg.version %>.zip'
				},
				files: [
					{
						expand: true,
						src: [
							'**',
							'!.git/**',
							'!release/**',
							'!node_modules/**',
							'!assets/vendor/**',
							'!assets/less/**',
							'!assets/js/_*.js',
							'!.bowerrc',
							'!.editorconfig',
							'!.gitignore',
							'!.jshintrc',
							'!bower.json',
							'!Gruntfile.js',
							'!package.json',
							'!readme.md',
						],
						dest: '<%= pkg.name %>/'
					}
				]
			}
		}
	});

	// Register tasks
	grunt.registerTask('default', [
		'dev'
	]);
	grunt.registerTask('dev',[
		'copy:assets',
		'jshint',
		'less:build',
		'uglify'
	]);
	grunt.registerTask('build',[
		'copy:assets',
		'jshint',
		'less:build',
		'uglify',
		'makepot',
		'compress'
	]);
};
