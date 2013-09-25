module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    
    compress: {
	  blogger: {
	    options: {
	      archive: '../standard-licenses/blogger/standard.zip'
	    },
	    files: [
	      {src: [
	      	'**',
	      	'!css/less/*',
	      	'!lib/*/css/less/*', 
	      	'!Gruntfile.js',
	      	'!codekit-config.json',
	      	'!package.json',
	      	'!bower.json',
	      	'!*.md',
	      	'!js/dev/*',
	      	'!**js/lib/twitter/**',
	      	'!**js/lib/fitvids/**',
	      	'!**js/lib/js-md5/**',
	      	'!**/node_modules/**',
	      	'!**/css/lib/less/**',
	      	'!lib/**/js/dev/*'
	      	], 
	      	dest: 'standard', 
	      	filter: 'isFile'
	      }
	    ]
	  },
	  designer: {
	    options: {
	      archive: '../standard-licenses/designer/standard.zip'
	    },
	    files: [
	      {src: [
	      	'**', 
	      	'!Gruntfile.js',
	      	'!package.json',
	      	'!bower.json',
	      	'!**js/lib/twitter/**',
	      	'!**js/lib/fitvids/**',
	      	'!**js/lib/js-md5/**',
	      	'!**/node_modules/**'
	      	], 
	      	dest: 'standard', 
	      	filter: 'isFile'
	      }
	    ]
	  },
	  developer: {
	    options: {
	      archive: '../standard-licenses/developer/standard.zip'
	    },
	    files: [
	      {src: [
	      	'**',
	      	'!**/node_modules/**'
	      	], 
	      	dest: 'standard',
	      }
	    ]
	  },
	},
    
	uglify: {
	  theme: {
	    files: {
	      'js/theme.main.min.js': [
              'js/dev/theme.*.js'
          ]
        }
	  },
	  
	  admin: {
	    files: {
	      'js/admin.min.js': [
              'js/dev/admin.*.js',
              'lib/**/js/dev/admin.js'
          ],      
          'js/admin.media-upload.min.js': ['js/dev/admin.media-upload.js']
        }
	  },
	  
	  widgets: {
	    files: {
          'lib/google-custom-search/js/admin.min.js': ['lib/google-custom-search/js/dev/admin.js'],
          'lib/personal-image/js/admin.min.js': ['lib/personal-image/js/dev/admin.js'],
          'lib/seo/js/admin.min.js': ['lib/seo/js/dev/admin.js'],
          'lib/standard-ad-125x125/js/admin.min.js': ['lib/standard-ad-125x125/js/dev/admin.js'],
          'lib/standard-ad-300x250/js/admin.min.js': ['lib/standard-ad-300x250/js/dev/admin.js'],
          'lib/standard-ad-billboard/js/admin.min.js': ['lib/standard-ad-billboard/js/dev/admin.js']
        }
	  },
	  
	  boostrap: {
	      options: {
	  	  	preserveComments: 'some'
	  	  },
		  files: {
			  'js/lib/bootstrap.min.js': ['js/lib/bootstrap/*.js']
		  }
	  },
	  
	  fitvids: {
	  	  options: {
	  	  	preserveComments: 'some'
	  	  },
		  files: {
			  'js/lib/jquery.fitvids.js': ['js/lib/fitvids/*.js']
		  }
	  },
	  
	  md5: {
	      options: {
	  	  	preserveComments: 'some'
	  	  },
		  files: {
			  'js/lib/md5.js': ['js/lib/js-md5/*.js']
		  }
	  }
	  
	},
    
    jshint: {
      theme: {
        options: {
          "-W099": true,
          "-W040": true
        },
        src: [
        	'js/dev/*.js'
        ],
      },
      plugins: {
        options: {
          "-W099": true,
          "-W040": true
        },
        src: [
        	'lib/**/js/dev/*.js'
        ],
      }
    },
    
    less: {
	  theme: {
	    options: {
	      paths: ["css/less"],
	      yuicompress: false
	    },
	    files: {
	      "style.css": "css/less/style.less",
	      "css/theme-responsive.css": "css/less/theme-responsive.less",
	      "css/admin.css": "css/less/admin.less",
	      "css/editor-style.css": "css/less/editor-style.less",
	      "css/theme.contrast-light.css": "css/less/theme.contrast-light.less"
	    }
	  },
	  plugins: {
	    options: {
	      paths: ["css/less"],
	      yuicompress: false
	    },
	    files: {
	      "lib/activity/css/admin.css": 'lib/activity/css/less/admin.less',
	      "lib/activity/css/widget.css": 'lib/activity/css/less/widget.less',
	      "lib/google-custom-search/css/admin.css": 'lib/google-custom-search/css/less/admin.less',
	      "lib/google-custom-search/css/widget.css": 'lib/google-custom-search/css/less/widget.less',
	      "lib/influence/css/admin.css": 'lib/influence/css/less/admin.less',
	      "lib/influence/css/widget.css": 'lib/influence/css/less/widget.less',
	      "lib/personal-image/css/admin.css": 'lib/personal-image/css/less/admin.less',
	      "lib/personal-image/css/widget.css": 'lib/personal-image/css/less/widget.less',
	      "lib/seo/css/admin.css": 'lib/seo/css/less/admin.less',
	      "lib/standard-ad-125x125/css/admin.css": 'lib/standard-ad-125x125/css/less/admin.less',
	      "lib/standard-ad-125x125/css/widget.css": 'lib/standard-ad-125x125/css/less/widget.less',
	      "lib/standard-ad-300x250/css/admin.css": 'lib/standard-ad-300x250/css/less/admin.less',
	      "lib/standard-ad-300x250/css/widget.css": 'lib/standard-ad-300x250/css/less/widget.less',
	      "lib/standard-ad-billboard/css/admin.css": 'lib/standard-ad-billboard/css/less/admin.less',
	      "lib/standard-ad-billboard/css/widget.css": 'lib/standard-ad-billboard/css/less/widget.less'
	    }
	  },
	  bootstrap: {
	    options: {
	      paths: ["css/less"],
	      yuicompress: false
	    },
	    files: {
	      "css/lib/bootstrap.css": "css/lib/less/twitter/bootstrap.less",
	      "css/lib/bootstrap-responsive.css": "css/lib/less/twitter/responsive.less"
	    }
	  },
	  uncompressed: {
	    options: {
	      paths: ["css/less"],
	      yuicompress: false
	    },
	    files: {
	      "style.css": "css/less/style.less",
	      "css/theme-responsive.css": "css/less/theme-responsive.less",
	      "css/theme.contrast-light.css": "css/less/theme.contrast-light.less"
	    }
	  },
	  production: {
	    options: {
	      paths: ["css/less"],
	      yuicompress: true
	    },
	    files: {
	      "style.css": "css/less/style.less",
	      "css/theme-responsive.css": "css/less/theme-responsive.less",
	      "css/admin.css": "css/less/admin.less",
	      "css/editor-style.css": "css/less/editor-style.less",
	      "css/theme.contrast-light.css": "css/less/theme.contrast-light.less",

           // Widgets
	      "lib/activity/css/admin.css": 'lib/activity/css/less/admin.less',
	      "lib/activity/css/widget.css": 'lib/activity/css/less/widget.less',
	      "lib/google-custom-search/css/admin.css": 'lib/google-custom-search/css/less/admin.less',
	      "lib/google-custom-search/css/widget.css": 'lib/google-custom-search/css/less/widget.less',
	      "lib/influence/css/admin.css": 'lib/influence/css/less/admin.less',
	      "lib/influence/css/widget.css": 'lib/influence/css/less/widget.less',
	      "lib/personal-image/css/admin.css": 'lib/personal-image/css/less/admin.less',
	      "lib/personal-image/css/widget.css": 'lib/personal-image/css/less/widget.less',
	      "lib/seo/css/admin.css": 'lib/seo/css/less/admin.less',
	      "lib/standard-ad-125x125/css/admin.css": 'lib/standard-ad-125x125/css/less/admin.less',
	      "lib/standard-ad-125x125/css/widget.css": 'lib/standard-ad-125x125/css/less/widget.less',
	      "lib/standard-ad-300x250/css/admin.css": 'lib/standard-ad-300x250/css/less/admin.less',
	      "lib/standard-ad-300x250/css/widget.css": 'lib/standard-ad-300x250/css/less/widget.less',
	      "lib/standard-ad-billboard/css/admin.css": 'lib/standard-ad-billboard/css/less/admin.less',
	      "lib/standard-ad-billboard/css/widget.css": 'lib/standard-ad-billboard/css/less/widget.less',
	      
	      //Bootstrap
	      "css/lib/bootstrap.css": "css/lib/less/twitter/bootstrap.less",
	      "css/lib/bootstrap-responsive.css": "css/lib/less/twitter/responsive.less"
	    }
	  }
	},
	
	bower: {
		install: {
			options: {
				targetDir: 'components',
		        layout: 'byType',
		        install: true,
		        verbose: false,
		        cleanTargetDir: false,
		        cleanBowerDir: true
			}
		}
	},

      imagemin: {
          png: {
              options: {
                  optimizationLevel: 7
              },
              files: [
                  {
                      // Set to true to enable the following options…
                      expand: true,
                      // cwd is 'current working directory'
                      cwd: 'images/',
                      src: ['*.png'],
                      // Could also match cwd line above. i.e. project-directory/img/
                      dest: 'images/',
                      ext: '.png'
                  }
              ]
          },
          social: {
              options: {
                  progressive: true
              },
              files: [
                  {
                      // Set to true to enable the following options…
                      expand: true,
                      // cwd is 'current working directory'
                      cwd: 'images/social/small',
                      src: ['*.png'],
                      // Could also match cwd. i.e. project-directory/img/
                      dest: 'images/social/small',
                      ext: '.png'
                  }
              ]
          }
      },
	
    watch: {
      theme_js: {
	      files: ['js/dev/*.js'],
	      tasks: ['jshint:theme']
      },
      plugin_js: {
	      files: ['lib/**/js/dev/*.js'],
	      tasks: ['jshint:plugins']
      },
      theme_less: {
	      files: [
	      	'css/less/*.less'
	      	],
		  tasks: ['less:theme']    
      },
      plugin_less: {
	      files: [
	      	'lib/**/css/less/*.less'
	      	],
		  tasks: ['less:plugins']    
      },
      images : {
          files: [
            'images/*.png'
          ],
          tasks: ['imagemin:png']
      },
      images_social : {
          files: [
            'images/social/small/*.png'
          ],
          tasks: ['imagemin:social']
      }
    }
    
  });

  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-compress');
  grunt.loadNpmTasks('grunt-bower-task');
  grunt.loadNpmTasks('grunt-contrib-imagemin');

  grunt.registerTask('default', ['watch']);
  grunt.registerTask('setup', ['bower', 'less:theme', 'less:plugins', 'less:bootstrap', 'jshint', 'watch']);
  grunt.registerTask('build', ['jshint', 'uglify', 'imagemin', 'less:uncompressed', 'compress:designer', 'less:production', 'compress:developer', 'compress:blogger']);

};