'use strict';
module.exports = function(grunt) {
	require('load-grunt-tasks')(grunt);
	require('time-grunt')(grunt);

	var jsFileList = [
		'../assets/vendor/bootstrap/js/transition.js',
		'../assets/vendor/bootstrap/js/alert.js',
		'../assets/vendor/bootstrap/js/button.js',
		'../assets/vendor/bootstrap/js/carousel.js',
		'../assets/vendor/bootstrap/js/collapse.js',
		'../assets/vendor/bootstrap/js/dropdown.js',
		'../assets/vendor/bootstrap/js/modal.js',
		'../assets/vendor/bootstrap/js/tooltip.js',
		'../assets/vendor/bootstrap/js/popover.js',
		'../assets/vendor/bootstrap/js/scrollspy.js',
		'../assets/vendor/bootstrap/js/tab.js',
		'../assets/vendor/bootstrap/js/affix.js',
		'../assets/js/_*.js',
	];

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		less: {
			build: {
        files: {
          '../assets/css/<%= pkg.name %>.css': ['../assets/less/<%= pkg.name %>.less']
        },
        options: {
          compress: false,
          sourceMap: true,
          sourceMapFilename: '../assets/css/<%= pkg.name %>.css.map'
        }
      },

      dev: {
        files: {
          '../assets/css/<%= pkg.name %>.min.css': [ '../assets/less/<%= pkg.name %>.less']
        },
        options: {
          compress: true
        }
      }
		},

		autoprefixer: {
			options: {
				browsers: ['last 2 versions', 'ie 9', 'android 2.3', 'android 4', 'opera 12']
			},
			dev: {
				src: '../assets/css/<%= pkg.name %>.css'
			},
		},

		jshint: {
			options: {
				jshintrc: '.jshintrc'
			},
			theme: [
				'../assets/js/_*.js'
			],
			gruntfile: [
				'Gruntfile.js',
			]
		},

		concat: {
			options: {
				separator: ';',
			},
			dist: {
				src: [jsFileList],
				dest: '../assets/js/<%= pkg.name %>.js',
			},
		},

		uglify: {
			dist: {
				files: {
					'../assets/js/<%= pkg.name %>.min.js': [jsFileList]
				}
			}
		},

		watch: {
			less: {
				files: [
					'../assets/less/**'
				],
				tasks: ['less:build', 'autoprefixer']
			},
			js: {
				files: [
					'../assets/js/_*.js'
				],
				tasks: ['concat','jshint:theme']
			},
			gruntfile: {
				files: [
					'Gruntfile.js'
				],
				tasks: ['jshint:gruntfile']
			},
			livereload: {
				options: {
					livereload: false
				},
				files: [
					'../assets/css/**',
					'../assets/js/**',
					'../*.php',
					'../**/*.php'
				]
			}
		},

		modernizr: {
			dist: {
				devFile : '../assets/vendor/modernizr/modernizr.js',
				outputFile : '../assets/js/modernizr.min.js',
				files: {
					src: [
						'../assets/js/_*.js',
						'*/assets/css/*.css'
					]
				}
			}
		},

		compress: {
			main: {
				options: {
					archive: '../release/<%= pkg.name %>-<%= pkg.version %>.zip'
				},
				files: [
					{
						expand: true,
					 	cwd: '../',
					 	src: [
					 		'*',
					 		'*/**',
					 		'!assets/vendor/**',
					 		'!tools/**',
					 		'!release/**'
					 	],
					 	dest: '<%= pkg.name %>/'
					}
				]
			}
		},

		copy: {
			assets: {
				expand: true,
				cwd: '../assets/vendor/fontawesome/fonts/',
				src: ['**'],
				dest: '../assets/font/',
				filter: 'isFile'
			}
		},

		rename: {
			less: {
				src: '../assets/less/dw-starter.less',
				dest: '../assets/less/<%= pkg.name %>.less'
			},
			css: {
				src: '../assets/css/dw-starter.css',
				dest: '../assets/css/<%= pkg.name %>.css'
			},
			css_map: {
				src: '../assets/css/dw-starter.css.map',
				dest: '../assets/css/<%= pkg.name %>.css.map'
			},
			css_min: {
				src: '../assets/css/dw-starter.min.css',
				dest: '../assets/css/<%= pkg.name %>.min.css'
			},
			js: {
				src: '../assets/js/dw-starter.js',
				dest: '../assets/js/<%= pkg.name %>.js'
			},
			js_min: {
				src: '../assets/js/dw-starter.min.js',
				dest: '../assets/js/<%= pkg.name %>.min.js'
			}
		},

		replace: {
			basetext: {
				src: [ '../*.php', '../**/*.php', '../style.css' ],
				overwrite: true,
				replacements: [
					{
						from: 'DW Starter',
						to: '<%= pkg.theme_name %>'
					},
					{
						from: 'dw-starter',
						to: '<%= pkg.name %>'
					},
					{
						from: 'DW_Starter_Nav_Walker',
						to: '<%= pkg.theme_class_prefix %>_Nav_Walker'
					},
					{
						from: 'dw_starter',
						to: '<%= pkg.theme_prefix %>'
					}
				]
			},
			style: {
				src: [
					'../style.css'
				],
				overwrite: true,
				replacements: [
					{
						from: /^.*Theme Name:.*$/m,
						to: 'Theme Name: <%= pkg.theme_name %>'
					},
					{
						from: /^.*Theme URI:.*$/m,
						to: 'Theme URI: <%= pkg.theme_url %>'
					},
					{
						from: /^.*Author:.*$/m,
						to: 'Author: <%= pkg.author_name %>'
					},
					{
						from: /^.*Author URI:.*$/m,
						to: 'Author URI: <%= pkg.homepage %>'
					},
					{
						from: /^.*Version:.*$/m,
						to: 'Version: <%= pkg.version %>'
					},
					{
						from: /^.*Description:.*$/m,
						to: 'Description: <%= pkg.description %>'
					}
				]
			},
			bower: {
				src: [
					'bower.json'
				],
				overwrite: true,
				replacements: [
					{
						from: 'dw-starter',
						to: '<%= pkg.name %>'
					},
					{
						from: '1.0.0',
						to: '<%= pkg.version %>'
					},
					{
						from: 'http://www.designwall.com',
						to: '<%= pkg.homepage %>'
					},
					{
						from: 'DesignWall <hi@designwall.com>',
						to: '<%= pkg.author %>'
					}
				]
			}
		}
	});

	// Register tasks
	grunt.registerTask('default', [
		'dev'
	]);
	grunt.registerTask('generate',[
		'rename',
		'replace:basetext',
		'replace:style',
		'replace:bower'
	]);
	grunt.registerTask('dev',[
		'copy:assets',
		'less:dev',
		'autoprefixer',
		'concat',
		'jshint'
	]);
	grunt.registerTask('build', [
		'copy:assets',
		'less',
		'autoprefixer',
		'concat',
		'uglify',
		'compress'
	]);
};
